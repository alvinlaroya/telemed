<?php

namespace App\Http\Controllers\Center;

use App\Booking;
use App\BookingService;
use App\Service;
use App\ServiceCategory;
use App\Patient;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CenterTransactionReport;
use App\Exports\CenterPaymentReport;

class ReportsController extends Controller
{

    /**
     * Display reports for transactions.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function transactions(Request $request)
    {

        $user = $request->user();
        $centerUser = $user->center();
        if(request('center')) {
            $assignedCenter = [0=>(int)request('center')];
        } else {
            $assignedCenter = $user->assignedCentersArr();
        }
        $centers = ServiceCategory::orderBy('name')->get();
        $search = $request->filled('search') ? $request->search : null;
        $date = $request->filled('date') ? Carbon::parse($request->date)->copy()->toDateString() : null;
        $status = $request->filled('status') ? $request->status : null;

        $bookings = Booking::with([
            'bookingCenters' => function($q) use ($assignedCenter) {
                $q->whereIn('service_category_id', $assignedCenter);
            }
        ])->ofCenters($assignedCenter)
        ->when($search, function($query) use($search) {
            $query->where('booking_reference_no', 'LIKE', "%$search%")
                ->orWhereHas('patient', function($q) use($search) {
                $q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
            });
        })
        ->when($date, function($query) use($date) {
            $query->whereHas('bookingCenters', function($q) use($date) {
                $q->whereDate('available_date', $date);
            });
        })
        ->when($status, function($query) use($status){
            $query->where('status', $status);
        })
        ->with('bookingServices')
        ->latest()->paginate(15);

        if($request->filled('excelDownload')) {
            $name = "center-transactions-".now().".xlsx";
            return Excel::download(new CenterTransactionReport($bookings), $name);
        }

        return view('center.reports.transactions', compact('bookings','centers'));
    }

    /**
     * Display reports for payments.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function payments(Request $request)
    {
        $user = $request->user();
        $centerUser = $user->center();
        $centers = ServiceCategory::orderBy('name')->get();
        $search = $request->filled('search') ? $request->search : null;
        $mop = $request->filled('mop') ? $request->mop : null;
        $center = $request->filled('center') ? $request->center: null;
        $date = $request->filled('date') ? explode(' - ', $request->date) : null;
        $status = $request->filled('status') ? $request->status : null;
        if(request('center')) {
            $assignedCenter = [0=>(int)request('center')];
        } else {
            $assignedCenter = $user->assignedCentersArr();
        }

        if($date){
            $date[0] = Carbon::parse($date[0])->copy()->toDateString();
            $date[1] = Carbon::parse($date[1])->copy()->toDateString();
        }

        $bookings = Booking::with([
            'bookingCenters' => function($q) use ($assignedCenter) {
                $q->whereIn('service_category_id', $assignedCenter);
            }
        ])->ofCenters($assignedCenter)
        ->when($mop, function($query) use($mop) {
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
            $name = "center-payment-".now().".xlsx";
            return Excel::download(new CenterPaymentReport($bookings, $total), $name);
        }

        return view('center.reports.payments', compact('bookings', 'centers', 'total'));
    }

    /**
     * Display reports for audit logs.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function auditLogs(Request $request)
    {
        $centers = ServiceCategory::orderBy('name')->get();
    	$user = $request->user();

        if(request('center')) {
            $assignedCenter = [0=>request('center')];
        } else {
            $assignedCenter = $user->assignedCentersArr();
        }
        $search = $request->search;
    	$query = Booking::with([
            'bookingCenters' => function($q) use ($assignedCenter) {
                $q->whereIn('service_category_id', $assignedCenter);
            }
        ])->ofCenters($assignedCenter);

        if ($request->filled('search')) {
            $search = $request->search;
            $query = $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($q) use ($search) {
                    $q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
                })
                ->orWhereHas('bookingServices', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('booking_reference_no', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query = $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query = $query->whereHas('bookingCenters', function($q) use ($request) {
                $q->whereDate('available_date', $request->date);
            });
        }

        $bookings = $query->latest()->paginate(50);

        return view('center.reports.auditlogs', compact('bookings', 'assignedCenter'));
    }
}
