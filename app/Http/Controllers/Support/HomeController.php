<?php

namespace App\Http\Controllers\Support;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display dashboard of support users.
     * 
     */
    public function index()
    {
        $bookings = Booking::latest()->limit(10)->get();

        $noOfTransactions = Booking::whereMonth('created_at', Carbon::now()->month)->count();

        // $noOfTransactions = Booking::whereHas('bookingCenters', function($query) {
        //     $query->whereMonth('preferred_date', Carbon::now()->month);
        //     $query->orWhereMonth('available_date', Carbon::now()->month);
        // })->count();

        $completedTransactions = Booking::where('status', Booking::COMPLETED)
        ->whereHas('bookingCenters', function($query) {
            $query->whereMonth('available_date', Carbon::now()->month);
        })->count();

        $bookings2 = Booking::whereHas('bookingCenters', function($query) {
            $query->whereMonth('available_date', Carbon::now()->month);
        })->latest()->get();

        $total = 0;

        if($bookings2) {
            foreach($bookings2 as $key => $booking) {
                if(request('center')) {
                    foreach($booking->bookingCenters as $center) {
                        if($booking->mode_of_payment == Booking::CREDITCARD) {
                            $total = $total + $center->amount_paid;
                        } else {
                            $total = $total + $center->center_discounted_totalAmount;
                        }
                    }
                } else {
                    if($booking->mode_of_payment == Booking::CREDITCARD) {
                        $total = $total + $booking->amount_paid;
                    } else {
                        $total = $total + $booking->discounted_total_amount;
                    }
                }
            }
        }
        return view('support.index', compact('bookings','noOfTransactions', 'completedTransactions', 'total'));
    }
}
