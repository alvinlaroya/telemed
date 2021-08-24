<?php

namespace App\Http\Controllers\Center;

use App\Service;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display list for services.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $assignedCenter = null;
        $assignedCenter = $user->assignedCentersArr();
        $serviceCenters = ServiceCategory::whereIn('id', $assignedCenter)->get();

        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $center = $request->filled('center') ? $request->center : null;

        if($center) {
            $assignedCenter = [0=>(int)$center];
        }

        $query = Service::where(function($query) use ($search, $status){
            $query->when($search, function($query) use($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->when($status === "1" || $status === "0", function($query) use($status) {
                $query->where('status', $status);
            });
        })
        ->whereIn('category_id', $assignedCenter);
        $query = $query->orderBy('name');
        $query = $query->paginate(50);
        $services = $query;
        // dd($query);

        return view('center.services.index', compact('services', 'serviceCenters'));
    }
}
