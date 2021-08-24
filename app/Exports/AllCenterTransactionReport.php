<?php

namespace App\Exports;

use App\Booking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllCenterTransactionReport implements FromView
{
    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function view(): View
    {
        $bookings = $this->bookings;
        return view('exports.all-center-trans-report', compact('bookings'));
    }
}
