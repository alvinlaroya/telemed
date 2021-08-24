<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Patient;
use App\PatientScreening;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class PatientScreeningController extends Controller
{
    /**
     * Generate screening pdf for specified patient.
     * 
     * @param  \App\Patient  $patient
     * @param  \App\PatientScreening  $screening
     */
    public function getScreeningPdf(Patient $patient, PatientScreening $screening)
    {
        if($screening->patient != $patient){
            abort(404);
        }
        view()->share([
            'patient' => $patient,
            'screening' => (array)$screening->data,
            'fallrisk' => (array)$screening->fallrisk,
            'datetime' => $screening->created_at,
            // 'type' => 'booking'
        ]);
        // return view('pdf.patient-screening');
        $pdf = PDF::loadView('pdf.patient-screening');
        return $pdf->stream($patient->first_name."-".$patient->last_name."-Screening.pdf", array("Attachment" => false));
    }

    /**
     * Generate screening pdf for specified patient 2.
     */
    public function getScreeningPdf2(Patient $patient, PatientScreening $screening, Request $request)
    {
        $view = $request->view;
        if($screening->patient != $patient){
            abort(404);
        }
        view()->share([
            'patient' => $patient,
            'screening' => (array)$screening->data,
            'fallrisk' => (array)$screening->fallrisk,
            'datetime' => $screening->created_at,
            'center' => $screening->center,
            'from' => $screening->from,
            // 'type' => 'booking'
        ]);
        // return view('pdf.patient-screening-2');
        $pdf = $view == 'companion' ? PDF::loadView('pdf.patient-screening-companion') : PDF::loadView('pdf.patient-screening-2');
        return $pdf->stream($patient->first_name."-".$patient->last_name."-Screening.pdf", array("Attachment" => false));
    }

    /**
     * Regenerate array for screening form.
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

    /**
     * Save screening form in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveScreening(Request $request)
    {
        // dd($request->all());

        $birthdate = Carbon::createFromDate(
            $request->birthdate_year,
            $request->birthdate_month,
            $request->birthdate_day
        );

        $patient = Patient::where('first_name', $request->first_name)
                            ->where('last_name', $request->last_name)
                            ->where('middle_name', $request->middle_name)
                            ->where('mobile', $request->mobile)
                            ->where('email', $request->email)
                            ->where('city_id', $request->city)
                            ->whereDate('birthdate', $birthdate->toDateString())
                            ->first();
        if (!$patient) {
            $patient = new Patient;
            $patient->first_name = $request->first_name;
            $patient->last_name = $request->last_name;
            $patient->middle_name = $request->middle_name;
            $patient->mobile = $request->mobile;
            $patient->email = $request->email;
            $patient->city_id = $request->city;
            $patient->birthdate = $birthdate;
            $patient->gender = $request->gender;
            $patient->save();
        }

        if($patient){
            $screeningArray = $request->screening;
            $screenings = array();
            if(count($screeningArray) > 0){
                $screenings = $this->reGenerateArray($screeningArray);
            }
            $screening = new PatientScreening;
            $screening->patient_id = $patient->id;
            $screening->data = $request->has('screening') ? (array)$screenings : null;
            $screening->save();

            Mail::to($patient->email)->send(
                new \App\Mail\PatientScreening($patient, $screening)
            );
        }

        $screeningUrl = route('view-patient-screening', array('patient' => $patient, 'screening' => $screening));

        if($screeningUrl){
            return response()->json(array('data' => $screeningUrl, 'msg' => 'success'), 200);
        }else{
            return response()->json(array('data' => null, 'msg' => 'error'), 200);
        }
    }

    /**
     * Save screening form update.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveScreeningUpdate(Request $request)
    {
        $birthdate = Carbon::createFromDate(
            $request->birthdate_year,
            $request->birthdate_month,
            $request->birthdate_day
        );

        $firstname = $request->has('firstname') ? $request->firstname : $request->first_name;
        $lastname = $request->has('lastname') ? $request->lastname : $request->last_name;
        $middlename = $request->has('middlename') ? $request->middlename : $request->middle_name;

        $patient = Patient::where('first_name', $firstname)
                            ->where('last_name', $lastname)
                            ->where('middle_name', $middlename)
                            ->where('mobile', $request->mobile)
                            ->where('email', $request->email)
                            ->where('city_id', $request->city)
                            ->whereDate('birthdate', $birthdate->toDateString())
                            ->first();
        if (!$patient) {
            $patient = new Patient;
            $patient->first_name = $firstname;
            $patient->last_name = $lastname;
            $patient->middle_name = $middlename;
            $patient->mobile = $request->mobile;
            $patient->email = $request->email;
            $patient->city_id = $request->city;
            $patient->birthdate = $birthdate;
            $patient->gender = $request->gender;
            $patient->save();
        }

        if($patient){
            $screeningArray = $request->screening;
            $referralType = $request->filled('referralType') ? $request->referralType : null;
            // $screenings = array();
            // if(count($screeningArray) > 0){
            //     $screenings = $this->reGenerateArray($screeningArray);
            // }
            $screening = new PatientScreening;
            $screening->patient_id = $patient->id;
            // $screening->data = (count($screeningArray) > 0) ? (array)$screenings : null;
            $screening->data = (count($screeningArray) > 0) ? (array)$screeningArray : null;
            $screening->center = $request->center;
            $screening->from = $request->from;
            $screening->save();

            Mail::to($patient->email)->send(
                new \App\Mail\PatientScreening2($patient, $screening, null, $referralType)
            );
        }

        $screeningUrl = $patient ? route('view-patient-screening-2', array('patient' => $patient, 'screening' => $screening)) : null;

        if($screeningUrl){
            return response()->json(array('data' => $screeningUrl, 'msg' => 'success'), 200);
        }else{
            return response()->json(array('data' => null, 'msg' => 'error'), 200);
        }
    }

    /**
     * Next screening form occurence after a number of days.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function reScreeening(Patient $patient, Booking $booking, Request $request)
    {
        if($booking->patient_id != $patient->id){
            abort(404);
        }
        $encryptedIDs = md5("{$patient->id}-{$booking->id}");
        $hash = $request->hash;
        if($encryptedIDs !== $hash){
            abort(404);
        }
        $lastScreening = $patient->screenings()->latest()->first();
        if($lastScreening->created_at->format('Y-m-d') == Carbon::today()->format('Y-m-d')){
            abort(404);
        }
        if($patient->screening_exp){
            $screeningExpiration = date('Y-m-d', strtotime($patient->screening_exp));
            $expDay = date('Y-m-d', strtotime('+1 day', strtotime($screeningExpiration)));
            if(Carbon::today()->format('Y-m-d') > $expDay){
                abort(403, 'Your screening form has already expired');
            }
        }
        // dump($booking->bookingCenters);
        // dump($patient);
        // dump($booking);
        // dd('---- END ----');
        // \App\Jobs\RedoScreening::dispatch();
        return view('screening-single', compact('patient', 'booking', 'hash'));
    }

    /**
     * Submit the next screening form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function reScreeeningSubmit(Patient $patient, Booking $booking, Request $request)
    {
        if($patient){
            $screenings = (array) $request->screening;

            // get centers from this booking
            $lastScreening = $patient->screenings()->latest()->first();
            $validity_to = date('Y-m-d', strtotime('+4 days', strtotime($lastScreening->created_at)));
            $centers = $booking->bookingCenters->filter(function($item, $index) use ($validity_to){
                $scheduled_date = $item->available_date->format('Y-m-d');
                return ($scheduled_date > $validity_to && Carbon::today()->format('Y-m-d') < $scheduled_date);
            })->implode('name', ', ');
            
            $screening = new PatientScreening;
            $screening->patient_id = $patient->id;
            $screening->data = (count($screenings) > 0) ? $screenings : null;
            $screening->center = $centers;
            $screening->from = 'booking';
            $screening->save();

            $patient->screening_exp = null;
            $patient->save();

            Mail::to($patient->email)->send(
                new \App\Mail\PatientScreening2($patient, $screening, 'booking')
            );

            Mail::to($patient->email)->send(
                new \App\Mail\SecondPayment($patient, $booking)
            );
        }

        return redirect()->route('screening-thankyou');
    }

    /**
     * Display screening form thank you.
     */
    public function thankYou()
    {
        return view('screening-thankyou');
    }

    /**
     * Process when screening has failed.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function reScreeeningFailed(Request $request)
    {

        $patient = Patient::find($request->patient_id);
        $booking = Booking::find($request->booking_id);

        if($patient && $booking){

            // get centers from this booking
            $lastScreening = $patient->screenings()->latest()->first();
            $validity_to = date('Y-m-d', strtotime('+4 days', strtotime($lastScreening->created_at)));
            $bookingCenters = $booking->bookingCenters;
            if(count($bookingCenters) > 0){
                foreach($bookingCenters as $bookingCenter){
                    $scheduled_date = $bookingCenter->available_date->format('Y-m-d');
                    if(($scheduled_date > $validity_to && Carbon::today()->format('Y-m-d') < $scheduled_date)){
                        $bookingCenter->status = Booking::ONHOLD;
                        $bookingCenter->save();
                    }
                }
            }

            $screenings = (array) $request->screening;
            $screening = new PatientScreening;
            $screening->patient_id = $patient->id;
            $screening->data = (count($screenings) > 0) ? $screenings : null;
            $screening->center = $request->center;
            $screening->from = $request->from;
            $screening->save();

            $referralType = $request->filled('referralType') ? $request->referralType : null;

            Mail::to($patient->email)->send(
                new \App\Mail\PatientScreening2($patient, $screening, 'booking', $referralType)
            );
        }

        $screeningUrl = $patient ? route('view-patient-screening-2', array('patient' => $patient, 'screening' => $screening)) : null;

        if($screeningUrl){
            return response()->json(array('data' => $screeningUrl, 'msg' => 'success'), 200);
        }else{
            return response()->json(array('data' => null, 'msg' => 'error'), 200);
        }
    }
}
