<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    
    public function all()
    {
        return DB::table('provinces')->orderBy('name')->get();
    }

    public function allJson(Request $request)
    {
        return DB::table('provinces')->orderBy('name')->get()->map(function($item, $key) use ($request){
            return array(
                'id' => $item->id,
                'text' => $item->name,
                'selected' => $request->selectedValue == $item->id ? true : false
            );
        })->toArray();
        return response()->json($provinces);    }

    public function getByRegion($regionId)
    {
        return DB::table('provinces')->where('region_id', $regionId)->orderBy('name')->get();
    }

}
