<?php

namespace App\Http\Livewire;

use App\Doctor;
use App\Consultation;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class BookDoctor extends Component
{
    public $show = false;
	public $date;
	public $time;
	public $fname;
	public $lname;
    public $email;
    public $mobile;
    public $doctorId;
    public $complaint = '';
    public $search = '';
    public $success = false;
    public $doctorName = '';
    public $type = Consultation::ONLINE;

    protected $listeners = ['doctorSelected', 'dateTimeSelected', 'typeSelected'];

    public function mount()
    {
    	if (session()->has('doctor')) {
            $this->doctorSelected(session('doctor'));
        }
    }

    public function typeSelected($type)
    {
        $this->type = $type;
    }

    public function doctorSelected($data)
    {
        $doctor = Doctor::find($doctorId);
        $this->doctorName = `{$doctor->last_name}, {$doctor->first_name}`;
    	$this->doctorId = $doctorId;
    }

    public function dateTimeSelected($data)
    {
        $carbon = new Carbon($data['date'] ?? '');

        $this->time = $data['time'] ?? '';
        $this->date = $carbon->toDateString();
        $this->show = true;
    }

    public function submit()
    {
        $this->validate([
        	'doctorId' => 'required',
        	'date' => 'required',
        	'time' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'complaint' => 'required',
        ]);

        $doctor = Doctor::find($this->doctorId);

        $c = new Consultation;
        $c->first_name = $this->fname;
        $c->last_name = $this->lname;
        $c->mobile = $this->mobile;
        $c->email = $this->email;
        $c->complaint = $this->complaint;
        $c->date_time = $this->date. ' ' .$this->time;
        $c->duration = $doctor->consultation_duration ?? 5;
        $c->actual_datetime = $c->date_time;
        $c->actual_endtime = $c->date_time->addMinutes($c->duration);
        $c->payment_expiration = $c->date_time->addHours(24);
        $c->doctor_id = $doctor->id;
        $c->type = $this->type;
        $c->save();

        Mail::to($doctor->email)->queue(new \App\Mail\AppointmentCreated($c));
        Mail::to($c->email)->queue(new \App\Mail\AppointmentCreatedReceipt($c));

        $this->success = true;
    }

    public function backToSearch()
    {
        session()->forget('doctor');
        return redirect('/book-doctor');
    }

    public function render()
    {
        $doctor = null;
        if ($this->doctorId) {
            $doctor = Doctor::find($this->doctorId);
        }

        return view('livewire.book-doctor', compact('doctor'));
    }
}
