<?php

namespace App\Http\Controllers\Doctor;

use App\Consultation;
use App\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display dashboard for doctors.
     * 
     */
    public function index()
    {
        $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $scheduleTomorrow = Schedule::where('doctor_id', $doctorLogged->id)->Tomorrow()->get();
        $latest = Consultation::where('doctor_id', $doctorLogged->id)->latest()->limit(10)->get();
        $ongoing = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->whereDate('actual_datetime', Carbon::now())->latest()->limit(10)->get();
        $upcoming = Consultation::where('doctor_id', $doctorLogged->id)->whereStatus('confirmed')
        ->where('actual_datetime', '>', Carbon::tomorrow())->latest()->limit(10)->get();
        return view('doctor.index', compact('doctorLogged', 'scheduleTomorrow', 'latest', 'ongoing', 'upcoming'));
    }

    /**
     * Fetch notification for specified doctor.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function notifications(Request $request)
    {
        $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        $notifications = $doctorLogged->unreadNotifications;
        return response()->json(array('data' => $notifications), 200);
    }

    /**
     * Mark specified unread notification as read.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function markAsRead(Request $request)
    {
        if($request->filled('notifId')){
            $notification = DatabaseNotification::find($request->notifId);
            if($notification){
                $notification->markAsRead();
                return response()->json('success', 200);
            }else{
                return response()->json('error', 200);
            }
        }else{
            return response()->json('error', 200);
        }
    }

    /**
     * Mark all unread notifications as read.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function markAllAsRead(Request $request)
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notifications Cleared!');
    }
}
