<?php

namespace App\Http\Controllers\Admin;

use App\Imports\UsersImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DoctorUploadController extends Controller
{

    public function create()
    {
        return view('admin.doctors.bulk-upload');
    }

    public function import()
    {
        $this->validate(request(), [
            'excel' => ['required', 'file', 'mimes:xlsx']
        ]);
        
        Excel::import(new UsersImport, request()->file('excel'));

        return redirect()->route('admin.doctors.bulk-upload.data')->with('message', 'Data has been uploaded successfully!');
    }

}
