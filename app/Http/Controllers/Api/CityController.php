<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function getByProvince($provinceId)
    {
        return DB::table('cities')->where('province_id', $provinceId)->orderBy('name')->get();
    }

}
