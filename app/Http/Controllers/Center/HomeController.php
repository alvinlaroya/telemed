<?php

namespace App\Http\Controllers\Center;

use App\Booking;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class HomeController extends Controller
{
    /**
     * Display dashboard for center users.
     */
    public function index()
    {
        $userLogged = auth()->user();
        $center = $userLogged->center();

        $assignedCenter = $userLogged->assignedCentersArr();

        $with = [
            'bookingCenters' => function($q) use ($assignedCenter) {
                $q->whereIn('service_category_id', $assignedCenter);
            }
        ];

        $latestBookings = Booking::with($with)->ofCenters($assignedCenter)
                            ->latest()
                            ->take(5)
                            ->get();
        $pendingBookings = Booking::with($with)->ofCenters($assignedCenter)
                            ->where('status', Booking::PENDING)
                            ->latest()
                            // ->take(10)
                            ->get();

        $bookingsToday = Booking::with($with)->ofCenters($assignedCenter)
                            ->whereDate('available_date', today()->toDateString())
                            ->whereNotNull('paid_at')
                            ->get();

        // $noOfTransactions = Booking::with($with)->ofCenters($assignedCenter)
        // ->whereHas('bookingCenters', function($query) {
        //     $query->whereMonth('available_date', Carbon::now()->month);
        // })->count();

        $noOfTransactions = Booking::with($with)->ofCenters($assignedCenter)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->count();

        $completedTransactions = Booking::with($with)->ofCenters($assignedCenter)
        ->where('status', Booking::COMPLETED)
        ->whereHas('bookingCenters', function($query) {
            $query->whereMonth('available_date', Carbon::now()->month);
        })->count();

        $bookings2 = Booking::with($with)->ofCenters($assignedCenter)
        ->whereHas('bookingCenters', function($query) {
            $query->whereMonth('available_date', Carbon::now()->month);
        })->latest()->get();

        $total = 0;

        if($bookings2) {
            foreach($bookings2 as $key => $booking) {
                if(request('center')) {
                    foreach($booking->bookingCenters as $center) {
                        if($booking->mode_of_payment == Booking::CREDITCARD) {
                            $total = (float)$total + (float)$center->amount_paid;
                        } else {
                            $total = (float)$total + (float)$center->center_discounted_totalAmount;
                        }
                    }
                } else {
                    if($booking->mode_of_payment == Booking::CREDITCARD) {
                        $total = (float)$total + (float)$booking->amount_paid;
                    } else {
                        $total = (float)$total + (float)$booking->discounted_total_amount;
                    }
                }
            }
        }

        return view('center.index', compact('userLogged', 'pendingBookings', 'latestBookings', 'bookingsToday', 'noOfTransactions', 'completedTransactions', 'total'));
    }

    /**
     * Fetch notification for center users.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function notifications(Request $request)
    {
        $userLogged = auth()->user();
        $notifications = $userLogged->unreadNotifications;
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
