<?php

namespace App\Http\Controllers\Medical;

use App\Consultation;
use App\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display dashboard for medical users.
     * 
     */
    public function index()
    {
    	return view('medical.index');
    }

}