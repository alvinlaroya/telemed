<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{

    public function all()
    {
        return DB::table('regions')->orderBy('name')->get();
    }

}
