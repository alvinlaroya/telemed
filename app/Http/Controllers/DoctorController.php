<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Patient;
use App\CorporateAccount;
use App\HmoAccreditation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    private function getAuthenticatedUser()
    {
        $authUser = Auth::user()->with([
            'patient' => function($query) {
                $query->select([
                    'id',
                    'user_id',
                    'first_name',
                    'last_name',
                    'mobile',
                    'pwd_senior',
                    'id_number'
                ]);
            }
        ])->find(Auth::id());

        return $authUser;
    }

    /**
     * Display form for booking doctor appointment.
     * 
     */
    public function booking()
    {
        $doctor = null;
        if (session()->has('doctor')) {
            $doctor = Doctor::find(session('doctor'));
        }
        $customFields = \App\DoctorForm::orderBy('order')->get();

        // Settings
        $maintenanceMode = \App\Setting::getName('doctor_maintenance_mode');
        $maintenanceModeText = \App\Setting::getName('doctor_maintenance_mode_text');
        $settings = array(
            'maintenance' => $maintenanceMode['value'],
            'notice' => $maintenanceModeText['value']
        );

        $user = Auth::user();
        $auth_user = null;
        $message = '';

        if ($user) {
            $auth_user = $this->getAuthenticatedUser();
        }

        if ($auth_user) {
            $message = 'logged_in';
            return view('book-doctor-new', compact('customFields', 'doctor', 'settings', 'message'));
        }

        // return view('book-doctor', compact('customFields', 'doctor'));
        return view('book-doctor-new', compact('customFields', 'doctor', 'settings', 'message'));
    }

    public function bookingLabOnBehalfOfPatient(Request $request)
    {        
        $patient_id = $request->patient_id;
    
    
            $hmos = HmoAccreditation::latest()->get();
            $corporateAccounts = CorporateAccount::latest()->get();
    
            // Settings
            $maintenanceMode = \App\Setting::getName('service_maintenance_mode');
            $maintenanceModeText = \App\Setting::getName('service_maintenance_mode_text');
            $settings = array(
                'maintenance' => $maintenanceMode['value'],
                'notice' => $maintenanceModeText['value']
            );
    
            return view('booking-service', compact('settings', 'hmos', 'corporateAccounts', 'patient_id'));
    }


    public function bookingOnBehalfOfPatient(Request $request)
    {        
        $doctor = null;
        if (session()->has('doctor')) {
            $doctor = Doctor::find(session('doctor'));
        }
        $customFields = \App\DoctorForm::orderBy('order')->get();

        // Settings
        $maintenanceMode = \App\Setting::getName('doctor_maintenance_mode');
        $maintenanceModeText = \App\Setting::getName('doctor_maintenance_mode_text');
        $settings = array(
            'maintenance' => $maintenanceMode['value'],
            'notice' => $maintenanceModeText['value']
        );

       /*  $user = User::find($request->patient_id); */

        $auth_user = null;
        $message = '';

        $auth_user = Patient::select('id', 'user_id', 'first_name', 'last_name', 'mobile', 'pwd_senior', 'id_number')->where('id', $request->patient_id);

        if ($auth_user) {
            $message = 'logged_in';
            $patient_id = $request->patient_id;
            return view('book-doctor-new', compact('customFields', 'doctor', 'settings', 'message', 'patient_id'));
        }

        // return view('book-doctor', compact('customFields', 'doctor'));
        return view('book-doctor-new', compact('customFields', 'doctor', 'settings', 'message'));
    }

    /**
     * Show specified doctors profile.
     * 
     * @param  mixed $slug
     */
    public function profile($slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        
        return view('doctor-profile', compact('doctor'));
    }

    /**
     * Create a session for making an appointment for specified doctor.
     * 
     * @param  \App\Doctor  $doctor
     */
    public function makeAppointment(Doctor $doctor)
    {
        session(['doctor' => $doctor->id]);

        return redirect()->route('book-doctor');
    }

    /**
     * Display screening form for doctor appointment.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function screen(Request $request)
    {
        $screeningArray = $request->screening;
        $screenings = array();
        if(count($screeningArray) > 0){
            $screenings = $this->reGenerateArray($screeningArray);
            // foreach ($screeningArray as $key => $item) {
            //     if(isset($item['answer']) && count((array)$item['answer']) > 0){
            //         $screeningArray[$key]['answer'] = array_values($item['answer'])[0] == 1 ? 'yes' : 'no';
            //     }
            //     if(isset($item['type']) && $item['type'] == 'nested'){
            //         if(isset($item['children']) && count((array)$item['children']) > 0 ){
            //         }
            //     }
            // }
            dd($screenings);
        }
    }

    /**
     * Regenerate array for screening form answers.
     * 
     */
    public function reGenerateArray(&$arr)
    {
        array_walk($arr, function (&$v, $k ) {
            if($k === 'answer') {
                $val = array_values($v)[0];
                if($val == 1){
                    $v = 'yes';
                }elseif($val == 'p'){
                    $v = 'positive';
                }elseif($val == 'n'){
                    $v = 'negative';
                }else{
                    $v = 'no';
                }
            } elseif("array" == gettype($v)) {
                $this->reGenerateArray($v);
            }
        });
        return $arr;
    }

    public function agreeToTermsAndCondition()
    {
        auth()->user()->update(['agreed_to_terms' => 1]);
        return response()->json(['status' => 200]);
    }
}
