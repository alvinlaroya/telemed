<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadFormController extends Controller
{
    public function downloadEnrollmentForm()
    {   
        //PDF file is stored under project/public/download/info.pdf
        $file = base_path("/public/download_form/Doctor_Application_Form_v4.xlsm");
 
        $headers = array(
            'Content-Type: application/xlsm',
        );

       

        return response()->download($file, 'enrollment_form.xlsm', $headers);
    }
}
