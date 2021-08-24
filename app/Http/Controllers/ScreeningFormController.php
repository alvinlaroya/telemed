<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Screening controller for testing purposes only.
 */
class ScreeningFormController extends Controller
{
    /**
     * Display screening form.
     */
    public function index()
    {
        return view('screening-form');
    }

    /**
     * Display fallrisk form.
     */
    public function fallrisk()
    {
        return view('fallrisk-form');
    }

    /**
     * Save service screening form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveServiceScreening(Request $request)
    {
        dd($request->all());
    }

    /**
     * Save fallrisk screening form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveFallriskScreening(Request $request)
    {
        dd($request->all());
    }
}
