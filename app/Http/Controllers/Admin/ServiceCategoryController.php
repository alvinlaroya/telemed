<?php

namespace App\Http\Controllers\Admin;

use App\BookingCenter;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the service category.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        // If ajax from select2 dropdown, use different method to return value
        if($request->ajax()){
            $isMultilple = $request->multiple === true || $request->multiple === "true" ? true : false;
            $selectedValue = $request->selectedValue;
            if($isMultilple){
                $selectedValue = explode(',', $request->selectedValue);
            }
            $serviceCategories = ServiceCategory::orderBy('name')->get()->map(function($item, $key) use ($request, $isMultilple, $selectedValue){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => ($isMultilple ? in_array($item->id, $selectedValue) : $selectedValue == $item->id) ? true : false
                );
            })->toArray();
            return response()->json($serviceCategories);
        }else{
            $search = $request->filled('search') ? $request->search : null;
            $status = $request->filled('status') ? $request->status : null;
            $serviceCategories = ServiceCategory::where(function($query) use ($search, $status){
                $query->when($search, function($query) use($search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->when($status === "1" || $status === "0", function($query) use($status) {
                    $query->where('status', $status);
                });
            })
            ->orderBy('name')->paginate(10);
            return view('admin.service-categories.index', compact('serviceCategories'));
        }
    }

    /**
     * Show the form for creating a new service category.
     */
    public function create()
    {
        $parents = ServiceCategory::whereNull('parent_id')->get();
        return view('admin.service-categories.create', compact('parents'));
    }

    /**
     * Store a newly created service category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $rules = array(
            'categoryName' => 'required|unique:service_categories,name',
            'email' => 'nullable|email',
        );
        if($request->filled('email_to_receive_notifications')){
            $rules['email_to_receive_notifications'] = [new CommaSeparatedEmails];
        }
        if($request->filled('mobile_to_receive_notifications')){
            $rules['mobile_to_receive_notifications'] = [new CommaSeparatedPhones];
        }
        $data = $request->validate($rules);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $category = new ServiceCategory;
        $category->name = $request->categoryName;
        $category->description = $request->description;
        $category->parent_id = $request->filled('parent_id') ? $request->parent_id : null;
        $category->email = $request->email;
        $category->telephone = $request->telephone;
        $category->email_to_receive_notifications = $request->email_to_receive_notifications;
        $category->mobile_to_receive_notifications = $request->mobile_to_receive_notifications;
        $category->status = $request->status;
        $category->save();

        // If ajax from quick create, use different method to return value
        if($request->ajax()){
            return response()->json(array('data' => $category, 'msg' => 'Successfully added category!'), 200);
        }else{
            return redirect()->route('admin.service-categories.index')
                            ->with('success', 'Successfully added category!');
        }
    }

    /**
     * Display the specified service category.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified service category.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        $parents = ServiceCategory::where('id', '!=', $serviceCategory->id)->whereNull('parent_id')->get();
        return view('admin.service-categories.edit', compact('serviceCategory', 'parents'));
    }

    /**
     * Update the specified service category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceCategory  $serviceCategory
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $rules = array(
            'categoryName' => [
                'required',
                Rule::unique('service_categories', 'name')->ignore($serviceCategory->id),
            ],
            'email' => 'nullable|email',
        );
        if($request->filled('email_to_receive_notifications')){
            $rules['email_to_receive_notifications'] = [new CommaSeparatedEmails];
        }
        if($request->filled('mobile_to_receive_notifications')){
            $rules['mobile_to_receive_notifications'] = [new CommaSeparatedPhones];
        }
        $data = $request->validate($rules);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $category = $serviceCategory;
        $category->name = $request->categoryName;
        $category->description = $request->description;
        $category->parent_id = $request->filled('parent_id') ? $request->parent_id : null;
        $category->email = $request->email;
        $category->telephone = $request->telephone;
        $category->email_to_receive_notifications = $request->email_to_receive_notifications;
        $category->mobile_to_receive_notifications = $request->mobile_to_receive_notifications;
        $category->status = $request->status;
        $category->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated category!');
    }

    /**
     * Remove the specified service category from storage.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        $hasTransactions = BookingCenter::where('service_category_id', $serviceCategory->id)->get();
        if($hasTransactions->count() > 0) {
            return redirect()->back()
                        ->with('error', 'Unable to delete. Category has transactions!');
        }

        if(count($serviceCategory->services) > 0){
            return redirect()->back()
                        ->with('error', 'Unable to delete. Category has services assigned!');
        }

        $serviceCategory->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
