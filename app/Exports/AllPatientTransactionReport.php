<?php

namespace App\Exports;

use App\Booking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllPatientTransactionReport implements FromView
{
    public function __construct($patients)
    {
        $this->patients = $patients;
    }

    public function view(): View
    {
        $patients = $this->patients;

        return view('exports.all-patient-transaction', compact('patients'));
    }
}
