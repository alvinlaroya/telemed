<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;

class BarangayController extends Controller
{

    public function getByCity($cityId)
    {
        return DB::table('barangays')->where('city_id', $cityId)->orderBy('name')->get();
    }

}
