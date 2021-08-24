<?php

namespace App\Http\Controllers\Patient;

use App\Schedule;
use Carbon\Carbon;
use App\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class CalendarController extends Controller
{
    public function fetch()
    {
        /* $appointments = array(
            'id' => 1,
            'color' => '#000',
            'title' => 'test title',
            'mobile' => '09388566223',
            'email' => 'test@email.com',
            'gender' => true ? '<i class="fas fa-mars"></i>' : '<i class="fas fa-venus"></i>',
            'complaint' => 'headache',
            'teleconference' => 'teleconfence test',
            'status' => 'COMPLETED',
        );
        return response()->json(array('data' => $appointments), 200); */


        $patientLogged = auth()->user()->patient;
        $appointments = Consultation::where('patient_id', $patientLogged->id)->where(function($query){
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
                /* 'path' => route('patient.appointments.show', $item), */
            );
        });
        return response()->json(array('data' => $appointments), 200);
    }
}
