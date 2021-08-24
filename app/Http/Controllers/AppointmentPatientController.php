<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Consultation;
use App\AppointmentLog;
use App\DoctorForm;
use App\DoctorFormEntry;
use App\Patient;
use App\PatientScreening;
use App\Jobs\ProcessSmsSending;
use App\ServiceForm;
use App\ServiceFormEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendSmsJob;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Hash;


class AppointmentPatientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'auth.patient']);
    }
     /**
     * Patients describe more chief complaint and option to attach files
     * this is the landing page after clicking on the link of appointment confirmation
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
    public function details(Consultation $consultation, Request $request)
    {
        return view('appointment.details', compact('consultation'));
    }

    /**
     * Update specified consultation data in storage.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Consultation $consultation, Request $request)
    {
        $request->validate([
            'complaint' => 'required',
            'attachments.*.file' => 'file|max:5000'
        ]);

        $patientFirstName        = $consultation->first_name;
        $consultation->complaint = $request->complaint;
        $consultation->save();

        // upload attachments here ...
        // if ($request->has('files')) {
        //     $files = $request->file('files');
        //     foreach ($files as $file) {
        //         $consultation->addMedia($file)->toMediaCollection('patient');
        //     }
        // }

        // new way of uploading - update
        if($request->has('attachments')) {
            $attachments = $request->attachments;
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach){
                    if(isset($attach['file']) && !empty($attach['file'])){
                        $title = $attach['title'] ?: $attach['file']->getClientOriginalName();
                        $consultation->addMedia($attach['file'])->usingName($title)->toMediaCollection('patient');
                    }
        
                    if ($attach['file']->isValid()) {
                        if (count($consultation->doctor->email_recepients) > 0) {
                            foreach ($consultation->doctor->email_recepients as $email) {
                                Mail::to($email)->queue(
                                    new \App\Mail\PatientUploadedFile($patientFirstName, $consultation)
                                );
                            }
                        }   
                    }
                    
                    if (count($consultation->doctor->mobile_recepients) > 0) {
                         foreach ($consultation->doctor->mobile_recepients as $mobile) {
                            SendSmsJob::dispatch('patient_uploaded_consultation_file', $mobile, [
                                'id'           => $consultation->id,
                                'first_name'   => $consultation->patient->first_name,
                                'last_name'    => $consultation->patient->last_name,
                                'doctor'       => $consultation->doctor->first_name . ' ' . $consultation->doctor->last_name,
                            ]);
                         }
                    }                    
                }
            }
        }

        return redirect()->back()
                         ->with('success', 'Successfully updated appointment details!');
    }

    /**
     * Remove media from specified consultation.
     * 
     * @param  \App\Consultation  $consultation
     * @param  Media  $media
     */
    public function rmMedia(Consultation $consultation, Media $media)
    {
        $media->delete();

        return redirect()->back()
                         ->with('success', 'Successfully removed file!');
    }

    /**
     * Upload.
     * 
     */
    public function upload(Consultation $consultation, Request $request)
    {
        dd($request->all());
    }

    /**
     * Patient can request another date or time
     * this is the landing page after clicking on the link of reschedule appointment
     */
    public function log(Consultation $consultation, Request $requeust)
    {
        // validate md5 key for security purposes

        return view('appointment.log');
    }

    /**
     * Save logs to storage.
     * 
     * @param  \App\Consultation  $consultation
     * @param  \Illuminate\Http\Request  $request
     */
    public function logNow(Consultation $consultation, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $consultation->logs()->save(
            new AppointmentLog([
                'content' => $request->content,
            ])
        );

        return redirect()->back()
                         ->with('success', 'Successfully saved remarks!');
    }

    /**
     * Display appointment service form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function serviceForm(Request $request)
    {
        $currDate = new Carbon();
        // $customFields = ServiceForm::orderBy('order')->get();
        $centers = \App\ServiceCategory::with('customFields')
                    ->whereIn('id', [1, 2])
                    ->get();

        return view('appointment.service-form', compact('centers', 'currDate'));
    }

    /**
     * Save changes in appointment service form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function serviceFormSave(Request $request)
    {
        dd($request->all());
        if ($request->filled('fields')) {
            $entry = new ServiceFormEntry();
            $entry->doctor_id = $request->doctor_id;
            $entry->date_time = $request->date_time;
            $entry->first_name = $request->firstname;
            $entry->first_name = $request->firstname;
            $entry->last_name = $request->lastname;
            $entry->middle_name = $request->middlename;
            $entry->mobile = $request->mobile;
            $entry->email = $request->email;
            $entry->other_answers = (array) $request->fields;
            $entry->save();

            return redirect()->back()
                ->with('success', 'We have receive your submission, please wait as someone from us will attend you shortly');
        }

        return redirect()->back()
            ->with('error', 'Something went wrong, please try again later!')
            ->withInput();
    }

    /**
     * Display custom fields doctors form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function doctorsForm(Request $request)
    {
        $currDate = new Carbon();
        $customFields = DoctorForm::orderBy('order')->get();

        return view('appointment.doctor-form', compact('customFields', 'currDate'));
    }

    /**
     * Save changes made in doctors form.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function doctorsFormSave(Request $request)
    {
        if ($request->filled('fields')) {
            $entry = new DoctorFormEntry();
            $entry->doctor_id = $request->doctor_id;
            $entry->date_time = $request->date_time;
            $entry->first_name = $request->firstname;
            $entry->first_name = $request->firstname;
            $entry->last_name = $request->lastname;
            $entry->middle_name = $request->middlename;
            $entry->mobile = $request->mobile;
            $entry->email = $request->email;
            $entry->other_answers = (array) $request->fields;
            $entry->save();

            return redirect()->back()
                ->with('success', 'We have receive your submission, please wait as someone from us will attend you shortly');
        }

        return redirect()->back()
            ->with('error', 'Something went wrong, please try again later!')
            ->withInput();
    }

    /**
     * Format and regenerate array to change values for answers.
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

    public function checkEmail(Request $request)
    {
         // check if patient email is already registered
        $result = User::where('email', $request->email)->first();

        // work around to state that email is registered and to be catch in the frontend and redirect to login page
        return $result ? response()->json(['message' => 'Email existing']) : response()->json(['message' => 'Email not existing']); 
    }

    /**
     * Book an appointment for a specified doctor.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function bookDoctor(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'type' => 'required',
        ]);

        $doctor = Doctor::find($request->doctor_id);

        // for senior and athlete ids
        $filePaths = [];
        if($request->has('seniorPwdID')){
            $attachment = $request->seniorPwdID;
            if($attachment) {
                $extension = $attachment->getClientOriginalExtension();  //Get Image Extension
                $fileName = uniqid().'.'.$extension;  //Concatenate both to get FileName (eg: file.jpg)
                $attachment->move(public_path().'/temp-files/', $fileName);
                
                $filePaths['seniorPwdID'][0]['path']  = public_path().'/temp-files/'. $fileName;
                $filePaths['seniorPwdID'][0]['title'] = $fileName;
            }
        }

        if($request->has('seniorPwdIDBack')){
            $attachment2 = $request->seniorPwdIDBack;
            if($attachment2) {
                $extension2 = $attachment2->getClientOriginalExtension();  //Get Image Extension
                $fileName2 = uniqid().'.'.$extension2;  //Concatenate both to get FileName (eg: file.jpg)
                $attachment2->move(public_path().'/temp-files/', $fileName2);

                $filePaths['seniorPwdIDBack'][0]['path']  = public_path().'/temp-files/'. $fileName2;
                $filePaths['seniorPwdIDBack'][0]['title'] = $fileName2;
            }
        }

        /*if ($request->birthdate_year && $request->birthdate_month && $request->birthdate_day) {
            $birthdate = Carbon::createFromDate(
                $request->birthdate_year,
                $request->birthdate_month,
                $request->birthdate_day
            );
            $dateOfBirth = $birthdate->toDateString();
        } else {
            $birthdate   = null;
            $dateOfBirth = null;
        }*/

        $fullName   = ucfirst($request->first_name).' '.ucfirst($request->last_name);
        $pwdSenior  = $request->seniorPWD ? 1 : 0;
        $seniorId   = $request->seniorPWD ? $request->idNumber : null;
        $isFallRisk = $request->is_fallrisk ? 1 : 0;

        // save patient details as a user

        $user = User::create([
            'email'    => $request->email,
            'role'     => 'patient',
            'name'     => $fullName,
            'password' => Hash::make($request->password)
        ]); 

        $patient = Patient::create([
            'email'        => $request->email,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'mobile'       => $request->mobile_full,
            'user_id'      => $user->id,
            'pwd_senior'   => $pwdSenior,
            'id_number'    => $seniorId,
            'is_fallrisk'  => $isFallRisk
        ]);

        // Save Screening
        if ($patient) {
            $screeningArray = (array) $request->screening;
            // $screenings = array();
            // if(count($screeningArray) > 0){
            //     $screenings = $this->reGenerateArray($screeningArray);
            // }
            $screening = new PatientScreening;
            $screening->patient_id = $patient->id;
            $screening->data = count($screeningArray) > 0 ? (array) $screeningArray : null;
            $screening->center = 'Diagnostic Treatment Center';
            $screening->from = 'appointment';
            $screening->save();

            // Disabled patient screening email
            // Mail::to($patient->email)->send(
            //     new \App\Mail\PatientScreening2($patient, $screening)
            // );
        }

        $c = new Consultation;
        $c->reference_no = Consultation::generateUniqueRef();
        $c->patient_id = $patient->id;
        $c->complaint = $request->complaint;
        $c->type = $request->type;

        $carbon = new Carbon($request->date);
        $c->date_time = $carbon->toDateString(). ' ' .$request->time;

        $c->duration = $doctor->consultation_duration;
        $c->status = Consultation::APPROVED;
        $c->actual_datetime = $c->date_time;
        $c->actual_endtime = $c->date_time->addMinutes($c->duration);
        $c->payment_expiration = $c->date_time->addHours(24);
        $c->consultation_fee = $doctor->consultation_fee;
        $c->doctor_id = $doctor->id;
        $c->custom_fields = (array) $request->fields;
        
        if(request('isHomeVisit') == 1){
            $c->is_home_visit = 1;
        }

        $c->save();

        $recepients = $doctor->email_recepients;
        if (count($recepients) > 0) {
            Mail::to($recepients, $doctor->full_name)->queue(new \App\Mail\AppointmentCreated($c));
        }
        Mail::to($c->email)->queue(new \App\Mail\AppointmentCreatedReceipt($c));

        // sms for patient
        if ($c->mobile) {
            ProcessSmsSending::dispatch('patient_doctor_booked', str_replace('-', '', $c->mobile), [
                'first_name' => $c->first_name,
                'last_name' => $c->last_name,
                'misc_shortcodes' => json_encode([
                    'reference_no' => $c->reference_no,
                    'doctor' => $doctor->first_name . ' ' . $doctor->last_name,
                    'booking_date' => $c->date_time->format(self::DATETIME_FORMAT)
                ])
            ]);
        }

        // sms for doctor
        $mobileRecepients = $doctor->mobile_recepients;
        if (count($mobileRecepients) > 0) {
            foreach ($mobileRecepients as $mobile) {
                ProcessSmsSending::dispatch('doctor_doctor_booked', str_replace('-', '', $mobile), [
                    'first_name' => $doctor->first_name,
                    'last_name' => $doctor->last_name,
                    'misc_shortcodes' => json_encode([
                        'reference_no' => $c->reference_no,
                        'patient_name' => $c->patient->first_name . ' ' . $c->patient->last_name,
                        'booking_date' => $c->date_time->format(self::DATETIME_FORMAT)
                    ])
                ]);
            }
        }

        session()->forget('doctor');

        if ($request->ajax()) {
            return response()->json($c);
        }

        return redirect()->route('book-doctor')
                    ->with('step_success', true)
                    ->with('success', 'Successfully save appointment!');
    }
}
