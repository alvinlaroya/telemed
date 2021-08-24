<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\BookingService;
use App\Service;
use App\ServiceCategory;
use App\Patient;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllCenterTransactionReport;
use App\Exports\AllCenterPaymentReport;
use App\Exports\AllPatientTransactionReport;

class ReportsController extends Controller
{
    /**
     * Display reports for transactions.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function transactions(Request $request)
    {
        $centers = ServiceCategory::orderBy('name')->get();
        $search = $request->filled('search') ? $request->search : null;
        $center = $request->filled('center') ? $request->center: null;
        $date = $request->filled('date') ? Carbon::parse($request->date)->copy()->toDateString() : null;
        $status = $request->filled('status') ? $request->status : null;


        $bookings = Booking::when($search, function($query) use($search) {
            $query->where('booking_reference_no', 'LIKE', "%$search%")
                ->orWhereHas('patient', function($q) use($search) {
                $q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
            });
        })
        ->when($center, function($query) use($center) {
            $query->whereHas('bookingCenters', function($q) use($center) {
                $q->where('service_category_id', '=', $center);
            });
        })
        ->when($date, function($query) use($date) {
            $query->whereHas('bookingCenters', function($q) use($date) {
                $q->whereDate('available_date', '=', $date);
            });
        })
        ->when($status, function($query) use($status){
            $query->where('status', $status);
        })
        ->with('bookingCenters')
        ->with('bookingServices')
        ->latest()->paginate(15);

        if($request->filled('excelDownload')) {
            $name = "all-center-transactions-".now().".xlsx";
            return Excel::download(new AllCenterTransactionReport($bookings), $name);
        }

        return view('admin.reports.transactions', compact('bookings','centers'));
    }

    /**
     * Display reports for payments.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function payments(Request $request)
    {
        $centers = ServiceCategory::orderBy('name')->get();
        $search = $request->filled('search') ? $request->search : null;
        $mop = $request->filled('mop') ? $request->mop : null;
        $center = $request->filled('center') ? $request->center: null;
        $date = $request->filled('date') ? explode(' - ', $request->date) : null;
        $status = $request->filled('status') ? $request->status : null;

        if($date){
            $date[0] = Carbon::parse($date[0])->copy()->toDateString();
            $date[1] = Carbon::parse($date[1])->copy()->toDateString();
        }

        $bookings = Booking::when($mop, function($query) use($mop) {
            $query->where('mode_of_payment', $mop);
        })
        ->when($search, function($query) use($search) {
            $query->where('booking_reference_no', 'LIKE', "%$search%")
                ->orWhereHas('patient', function($q) use($search) {
                $q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
            });
        })
        ->when($center, function($query) use($center) {
            $query->whereHas('bookingCenters', function($q) use($center) {
                $q->where('service_category_id', '=', $center);
            });
        })
        ->when($date, function($query) use($date) {
            $query->whereDate('paid_at', '=', $date);
        })
        ->when($center, function($query) use($center) {
            $query->whereHas('bookingCenters', function($q) use($center) {
                $q->where('service_category_id', '=', $center);
            });
        })
        ->with('bookingCenters')
        ->with('bookingServices')
        ->latest()->paginate(15);

        $total = 0;
        if($bookings) {
            foreach($bookings as $key => $booking) {
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

        if($request->filled('excelDownload')) {
            $name = "all-center-payments-".now().".xlsx";
            return Excel::download(new AllCenterPaymentReport($bookings, $total), $name);
        }

        return view('admin.reports.payments', compact('bookings', 'centers', 'total'));
    }

    /**
     * Display reports for patient transactions.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function patientTransactions(Request $request)
    {
        $search = $request->filled('search') ? $request->search : null;
        $date = $request->filled('date') ? explode(' - ', $request->date) : null;

        if($date){
            $date[0] = Carbon::parse($date[0])->copy()->toDateString();
            $date[1] = Carbon::parse($date[1])->copy()->toDateString();
        }

        $patients = Patient::where('type', Patient::BOOKING)
        ->when($search, function($query) use($search) {
            $query->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
        })
        ->when($date, function($query) use($date) {
            $query->whereBetween('created_at', $date);
        })
        ->withCount('bookings')
        ->latest()->paginate(15);

        if($request->filled('excelDownload')) {
            $name = "all-patients-transactions-".now().".xlsx";
            return Excel::download(new AllPatientTransactionReport($patients), $name);
        }


        return view('admin.reports.patient-transactions', compact('patients'));
    }

    /**
     * Display reports for patient transaction details.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     */
    public function patientTransactionDetails(Request $request, Patient $patient)
    {
        $centers = ServiceCategory::orderBy('name')->get();
        $search = $request->filled('search') ? $request->search : null;
        $center = $request->filled('center') ? $request->center: null;
        $date = $request->filled('date') ? Carbon::parse($request->date)->copy()->toDateString() : null;
        $status = $request->filled('status') ? $request->status : null;


        $bookings = Booking::where('patient_id', $patient->id)
        ->when($search, function($query) use($search) {
            $query->where('booking_reference_no', 'LIKE', "%$search%");
        })
        ->when($center, function($query) use($center) {
            $query->whereHas('bookingCenters', function($q) use($center) {
                $q->where('service_category_id', '=', $center);
            });
        })
        ->when($date, function($query) use($date) {
            $query->whereHas('bookingCenters', function($q) use($date) {
                $q->whereDate('available_date', '=', $date);
            });
        })
        ->when($status, function($query) use($status){
            $query->where('status', $status);
        })
        ->with('bookingCenters')
        ->with('bookingServices')
        ->latest()->paginate(15);

        return view('admin.reports.patient-transaction-details', compact('centers', 'bookings', 'patient'));
    }

    /**
     * Display reports for center transactions.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function centerTransactions(Request $request)
    {
        return view('admin.reports.center-transactions');
    }
}
