<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the specialization.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        // If ajax from select2 dropdown, use different method to return value
        if($request->ajax()){
            $values = explode(',', $request->selectedValue);
            $parents = Specialization::whereNull('parent_id')->orderBy('name')->get();
            $childs = Specialization::whereNotNull('parent_id')->orderBy('name')->get();
            $specsArray = array();
            if(count($parents) > 0){
                foreach($parents as $key => $item){
                    $specsArray[] = array(
                        'id' => $item->id,
                        'text' => '<strong style="color:#555">'.$item->name.'</strong>',
                        'selected' => in_array($item->id, $values) ? true : false
                    );
                    if(count($childs) > 0){
                        foreach ($childs as $key => $child) {
                            if($child->parent_id == $item->id){
                                $specsArray[] = array(
                                    'id' => $child->id,
                                    'text' => '&nbsp;&nbsp;'.$child->name,
                                    'selected' => in_array($child->id, $values) ? true : false
                                );
                            }
                        }
                    }
                }
            }
            return response()->json($specsArray);
        }else{
            $specializations = Specialization::latest()->paginate(10);
            return view('admin.specializations.index', compact('specializations'));
        }
    }

    /**
     * Show the form for creating a new specialization.
     *
     */
    public function create()
    {
        return view('admin.specializations.create');
    }

    /**
     * Store a newly created specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'specName' => 'required|unique:specializations,name',
        ]);

        $specialization = new Specialization;
        $specialization->name = $request->specName;
        $specialization->description = $request->description;
        $specialization->save();

        // If ajax from quick create, use different method to return value
        if($request->ajax()){
            return response()->json(array('data' => $specialization, 'msg' => 'Successfully added specialization!'), 200);
        }else{
            return redirect()->route('admin.specializations.index')
                            ->with('success', 'Successfully added specialization!');
        }
    }

    /**
     * Display the specified specialization.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified specialization.
     *
     * @param  \App\Specialization  $specialization
     */
    public function edit(Specialization $specialization)
    {
        return view('admin.specializations.edit', compact('specialization'));
    }

    /**
     * Update the specified specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialization  $specialization
     */
    public function update(Request $request, Specialization $specialization)
    {
        $data = $request->validate([
            'specName' => [
                'required',
                Rule::unique('specializations', 'name')->ignore($specialization->id),
            ],
        ]);

        $specialization = $specialization;
        $specialization->name = $request->specName;
        $specialization->description = $request->description;
        $specialization->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated specialization!');
    }

    /**
     * Remove the specified specialization from storage.
     *
     * @param  \App\Specialization  $specialization
     */
    public function destroy(Specialization $specialization)
    {
        if(count($specialization->doctors) > 0){
            return redirect()->back()
                        ->with('error', 'Unable to delete. Specialization has doctors assigned!');
        }

        $specialization->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
