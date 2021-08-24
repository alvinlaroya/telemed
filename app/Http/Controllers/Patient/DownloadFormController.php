<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadFormController extends Controller
{
    public function viewChiefComplaint()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = base_path("/public/download_form/Chief_Complaint_Form.xlsx");
 
        $headers = array(
            'Content-Type: application/xlsx',
        );

       /*  return response()->download($file, 'sample_form.pdf', $headers); */
        return response()->file($file, $headers);
    }

    public function downloadChiefComplaint()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = base_path("/public/download_form/Chief_Complaint_Form.xlsx");
 
        $headers = array(
            'Content-Type: application/xlsx',
        );

        return response()->download($file, 'chief_complaint.xlsx', $headers);
    }

    public function downloadMedicalHistory()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = base_path("/public/download_form/Patient_Medical_History.xlsx");
 
        $headers = array(
            'Content-Type: application/xlsx',
        );

        return response()->download($file, 'patient_medical_history.xlsx', $headers);
    }

    public function downloadFormForIT()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = base_path("/public/download_form/Forms_for_IT__(2).pptx");
 
        $headers = array(
            'Content-Type: application/pptx',
        );

        return response()->download($file, 'form_for_it.pptx', $headers);
    }
}
