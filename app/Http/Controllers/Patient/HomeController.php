<?php

namespace App\Http\Controllers\Patient;

use App\City;
use App\Patient;
use App\Province;
use App\Schedule;
use Carbon\Carbon;
use App\Booking;
use App\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;


class HomeController extends Controller
{
    public function index()
    {
        $patientLogged = auth()->user()->patient;
        $latest = Consultation::where('patient_id', $patientLogged->id)->latest()->limit(10)->get();
        $bookings = Booking::where('patient_id', $patientLogged->id)->latest()->limit(10)->get();
        $type = "edit";

        $cities = City::with(['province'])->orderBy('name')->get();
        $provinces = Province::all();

        $user = Patient::where('id',$patientLogged->id)->first();
        if($user->birthdate != null) { 
            return view('patient.index', compact('latest', 'bookings'));
        } else {
            return view('patient.required-first-login',  compact('user', 'type', 'cities', 'provinces'));
        }

       /*  return view('patient.index', compact('latest', 'bookings', 'user', 'type', 'cities', 'provinces')); */
    }

    public function appointments()
    {
        /* $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $scheduleTomorrow = Schedule::where('doctor_id', $doctorLogged->id)->Tomorrow()->get();
        $latest = Consultation::where('doctor_id', $doctorLogged->id)->latest()->limit(10)->get();
        $ongoing = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->whereDate('actual_datetime', Carbon::now())->latest()->limit(10)->get();
        $upcoming = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->where('actual_datetime', '>', Carbon::tomorrow())->latest()->limit(10)->get();
        return view('patient.index', compact('doctorLogged', 'scheduleTomorrow', 'latest', 'ongoing', 'upcoming')); */
        return view('patient.pending-appointments');
    }


    public function labsDiagnostiAppointments()
    {
        /* $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $scheduleTomorrow = Schedule::where('doctor_id', $doctorLogged->id)->Tomorrow()->get();
        $latest = Consultation::where('doctor_id', $doctorLogged->id)->latest()->limit(10)->get();
        $ongoing = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->whereDate('actual_datetime', Carbon::now())->latest()->limit(10)->get();
        $upcoming = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->where('actual_datetime', '>', Carbon::tomorrow())->latest()->limit(10)->get();
        return view('patient.index', compact('doctorLogged', 'scheduleTomorrow', 'latest', 'ongoing', 'upcoming')); */
        return view('patient.pending-appointments');
    }

    public function calendar()
    {
        $patientLogged = auth()->user()->patient;
        $bookings = Booking::where('patient_id', $patientLogged->id)->latest()->limit(10)->get();
        /* $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $scheduleTomorrow = Schedule::where('doctor_id', $doctorLogged->id)->Tomorrow()->get();
        $latest = Consultation::where('doctor_id', $doctorLogged->id)->latest()->limit(10)->get();
        $ongoing = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->whereDate('actual_datetime', Carbon::now())->latest()->limit(10)->get();
        $upcoming = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->where('actual_datetime', '>', Carbon::tomorrow())->latest()->limit(10)->get();
        return view('patient.index', compact('doctorLogged', 'scheduleTomorrow', 'latest', 'ongoing', 'upcoming')); */
        return view('patient.calendar');
    }

    public function profile()
    {
        $patientLogged = auth()->user()->patient;
        $cities = City::with(['province'])->orderBy('name')->get();
        $type = "edit";
        $user = Patient::where('id',$patientLogged->id)->first();
        $provinces = Province::all();
        return view('patient.profile', compact('user', 'type', 'cities', 'provinces'));
    }

    public function forms()
    {
        /* $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $scheduleTomorrow = Schedule::where('doctor_id', $doctorLogged->id)->Tomorrow()->get();
        $latest = Consultation::where('doctor_id', $doctorLogged->id)->latest()->limit(10)->get();
        $ongoing = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->whereDate('actual_datetime', Carbon::now())->latest()->limit(10)->get();
        $upcoming = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->where('actual_datetime', '>', Carbon::tomorrow())->latest()->limit(10)->get();
        return view('patient.index', compact('doctorLogged', 'scheduleTomorrow', 'latest', 'ongoing', 'upcoming')); */
        return view('patient.forms');
    }
}
