<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HmoAccreditation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HmoAccreditationsController extends Controller
{
    /**
     * Display a listing of the hmo.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        // If ajax from select2 dropdown, use different method to return value
        if($request->ajax()){
            $values = explode(',', $request->selectedValue);
            $hmoAccreditations = HmoAccreditation::latest()->get()->map(function($item, $key) use ($values){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => in_array($item->id, $values) ? true : false
                );
            })->toArray();
            return response()->json($hmoAccreditations);
        }else{
            $hmoAccreditations = HmoAccreditation::latest()->paginate(10);
            return view('admin.hmo-accreditations.index', compact('hmoAccreditations'));
        }
    }

    /**
     * Show the form for creating a new hmo.
     */
    public function create()
    {
        return view('admin.hmo-accreditations.create');
    }

    /**
     * Store a newly created hmo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'accredName' => 'required|unique:hmo_accreditations,name',
        ]);

        $hmoAccreditation = new HmoAccreditation;
        $hmoAccreditation->name = $request->accredName;
        $hmoAccreditation->description = $request->description;
        $hmoAccreditation->save();

        // If ajax from quick create, use different method to return value
        if($request->ajax()){
            return response()->json(array('data' => $hmoAccreditation, 'msg' => 'Successfully added accreditation!'), 200);
        }else{
            return redirect()->route('admin.hmo-accreditations.index')
                            ->with('success', 'Successfully added accreditation!');
        }
    }

    /**
     * Display the specified hmo.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified hmo.
     *
     * @param  \App\HmoAccreditation  $hmoAccreditation
     */
    public function edit(HmoAccreditation $hmoAccreditation)
    {
        return view('admin.hmo-accreditations.edit', compact('hmoAccreditation'));
    }

    /**
     * Update the specified hmo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HmoAccreditation  $hmoAccreditation
     */
    public function update(Request $request, HmoAccreditation $hmoAccreditation)
    {
        $data = $request->validate([
            'accredName' => [
                'required',
                Rule::unique('hmo_accreditations', 'name')->ignore($hmoAccreditation->id),
            ],
        ]);

        $hmoAccreditation = $hmoAccreditation;
        $hmoAccreditation->name = $request->accredName;
        $hmoAccreditation->description = $request->description;
        $hmoAccreditation->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated accreditation!');
    }

    /**
     * Remove the specified hmo from storage.
     *
     * @param  \App\HmoAccreditation  $hmoAccreditation
     */
    public function destroy(HmoAccreditation $hmoAccreditation)
    {
        if(count($hmoAccreditation->doctors) > 0){
            return redirect()->back()
                        ->with('error', 'Unable to delete. Accreditation has doctors assigned!');
        }

        $hmoAccreditation->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
