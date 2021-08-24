<?php

namespace App\Http\Controllers\Doctor;

use App\Consultation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display calendar with list of events.
     */
    public function index()
    {
        return view('doctor.calendar');
    }

    /**
     * Fetch calendar events in storage.
     */
    public function fetch()
    {

        $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $appointments = Consultation::where('doctor_id', $doctorLogged->id)->where(function($query){
            $query->where('status', '!=', 'pending')
                ->where('status', '!=', 'cancelled')
                ->where('status', '!=', 'expired');
        })->latest()->limit(10)->get()
        ->map(function($item, $key) {
            $color = array(
                'approved' => '#007bff',
                'confirmed' => '#28a745',
                'completed' => '#4617b8',
                'cancelled' => '#dc3545',
                'expired' => '#ab8207'
            );
            return array(
                'id' => $item->id,
                'color' => isset($color[$item->status]) ? $color[$item->status] : '#000',
                'title' => $item->name,
                'type' => $item->type,
                'type_display' => $item->type_display,
                'mobile' => $item->mobile,
                'email' => $item->email,
                'gender' => $item->gender == 'male' ? '<i class="fas fa-mars"></i>' : '<i class="fas fa-venus"></i>',
                'complaint' => $item->complaint,
                'teleconference' => $item->teleconference,
                'join_url' => $item->join_url,
                'start' => $item->actual_datetime,
                'end' => $item->actual_endtime,
                'status' => ucwords($item->status),
                'status_normal' => $item->status,
                'path' => route('doctor.appointments.show', $item),
            );
        });
        return response()->json(array('data' => $appointments), 200);
    }
}
