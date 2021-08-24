<?php

namespace App\Exports;

use App\Booking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;


class AllCenterPaymentReport implements FromView
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

        return view('exports.all-center-payment-report', compact('bookings', 'total'));
    }
}
