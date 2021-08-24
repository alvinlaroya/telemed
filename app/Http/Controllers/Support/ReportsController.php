<?php

namespace App\Http\Controllers\Support;

use App\Booking;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllCenterTransactionReport;

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

        return view('support.reports.transactions', compact('bookings','centers'));
    }
}
