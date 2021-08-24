<?php

namespace App\Exports;

use App\Booking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class CenterPaymentReport implements FromView
{
    public function __construct($bookings, $total)
    {
        $this->bookings = $bookings;
        $this->total = $total;
    }

    public function view(): View
    {
        $bookings = $this->bookings;
        $total = $this->total;
        return view('exports.center-payment-report', compact('bookings', 'total'));
    }
}
