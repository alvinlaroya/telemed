<?php

namespace App\Http\Controllers\Admin;

use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class LeaveController extends Controller 
{
	/**
	 * Display a list of leave.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function index(Request $request) 
	{
		if ($request->ajax()) {
			return Leave::get();
		}
	}
}