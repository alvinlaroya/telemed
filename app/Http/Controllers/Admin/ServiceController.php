<?php

namespace App\Http\Controllers\Admin;

use App\BookingService;
use App\Service;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Display a listing of sevices.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $center = $request->filled('center') ? $request->center : null;
        $services = Service::where(function($query) use ($search, $status){
                $query->when($search, function($query) use($search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->when($status === "1" || $status === "0", function($query) use($status) {
                    $query->where('status', $status);
                });
            })
	        ->when($center, function($query) use($center){
	            $query->whereHas('category', function($query) use ($center){
                    $query->where('id', $center);
                });
	        })
	        ->latest()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $parents = ServiceCategory::whereNull('parent_id')->get();
        return view('admin.services.create', compact('parents'));
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:services',
            'category' => 'required',
            'price' => 'required',
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->product_code = $request->productCode;
        $service->description = $request->description;
        $service->category_id = $request->category;
        $service->price = $request->price;
        $service->eligible = $request->eligible ? 1 : 0;
        $service->status = $request->status ? 1 : 0;
        $service->save();

        return redirect()->route('admin.services.index')
                        ->with('success', 'Successfully added service!');
    }

    /**
     * Display the specified service.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  \App\Service  $service
     */
    public function edit(Service $service)
    {
        $parents = ServiceCategory::whereNull('parent_id')->get();
        return view('admin.services.edit', compact('service', 'parents'));
    }

    /**
     * Update the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('services')->ignore($service->id),
            ],
            'category' => 'required',
            'price' => 'required',
        ]);

        $service->name = $request->name;
        $service->product_code = $request->productCode;
        $service->description = $request->description;
        $service->category_id = $request->category;
        $service->price = $request->price;
        $service->eligible = $request->eligible ? 1 : 0;
        $service->status = $request->status ? 1 : 0;
        $service->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated service!');
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  \App\Service  $service
     */
    public function destroy(Service $service)
    {
        $hasTransactions = BookingService::where('service_id', $service->id)->get();
        if($hasTransactions->count() > 0) {
            return redirect()->back()
                        ->with('error', 'Unable to delete. Service has transactions!');
        }

        $service->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
