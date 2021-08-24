<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);

        return view('admin.patients.index', compact('patients'));
        
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()
        ->where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('mobile', 'LIKE', "%{$search}%")
        ->get();

        // Return the search view with the resluts compacted
        return view('admin.patients.index', compact('patients'));
    }
}
