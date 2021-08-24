<?php

namespace App\Http\Controllers\Doctor;

use App\Jobs\SendSmsJob;
use App\Jobs\ProcessSmsSending;
use App\User;
use App\Doctor;
use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Spatie\MediaLibrary\Models\Media;
use Zoom;
use MacsiDigital\API\Support\Authentication\JWT;

class ConsultationController extends Controller
{
    /**
     * Display a list of consultations.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
	public function index(Request $request)
	{
        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $sortBy = $request->filled('sort_by') ? $request->sort_by : null;
        $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $query = Consultation::where('doctor_id', $doctorLogged->id)
	        ->when($search, function($query) use($search) {
                $query->whereHas('patient', function($q) use ($search) {
    	        	$q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%")
    	        		  ->orWhere('reference_no', 'LIKE', "%$search%")
    	        		  ->orWhere('complaint', 'LIKE', "%$search%")
    	        		  ->orWhere('email', 'LIKE', "%$search%");
                });
	        })
	        ->when($status, function($query) use($status){
	            $query->where('status', $status);
	        });

        switch ($sortBy) {
            case 'appointment_date':
                $query = $query->orderBy('actual_datetime', 'desc');
                break;
            default:
                $query = $query->latest();
                break;
        }

	    $consultations = $query->paginate(15);

		return view('doctor.consultations.index', compact('consultations'));
	}

    /**
     * Update specified consultation in storage.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
	public function update(Consultation $consultation, Request $request)
	{
		$request->validate([
            // 'remarks' => 'required',
            'attachments.*.file' => 'file|max:5000'
        ]);
        
        $doctorFullName        = $consultation->doctor_full_name;
        $patientFirstName      = $consultation->first_name;
        $consultation->remarks = $request->remarks;
        $consultation->save();

        // upload attachments here ...
        if($request->has('attachments')){
            $attachments = $request->attachments;
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach){
                    if(isset($attach['file']) && !empty($attach['file'])) {
                        $title = $attach['title'] ?: $attach['file']->getClientOriginalName();
                        $consultation->addMedia($attach['file'])->usingName($title)->toMediaCollection('doctor');

                        if ($attach['file']->isValid()) {
                            Mail::to($consultation->email)->queue(
                                new \App\Mail\DoctorUploadedFile($patientFirstName, $doctorFullName, $consultation)
                            );
                        }

                        SendSmsJob::dispatch('doctor_uploaded_consultation_file', $consultation->mobile, [
                            'id'           => $consultation->id,
                            'doctor'       => $doctorFullName,
                        ]);

                    }
                }
            }
        }

        return redirect()->back()
                         ->with('success', 'Successfully updated appointment!');
	}

    /**
     * Remove media from specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     * @param  Media $media
     */
	public function removeMedia(Consultation $consultation, Media $media)
    {
        $media->delete();

        return redirect()->back()
                         ->with('success', 'Successfully removed file!');
    }

    /**
     * Show specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     */
	public function show(Consultation $consultation)
	{
        $doctor = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        abort_if($consultation->doctor_id != $doctor->id, 403);

        $logs = $consultation->logs;
		return view('doctor.consultations.show', compact('consultation', 'logs'));
	}

    /**
     * Approve specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
	public function approve(Consultation $consultation, Request $request)
	{
		$rescheduled = $request->has('reschedule');
		$actualDateTime = $consultation->date_time;
		if ($rescheduled) {
			$actualDateTime = new Carbon($request->date. ' ' .$request->time);
		}

		$consultation->status = Consultation::APPROVED;
		$consultation->consultation_fee = $request->consultation_fee;
		$consultation->payment_required = !$request->has('no_payment_required');
		$consultation->actual_datetime = $actualDateTime;
		$consultation->actual_endtime = with($actualDateTime)->clone()->addMinutes($consultation->duration);
        $paymentExp = now()->addHours(24);
        if ($paymentExp->gt($actualDateTime)) {
		    $consultation->payment_expiration = with($actualDateTime)->clone()->subHours(1);
        } else {
            $consultation->payment_expiration = $paymentExp;
        }
		$consultation->save();

		Mail::to($consultation->email)->queue(
			new \App\Mail\AppointmentApproved($consultation, $rescheduled, $request->remarks)
		);

        // sms for patient
        $doctor = $consultation->doctor;
        if ($consultation->mobile) {
            ProcessSmsSending::dispatch('patient_doctor_approved', str_replace('-', '', $consultation->mobile), [
                'first_name' => $consultation->first_name,
                'last_name' => $consultation->last_name,
                'misc_shortcodes' => json_encode([
                    'reference_no' => $consultation->reference_no,
                    'doctor' => $doctor->first_name . ' ' . $doctor->last_name,
                    'booking_date' => $consultation->actual_datetime->format(self::DATETIME_FORMAT),
                ])
            ]);
        }

		return redirect()->back()
						 ->with('success', 'Successfully approved appointment!');
	}

    /**
     * Reschedule specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
    public function reschedule(Consultation $consultation, Request $request)
    {
        $actualDateTime = new Carbon($request->date. ' ' .$request->time);

        $consultation->consultation_fee = $request->consultation_fee;
        $consultation->payment_required = !$request->has('no_payment_required');
        $consultation->actual_datetime = $actualDateTime;
        $consultation->actual_endtime = with($actualDateTime)->clone()->addMinutes($consultation->duration);
        $consultation->save();

        Mail::to($consultation->email)->queue(
            new \App\Mail\AppointmentApproved($consultation, true, $request->remarks)
        );

        $doctor = $consultation->doctor;

        if ($consultation->mobile) {
            SendSmsJob::dispatch('doctor_rescheduled_consultation_file', $consultation->mobile, [
                'first_name' => $consultation->first_name,
                'last_name' => $consultation->last_name,
                'reference_no' => $consultation->reference_no,
                'doctor' => $doctor->first_name . ' ' . $doctor->last_name,
                'booking_date' => $consultation->actual_datetime->format(self::DATETIME_FORMAT),
            ]);
        }
        
        return redirect()->back()
                         ->with('success', 'Successfully rescheduled appointment!');
    }

    /**
     * Mark specified consultation as paid.
     * 
     * @param  \App\Consultation  $consultation
     */
	public function markPaid(Consultation $consultation)
	{
        $meeting = $this->manualMeeting($consultation);
        $consultation->join_url = $meeting ? $meeting->join_url : '';
        $consultation->meeting_id = $meeting ? $meeting->id : '';
		$consultation->paid = true;
        $consultation->status = 'confirmed';
		$consultation->save();

        Mail::to($consultation->email)->queue(
            new \App\Mail\AppointmentPaymentReceived($consultation)
        );

        $doctor = $consultation->doctor;
        if ($consultation->mobile) {
            SendSmsJob::dispatch('patient_doctor_payment_made', str_replace('-', '', $consultation->mobile), [
                'first_name' => $consultation->first_name,
                'last_name' => $consultation->last_name,
                'reference_no' => $consultation->reference_no,
                'doctor' => $doctor->first_name . ' ' . $doctor->last_name,
                'booking_date' => $consultation->actual_datetime->format(self::DATETIME_FORMAT)
            ]);
        }

        $user = auth()->user();
        $consultation->logs()->create([
            'user_id' => $user->id,
            'name' => $user->name,
            'excerpt' => $user->name.' marked appointment as paid',
            'text' => $user->name.' marked appointment as paid',
        ]);

		return redirect()->back()
						 ->with('success', 'Successfully marked appointment as paid!');
	}

    /**
     * Change status of specified consultation to confirmed.
     * 
     * @param  \App\Consultation  $consultation
     */
	public function confirm(Consultation $consultation)
	{
        // $meeting = $this->newMeeting($consultation);
        $meeting = $this->manualMeeting($consultation);
        $consultation->status = Consultation::CONFIRMED;
        $consultation->join_url = $meeting ? $meeting->join_url : '';
        $consultation->meeting_id = $meeting ? $meeting->id : '';
		$consultation->save();

		Mail::to($consultation->email)->queue(
			new \App\Mail\AppointmentConfirmed($consultation)
		);

        // sms for patient
        $doctor = $consultation->doctor;
        if ($consultation->mobile) {
            ProcessSmsSending::dispatch('patient_doctor_confirmed', str_replace('-', '', $consultation->mobile), [
                'first_name' => $consultation->first_name,
                'last_name' => $consultation->last_name,
                'misc_shortcodes' => json_encode([
                    'reference_no' => $consultation->reference_no,
                    'doctor' => $doctor->first_name . ' ' . $doctor->last_name,
                    'booking_date' => $consultation->actual_datetime->format(self::DATETIME_FORMAT),
                ])
            ]);
        }

		return redirect()->back()
						 ->with('success', 'Successfully confirmed appointment!');
	}

    /**
     * Change status of specified consultation to completed.
     * 
     * @param  \App\Consultation  $consultation
     */
	public function complete(Consultation $consultation)
	{
		$consultation->status = Consultation::COMPLETED;
		$consultation->save();

		return redirect()->back()
						 ->with('success', 'Successfully completed appointment!');
	}

    /**
     * Cancel specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     */
	public function cancel(Consultation $consultation)
	{
		$consultation->status = Consultation::CANCELLED;
		$consultation->save();

		return redirect()->back()
						 ->with('success', 'Successfully completed appointment!');
    }

    /**
     * Edit specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     */
    public function edit(Consultation $consultation)
    {
        $customFields = \App\DoctorForm::orderBy('order')->get();
        return view('doctor.consultations.edit', compact('consultation', 'customFields'));
    }

    /**
     * Save specified consultation in storage.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
    public function editSave(Consultation $consultation, Request $request)
    {
        $data = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'complaint' => 'required',
        ]);
        $patient = $consultation->patient;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->middle_name = $request->middle_name;
        $patient->mobile = $request->mobile;
        $patient->email = $request->email;
        $patient->province_id = $request->province;
        $patient->city_id = $request->city;
        $patient->birthdate = Carbon::parse($request->birthdate)->copy()->toDateString();
        $patient->gender = $request->gender;
        $patient->save();

        $consultation->complaint = $request->complaint;
        $consultation->custom_fields = (array) $request->fields;
        $consultation->save();
        return redirect()->back()
						 ->with('success', 'Successfully updated appointment!');
    }

    /**
     * Generate zoom access token.
     * 
     */
    public function getZoomAccessToken() {
        $doctor = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;

        $key = $doctor->zoom_secret;
        $payload = array(
            "iss" => $doctor->zoom_key,
            'exp' => time() + 3600,
        );

        return JWT::generateToken($payload, $key);    
    }

    /**
     * Create Zoom meeting manualy for specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     */
    public function manualMeeting(Consultation $consultation)
    {
        $doctor = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $zoomMeetingUrl = "https://api.zoom.us/v2/users/me/meetings";

        if($doctor->zoom_key && $doctor->zoom_secret){
            $response = Http::withHeaders([
                                    "Content-Type" => "application/json",
                                    "Authorization" => "Bearer ".$this->getZoomAccessToken(),
                                ])
                                ->post($zoomMeetingUrl, [
                                    'topic' => "Doctor's Appointment with reference #".$consultation->reference_no,
                                    'type' => 2,
                                    'start_time' => $consultation->actual_datetime,
                                    'duration' => $consultation->duration,
                                    'timezone' => 'Asia/Hong_Kong'
                                ]);

            if($response->successful()){
                $data = (object) $response->json();
                if($data){
                    return $data;
                }
            }
        }

        return null;
    }

    /**
     * Create zoom meeting using laravel zoom package.
     * 
     * @param  \App\Consultation  $consultation
     */
    public function newMeeting(Consultation $consultation)
    {
        $meeting = Zoom::meeting();
        // $user = Zoom::user()->find('x21JkmZtTqm5Eho_rd8j_g')->first();

        $meeting = Zoom::meeting()->make([
            'topic' => $consultation->reference_no,
            'type' => 2,
            'start_time' => new Carbon($consultation->actual_datetime), // best to use a Carbon instance here.
            'duration' => $consultation->duration,
            'timezone' => 'Asia/Hong_Kong'
        ]);

        $meeting->settings()->make([
            'join_before_host' => false,
            'approval_type' => 1,
            'registration_type' => 1,
            'enforce_login' => false,
            'waiting_room' => true,
        ]);

        $user = Zoom::user()->find('x21JkmZtTqm5Eho_rd8j_g')->meetings()->save($meeting);

        return $user;
    }

}
