<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingCenter;
use App\BookingService;
use App\City;
use App\CorporateAccount;
use App\HmoAccreditation;
use App\Jobs\ProcessSmsSending;
use App\Jobs\SendSmsJob;
use App\Mail\BookingPlacedAdminMail;
use App\Mail\BookingPlacedMail;
use App\Mail\ServicePaymentAdmin;
use App\Mail\ServicePaymentCancelledAdmin;
use App\Mail\ServicePaymentCancelledPatient;
use App\Mail\ServicePaymentFailedAdmin;
use App\Mail\ServicePaymentFailedPatient;
use App\Mail\ServicePaymentPatient;
use App\Patient;
use App\PatientScreening;
use App\Province;
use App\Service;
use App\ServiceCategory;
use App\ServiceForm;
use App\ServiceFormEntry;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{

    /**
     * Get data from session or array.
     *
     */
    public function getData($data, $key, $default = null)
    {
        return $data[$key] ?? $default;
    }

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

    private function convertAuthData($data)
    {   
        $convertedData = [];

        $convertedData['firstname']     = $data['patient']['first_name'];
        $convertedData['lastname']      = $data['patient']['last_name'];
        $convertedData['mobile']        = substr($data['patient']['mobile'], 3);
        $convertedData['mobile_full']   = $data['patient']['mobile'];
        $convertedData['email']         = $data['email'];
        $convertedData['is_fallrisk']   = false;
        $convertedData['center']        = $data['center'];
        $convertedData['services']      = $data['services'];
        $convertedData['centers']       = $data['centers'];
        $convertedData['modeOfPayment'] = $data['modeOfPayment'];
        $convertedData['mopOther']      = $data['mopOther'];
        return $convertedData;
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'centers.*.preferred_date' => 'required'
        ]);

        $data = session('patient_data');

        if (Auth::user()) { 
            $auth_user     = $this->getAuthenticatedUser();
            $dataConverted = $this->convertAuthData($data);
            $modeOfPayment = $dataConverted['modeOfPayment'];
            $mopOther      = $dataConverted['mopOther'];
            $patient       = $auth_user->patient;

            

        } else {
            // $data = session('patient_data'); 

            $pwdSenior  = $this->getData($data, 'seniorPWD') ? 1 : 0;
            $seniorId   = $this->getData($data, 'seniorPWD') ? $this->getData($data,'idNumber') : null;
            $isFallRisk = $this->getData($data, 'is_fallrisk') ? 1 : 0;
            $fullName   = ucfirst($this->getData($data, 'firstname')).' '.ucfirst($this->getData($data, 'lastname'));

            // save patient details as a user

            $user = User::create([
                'email'    => $this->getData($data, 'email'),
                'role'     => 'patient',
                'name'     => $fullName,
                'password' => Hash::make($this->getData($data, 'password'))
            ]); 

            $patient = Patient::create([
                'first_name'   => $this->getData($data, 'firstname'),
                'last_name'    => $this->getData($data, 'lastname'),
                'mobile'       => $this->getData($data, 'mobile_full'),
                'email'        => $this->getData($data, 'email'),
                'user_id'      => $user->id,
                'type'         => Patient::BOOKING,
                'pwd_senior'   => $pwdSenior,
                'id_number'    => $seniorId,
                'is_fallrisk'  => $isFallRisk
            ]);

            $modeOfPayment = $this->getData($data,'modeOfPayment');
            $mopOther      = $this->getData($data,'mopOther');
        }

     
        /*if ($this->getData($data, 'birthdate_month') && $this->getData($data, 'birthdate_day') && $this->getData($data, 'birthdate_year')) {
             $birthdate = $this->getData($data, 'birthdate_month') . '/' . $this->getData($data, 'birthdate_day') . '/' . $this->getData($data, 'birthdate_year');
        } else {
            $birthdate = null;
        }

        $birthDate  = $birthdate ? Carbon::parse($birthdate)->copy()->toDateString() : null;*/


        $booking = new Booking;
        $booking->patient_id = $patient->id;
        $booking->booking_reference_no = $this->generateUniqueBookingRef();
        $booking->mode_of_payment = $modeOfPayment;
        $booking->mop_other = $mopOther;
        $booking->status = Booking::PENDING;
        $booking->amount_paid = 0;
        $booking->custom_fields = (array) $this->getData($data,'fields',[]);

        if($booking->save()) {

            $centers = (array) $this->getData($data,'centers', []);
            foreach($centers as $key => $center) {
                $answers = (array) $this->getData($data,'answers', []);

                $bookingCenter = new BookingCenter;
                $bookingCenter->booking_id = $booking->id;
                $bookingCenter->service_category_id = $center['center_id'] ?? null;
                $bookingCenter->name = $center['name'] ?? '';
                $bookingCenter->preferred_date = $center['preferred_date'] ? Carbon::parse($center['preferred_date'])->copy()->toDateString() : null;
                $bookingCenter->available_date = $center['preferred_date'] ? Carbon::parse($center['preferred_date'])->copy()->toDateString() : null;
                $bookingCenter->custom_fields = $answers[$center['center_id']]['fields'] ?? [];

                $procedures = null;
                if($bookingCenter->save()) {
                    if($center['service']) {
                        foreach((array) $center['service'] as $keyService => $service) {
                            $bookingService = new BookingService;
                            $bookingService->service_id = $service['service_id'] ?? null;
                            $bookingService->booking_center_id = $bookingCenter->id;
                            $bookingService->booking_id = $booking->id;
                            $bookingService->name = $service['name'] ?? '';
                            $bookingService->preferred_date = $bookingCenter->preferred_date;
                            $bookingService->status = 'pending';
                            if($bookingService->save()) {
                                if(count($center['service']) > 1) {
                                    $procedures = $procedures . $service['name'] . ', ';
                                } else {
                                    $procedures = $service['name'];
                                }
                            }
                        }
                    }
                }
            }
            if($booking->patient->email) {
                $this->makeBookingPlacedEmail($booking);
            }

            // screening
            if($patient){
                $screeningArray = (array) $this->getData($data, 'screening', []);
                // $screenings = array();
                // if(count($screeningArray) > 0){
                //     $screenings = $this->reGenerateArray($screeningArray);
                // }
                $fallriskArray = (array) $this->getData($data, 'fallrisk', []);
                $fallrisks = array();
                if(count($fallriskArray) > 0) {
                    $fallrisks = $this->reGenerateArray($fallriskArray);
                }
                $screening = new PatientScreening;
                $screening->patient_id = $patient->id;
                // $screening->data = (count($screeningArray) > 0) ? (array)$screenings : null;
                $screening->data = (count($screeningArray) > 0) ? (array)$screeningArray : null;
                $screening->fallrisk = (count($fallriskArray) > 0) ? (array)$fallrisks : null;
                $validity_to = date('Y-m-d', strtotime('+4 days'));
                $centers = $booking->bookingCenters->filter(function($item, $index) use ($validity_to){
                    $scheduled_date = $item->available_date->format('Y-m-d');
                    return ($scheduled_date <= $validity_to);
                })->implode('name', ', ');
                $screening->center = $centers;
                $screening->from = 'booking';
                $screening->save();

                // Disabled patient screening email
                // Mail::to($patient->email)->queue(
                //     new \App\Mail\PatientScreening2($patient, $screening, 'booking')
                // );
            }

            // notifications
            $usersToNotify = $booking->centerUsers();
            $bookingData = array('booking' => $booking, 'patient' => $booking->patient);
            Notification::send($usersToNotify, new \App\Notifications\Booking(get_class($booking), 'add', $bookingData));

            // sms for patient
            if ($patient->mobile) {
                $bCenter = $booking->bookingCenters->first();
                SendSmsJob::dispatch('patient_service_booked', $patient->mobile , [
                    'first_name'   => $patient->first_name,
                    'last_name'    => $patient->last_name,
                    'reference_no' => $booking->booking_reference_no,
                    'booking_date' => $bCenter->preferred_date->format(self::DATE_FORMAT),
                    'procedures'   => $procedures
                ]);
            }

            // sms for center admin
            // $booking = $booking->fresh('bookingCenters');
            // foreach ($booking->bookingCenters as $bCenter) {
            //     $center = $bCenter->serviceCenter;
            //     foreach ($center->mobile_recepients as $mobile) {
            //         ProcessSmsSending::dispatch('admin_service_booked', $mobile, [
            //             'first_name' => $patient->first_name,
            //             'last_name' => $patient->last_name,
            //             'reference_no' => $booking->booking_reference_no,
            //             'booking_date' => $bCenter->preferred_date->format(self::DATE_FORMAT)
            //         ]);
            //     }
            // }
        }

        if($this->getData($data, 'fileAttachments')){
            $attachments = $this->getData($data, 'fileAttachments');
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach){
                    if(isset($attach) && !empty($attach)){
                        $title = $attach['title'] ?: '';
                        $booking->addMedia($attach['path'])->usingName($title)->toMediaCollection('doctor-request');
                    }
                }
            }
        }

        if($this->getData($data, 'seniorPwdID')) {
            $seniorPwdAttachments = $this->getData($data, 'seniorPwdID');
            if(count((array)$seniorPwdAttachments) > 0) {
                foreach($seniorPwdAttachments as $seniorPwdAttach) {
                    if(isset($seniorPwdAttach) && !empty($seniorPwdAttach)) {
                        $title = $seniorPwdAttach['title'] ?: '';
                        $booking->addMedia($seniorPwdAttach['path'])->usingName($title)->toMediaCollection('senior-pwd-id');
                    }
                }
            }
        }

        if($this->getData($data, 'seniorPwdIDBack')) {
            $seniorPwdAttachments2 = $this->getData($data, 'seniorPwdIDBack');
            if(count((array)$seniorPwdAttachments2) > 0) {
                foreach($seniorPwdAttachments2 as $seniorPwdAttach2) {
                    if(isset($seniorPwdAttach2) && !empty($seniorPwdAttach2)) {
                        $title = $seniorPwdAttach2['title'] ?: '';
                        $booking->addMedia($seniorPwdAttach2['path'])->usingName($title)->toMediaCollection('senior-pwd-id-back');
                    }
                }
            }
        }

        // $tyText = 'Please note that the Screening Form is valid for five (5) days only. If the confirmed date of your procedure falls outside of the 5-day validity period, or if you selected multiple procedures and the schedule dates for any of these procedures fall beyond the 5-day validity period of a screening form, you will be requested to fill-out another form at least 24 hours before the next scheduled appointment.  Online payment through credit card will also be staggered accordingly, and payment requests will be sent only for procedures that can be covered by a valid screening form.';

        if($booking->mode_of_payment != Booking::CREDITCARD) {
            $tyText = 'You will be notified in a separate email if your preferred schedule has been confirmed.';
        }

        $tyText = 'You will be notified in a separate email if your preferred schedule has been confirmed.';

        session()->forget('patient_data');

        return redirect()->route('bookingThankyou')
                    ->with('success', $tyText)
                    ->withInput();
    }

    /**
     * Regenerate array for screening record answers.
     */
    public function reGenerateArray(&$arr)
    {
        array_walk($arr, function (&$v, $k ) {
            if($k === 'answer') {
                $val = is_array($v) ? array_values($v)[0] : $v;
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
     * Display the specified booking.
     *
     * @param  int  $referenceNo
     */
    public function show($referenceNo)
    {
        $booking = Booking::where('booking_reference_no', $referenceNo)
                    // ->where('expiration', '>', Carbon::now())
                    ->whereIn('status', [Booking::PENDING, Booking::APPROVED])
                    ->first();
        $securehash = null;

        if($booking) {
            $securehash = $this->generatePaymentSecureHash(config('telemed.asiapay.merchantId'), $booking->booking_reference_no, config('telemed.asiapay.currCode'), $booking->discounted_total_amount, config('telemed.asiapay.payType'), config('telemed.asiapay.secureHash'));
        }

        return view('book-service-payment', compact('booking', 'securehash'));
    }

    /**
     * Get all centers from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */

    public function getCenters(Request $request)
    {
        if($request->ajax()){
            $serviceCategories = ServiceCategory::where('status', 1)->orderBy('name')->get()->map(function($item, $key) use ($request){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => $request->selectedValue == $item->id ? true : false
                );
            })->toArray();
            return response()->json($serviceCategories);
        }
    }

    /**
     * Get services from storage for specified center.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getServices(Request $request)
    {
        if($request->ajax()){
            $services = Service::where('category_id', $request->center)->where('status', 1)->orderBy('name')->get()->map(function($item, $key) use ($request){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => $request->selectedValue == $item->id ? true : false
                );
            })->toArray();
            return response()->json($services);
        }
    }

    /**
     * Get all cities from storage for specified province.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getCities(Request $request)
    {
        if($request->ajax()){
            $cities = City::where('province_id', $request->province)->orderBy('name')->get()->map(function($item, $key) use ($request){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => $request->selectedValue == $item->id ? true : false
                );
            })->toArray();
            return response()->json($cities);
        }
    }

    /**
     * Get all provinces from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getProvinces(Request $request)
    {
        if($request->ajax()){
            $provinces = Province::orderBy('name')->get()->map(function($item, $key) use ($request){
                return array(
                    'id' => $item->id,
                    'text' => $item->name,
                    'selected' => $request->selectedValue == $item->id ? true : false
                );
            })->toArray();
            return response()->json($provinces);
        }
    }

    /**
     * Display basic information form for booking services.
     *
     */
    public function basicInfo(Request $request)
    {
        // Settings
        $maintenanceMode = \App\Setting::getName('service_maintenance_mode');
        $maintenanceModeText = \App\Setting::getName('service_maintenance_mode_text');
        
        // get authenticated user
        $user = Auth::user();
        $auth_user = null;

        if ($user) {
            $auth_user = $this->getAuthenticatedUser();
        }

        if ($auth_user) {
            return redirect()->route('booking-service-screening');
        }

        $settings = array(
            'maintenance' => $maintenanceMode['value'],
            'notice' => $maintenanceModeText['value'],
            'user' => $auth_user
        );

        return view('booking-basic-info', compact('settings'));
    }

    /**
     * Display screening form for booking service.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function screening(Request $request)
    {
        // check if patient email is already registered
        $email = $request->email;
        $result = User::where('email', $email)->first();

        if ($result) {
            return redirect()->route('login')
                ->with('message', 'Email is already registered. Please login.');
        }

        $data = $request->except('_token');
        $filePaths = [];

        if($request->has('seniorPwdID')){
            $attachment = $request->seniorPwdID;
            if($attachment) {
                $extension = $attachment->getClientOriginalExtension();  //Get Image Extension
                $fileName = uniqid().'.'.$extension;  //Concatenate both to get FileName (eg: file.jpg)
                $attachment->move(public_path().'/temp-files/', $fileName);

                $filePaths['seniorPwdID'][0]['path'] = public_path().'/temp-files/'. $fileName;
                $filePaths['seniorPwdID'][0]['title'] = $fileName;
            }
        }
        if($request->has('seniorPwdIDBack')){
            $attachment2 = $request->seniorPwdIDBack;
            if($attachment2) {
                $extension2 = $attachment2->getClientOriginalExtension();  //Get Image Extension
                $fileName2 = uniqid().'.'.$extension2;  //Concatenate both to get FileName (eg: file.jpg)
                $attachment2->move(public_path().'/temp-files/', $fileName2);

                $filePaths['seniorPwdIDBack'][0]['path'] = public_path().'/temp-files/'. $fileName2;
                $filePaths['seniorPwdIDBack'][0]['title'] = $fileName2;
            }
        }
        session(['patient_data' => $data]);
        session(['patient_data' => array_merge($data, $filePaths)]);

        return redirect()->route('bookingService');

        // return view('screening-update');
    }

    /**
     * Display fallrisk form for booking service.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function fallrisk(Request $request)
    {
        $this->mergeRequestData($request);
        return view('fallrisk-form');
    }

    /**
     * Display booking services and centers form.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function bookingServiceView(Request $request)
    {
        // $data = $request->all();

        // if(!$data){
        //     return redirect()->route('bookingService')->with('error', 'An error occured. Please try again.');
        // }

        $checkFallRisk = array_values((array)$request->fallrisk);
        $isFallRisk = array_search('1', array_column($checkFallRisk, 'answer')) !== false ? true : false;
        $request->merge(array('is_fallrisk' => $isFallRisk));

        $this->mergeRequestData($request);

        $hmos = HmoAccreditation::latest()->get();
        $corporateAccounts = CorporateAccount::latest()->get();

        // Settings
        $maintenanceMode = \App\Setting::getName('service_maintenance_mode');
        $maintenanceModeText = \App\Setting::getName('service_maintenance_mode_text');
        $settings = array(
            'maintenance' => $maintenanceMode['value'],
            'notice' => $maintenanceModeText['value']
        );

        return view('booking-service', compact('settings', 'hmos', 'corporateAccounts'));
    }



    /**
     * Process booking services and centers form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function centerForms(Request $request)
    {
        // $this->validate($request, [
        //     'province' => 'required',
        // ]);

        $centerArr = array();
        $data = $request->all();
        if(!$data){
            return redirect()->route('bookingService')->with('error', 'An error occured. Please try again.');
        }

        foreach((array) $request->centers as $key => $center) {
            array_push($centerArr, $center['center_id'] ?? null);
        }

        $centers = ServiceCategory::with('customFields')
                    ->whereIn('id', array_filter($centerArr))->get();

        $cfCount = ServiceForm::whereIn('center_id', $centerArr)->count();

        $filePaths = [];
        if($request->has('attachments')){
            $attachments = $request->attachments;
            if(count((array)$attachments) > 0){
                foreach($attachments as $key => $attach){
                    if(isset($attach['file']) && !empty($attach['file'])){
                        $extension = $attach['file']->getClientOriginalExtension();  //Get Image Extension
                        $fileName = uniqid().'.'.$extension;  //Concatenate both to get FileName (eg: file.jpg)
                        $attach['file']->move(public_path().'/temp-files/', $fileName);
                        $filePaths['fileAttachments'][$key]['path'] = public_path().'/temp-files/'. $fileName;
                        $filePaths['fileAttachments'][$key]['title'] = $attach['title'];
                    }
                }
            }
        }

        $this->mergeRequestData($request);

        $patientData = session('patient_data');
        session(['patient_data' => array_merge($patientData, $filePaths)]);

        if($cfCount > 0) {
            return view('center-custom-fields', compact('centers', 'data'));
        } else {
            return redirect()->route('reviewBooking');
        }

    }

    /**
     * Display custom fields for service booking.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function customFields(Request $request)
    {
        $this->mergeRequestData($request);
        return redirect()->route('reviewBooking');
    }

    /**
     * Display review booking details for service booking.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function reviewBooking(Request $request)
    {
        $data = $request->session()->get('patient_data');
        if(!$data){
            return redirect()->route('bookingService')->with('error', 'An error occured. Please try again.');
        }

        if (Auth::user()) {
            $data = $this->convertAuthData($data);
        }

        $province = Province::find($data['province'] ?? '');
        $city = City::find($data['city'] ?? '');
        $totalPayment = 0;
        $discount = 0;
        $withDiscount = 0;
        $firstPayment = 0;
        $otherPayment = 0;

        $dataCenters = $data['centers'] ?? [];
        if (!$dataCenters) {
            return redirect()->route('bookingService')->with('error', 'An error occured. Please try again.');
        }

        $hasAfter5Days = false;
        foreach($dataCenters as $key => $center)
        {
            $centerServices = $center['service'] ?? [];
            foreach($centerServices as $key2 => $service) {
                $tmpService = Service::find($service['service_id'] ?? null);
                if (!$tmpService) continue;

                if($tmpService->eligible) {
                    $tmpDiscount = $tmpService->price * 0.2;
                    $discount = $discount + $tmpDiscount;
                    $tmpDiscount = $tmpService->price - $tmpDiscount;
                    $withDiscount = $withDiscount + $tmpDiscount;
                    $totalPayment = $totalPayment + $tmpService->price;
                } else {
                    $withDiscount = $withDiscount + $tmpService->price;
                    $totalPayment = $totalPayment + $tmpService->price;
                }

                // if(date('Y-m-d', strtotime($center['preferred_date'])) <= now()->modify('+4 days')->format('Y-m-d')) {
                //     if($tmpService->eligible) {
                //         $tmpDiscount = $tmpService->price * 0.2;
                //         $discount = $discount + $tmpDiscount;
                //         $tmpDiscount = $tmpService->price - $tmpDiscount;
                //         $withDiscount = $withDiscount + $tmpDiscount;
                //         $totalPayment = $totalPayment + $tmpService->price;
                //         $firstPayment = $firstPayment + $tmpService->price;
                //     } else {
                //         $withDiscount = $withDiscount + $tmpService->price;
                //         $totalPayment = $totalPayment + $tmpService->price;
                //         $firstPayment = $firstPayment + $tmpService->price;
                //     }
                // } else {
                //     if($tmpService->eligible) {
                //         $tmpDiscount = $tmpService->price * 0.2;
                //         $discount = $discount + $tmpDiscount;
                //         $tmpDiscount = $tmpService->price - $tmpDiscount;
                //         $withDiscount = $withDiscount + $tmpDiscount;
                //         $totalPayment = $totalPayment + $tmpService->price;
                //         $otherPayment = $otherPayment + $tmpService->price;
                //     } else {
                //         $withDiscount = $withDiscount + $tmpService->price;
                //         $totalPayment = $totalPayment + $tmpService->price;
                //         $otherPayment = $otherPayment + $tmpService->price;
                //     }
                // }
            }

            if(date('Y-m-d', strtotime($center['preferred_date'])) > now()->modify('+4 days')->format('Y-m-d')) {
                $hasAfter5Days = true;
            }
        }

        $discount = number_format($discount, 2);
        $withDiscount = number_format($withDiscount, 2);
        $totalPayment = number_format($totalPayment, 2);

        return view('review-booking', compact('data','city', 'totalPayment', 'withDiscount', 'discount', 'province', 'hasAfter5Days', 'otherPayment', 'firstPayment'));
    }

    /**
     * Send notification to specified notifiable users.
     *
     */
    public function sendNotification($booking, $title = '')
    {
        $users = $booking->centerUsers();
        $bookingData = array('booking' => $booking, 'patient' => $booking->patient);
        Notification::send($users, new \App\Notifications\Booking(get_class($booking), 'pay', $bookingData, array('title' => $title)));
    }

    /**
     * Asiapay return after payment transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function asiapayReturned(Request $request)
    {
        $src = $request->src;
        $prc = $request->prc;
        $ord = $request->Ord;
        $holder = $request->Holder;
        $successCode = $request->successcode;
        $ref = $request->Ref;
        $payRef = $request->PayRef;
        $amt = $request->Amt;
        $cur = $request->Cur;
        $remark = $request->remark;
        $authId = $request->AuthId;
        $eci = $request->eci;
        $payerAuth = $request->payerAuth;
        $sourceIp = $request->sourceIp;
        $ipCountry = $request->ipCountry;
        $secureHash = $request->secureHash;

        echo "OK";

        if( isset($request->Ref) && isset($request->successcode) && isset($request->src) && isset($request->src) ){
            $booking_ref = $ref;

            if($booking_ref != '') {
                $booking = Booking::where('booking_reference_no', $booking_ref)->first();

                if($booking->status != Booking::PAID) {

                    $checkSecureHash = $this->verifyPaymentDatafeed($src, $prc, $successCode, $ref, $payRef, $cur, $amt, $payerAuth, config('telemed.asiapay.secureHash'), $secureHash);

                    if(config('telemed.asiapay.secureHash') == '' || $checkSecureHash) {
                        if($successCode == "0") {
                            // $booking->status = Booking::PAID;
                            $booking->amount_paid = $booking->amount_paid != null ? $booking->amount_paid + $amt : $amt;
                            $booking->paid_at = Carbon::now();
                            $booking->payment_ref = $payRef;
                            $booking->other_data = $request->all();
                            $booking->save();

                            foreach ($booking->bookingCenters as $bCenter) {
                                if($bCenter->isWithin5Days()) {
                                    $bCenter->amount_paid = $bCenter->center_discounted_total_amount;
                                    $bCenter->payment_status = BookingCenter::PAYMENT_PAID;
                                    $bCenter->paid_at = Carbon::now();
                                    $bCenter->payment_ref = $payRef;
                                    $bCenter->other_data = $request->all();
                                    $bCenter->save();
                                }
                            }

                            $setting = Setting::first();

                            $centerAdminEmail = array();

                            foreach($booking->bookingCenters as $key => $bookingCenter) {
                                if($bookingCenter->isWithin5Days()) {
                                    foreach($bookingCenter->serviceCenter->email_recepients as $email) {
                                        array_push($centerAdminEmail, $email);
                                    }
                                }
                            }

                            Mail::to($booking->patient->email)->queue(new ServicePaymentPatient($booking));
                            Mail::to($centerAdminEmail)->queue(new ServicePaymentAdmin($booking));

                            // admin notifications
                            $this->sendNotification($booking, 'Payment successful for booking with reference #'.$booking->booking_reference_no);

                            // sms for patient
                            if($booking->patient->mobile) {
                                ProcessSmsSending::dispatch('patient_service_payment_made', $booking->patient->mobile , [
                                    'first_name' => $booking->patient->first_name,
                                    'last_name' => $booking->patient->last_name,
                                    'misc_shortcodes' => json_encode([
                                        'reference_no' => $booking->booking_reference_no,
                                    ])
                                ]);
                            }

                            // sms for admin
                            foreach ($booking->bookingCenters as $bCenter) {
                                if($bCenter->isWithin5Days()) {
                                    $center = $bCenter->serviceCenter;
                                    foreach ($center->mobile_recepients as $mobile) {
                                        ProcessSmsSending::dispatch('admin_service_payment_made', $mobile, [
                                            'first_name' => $booking->patient->first_name,
                                            'last_name' => $booking->patient->last_name,
                                            'misc_shortcodes' => json_encode([
                                                'reference_no' => $booking->booking_reference_no,
                                            ])
                                        ]);
                                    }
                                }
                            }

                            return redirect()->route('bookingServiceReturn')
                                ->with('success', 'Your payment was successful! Payment reference no: '.$payRef);
                        } else {
                            // $booking->status = Booking::CANCELLED;
                            // $booking->paid_at = Carbon::now();
                            $booking->payment_ref = $payRef;
                            $booking->other_data = $request->all();
                            $booking->save();

                            $setting = Setting::first();

                            $centerAdminEmail = array();

                            foreach($booking->bookingCenters as $key => $bookingCenter) {
                                if($bookingCenter->isWithin5Days()) {
                                    foreach($bookingCenter->serviceCenter->email_recepients as $email) {
                                        array_push($centerAdminEmail, $email);
                                    }
                                }
                            }

                            Mail::to($booking->patient->email)->queue(new ServicePaymentFailedPatient($booking));
                            Mail::to($centerAdminEmail)->queue(new ServicePaymentFailedAdmin($booking));

                            // admin notifications
                            $this->sendNotification($booking, 'Payment unsuccessful for booking with reference #'.$booking->booking_reference_no);

                            return redirect()->route('bookingServiceReturn')
                                ->with('error', 'Sorry! your payment was unsuccessful! Payment reference no: '.$payRef);
                        }
                    } else {
                        // $booking->status = Booking::CANCELLED;
                        // $booking->paid_at = Carbon::now();
                        $booking->payment_ref = $payRef;
                        $booking->other_data = $request->all();
                        $booking->save();

                        $setting = Setting::first();

                        $centerAdminEmail = array();

                        foreach($booking->bookingCenters as $key => $bookingCenter) {
                            if($bookingCenter->isWithin5Days()) {
                                foreach($bookingCenter->serviceCenter->email_recepients as $email) {
                                    array_push($centerAdminEmail, $email);
                                }
                            }
                        }

                        Mail::to($booking->patient->email)->queue(new ServicePaymentFailedPatient($booking));
                        Mail::to($centerAdminEmail)->queue(new ServicePaymentFailedAdmin($booking));

                        // admin notifications
                        $this->sendNotification($booking, 'Payment secure hash checking failed for booking with reference #'.$booking->booking_reference_no);

                        return redirect()->route('bookingServiceReturn')
                            ->with('error', 'Secure Hash checking failed! Payment reference no: '.$payRef);
                    }
                }
            }
        }

        exit();
    }

    /**
     * Display if payment was successful.
     *
     */
    public function paymentSuccess()
    {
        return redirect()->route('bookingServiceReturn')
                        ->with('success', 'Payment Successful!');
    }

    /**
     * Display if payment failed.
     *
     */
    public function paymentFailed()
    {
        if(isset($_GET['Ref']) && !empty($_GET['Ref'])) {
            return redirect()->route('bookingService.payment', $_GET['Ref']);
        }

        return redirect()->route('booking-service-patient');
    }

    /**
     * Display if payment was cancelled.
     *
     */
    public function paymentCancelled()
    {
        if(isset($_GET['Ref']) && !empty($_GET['Ref'])) {
            return redirect()->route('bookingService.payment', $_GET['Ref']);
        }

        return redirect()->route('booking-service-patient');
    }

    /**
     * Cancel specified booking.
     *
     * @param  \App\Booking  $booking
     */
    public function cancel(Booking $booking)
    {
        $booking->status = Booking::CANCELLED;
        $booking->save();

        Mail::to($booking->patient->email)->queue(new \App\Mail\BookingCancelled($booking));

		return redirect()->back()
						 ->with('success', 'Successfully cancelled the booking!');
    }

    /**
     * Make booking placed email.
     *
     * @param  \App\Booking  $booking
     */
    private function makeBookingPlacedEmail($booking)
    {
        $setting = Setting::first();
        $centerAdminEmail = array();

        foreach($booking->bookingCenters as $key => $bookingCenter) {
            foreach($bookingCenter->serviceCenter->email_recepients as $email) {
                array_push($centerAdminEmail, $email);
            }
        }

        // $setting->value
        Mail::to($booking->patient->email)->queue(new BookingPlacedMail($booking));
        Mail::to($centerAdminEmail)->queue(new BookingPlacedAdminMail($booking));

        if (Mail::failures()) {
            Log::error('A booking placed email was failed to send ' . Carbon::now()->toDateTimeString());
        }

        return;
    }

    /**
     * Generate unique booking reference number.
     *
     */
    public function generateUniqueBookingRef()
    {
        $number = mt_rand(1000000, 9999999);

        if($this->isBookingRefExists($number))
        {
            return generateUniqueBookingRef();
        }

        return $number;
    }

    /**
     * Validate if booking reference number already exist.
     *
     */
    public function isBookingRefExists($number)
    {
        return Booking::where('booking_reference_no', $number)->exists();
    }

    /**
     * Generate payment secure hash for asiapay integration.
     *
     */
    public function generatePaymentSecureHash($merchantId, $merchantReferenceNumber, $currencyCode, $amount, $paymentType, $secureHashSecret)
    {
        $buffer = $merchantId . '|' . $merchantReferenceNumber . '|' . $currencyCode . '|' . $amount . '|' . $paymentType . '|' . $secureHashSecret;
        return sha1($buffer);
    }

    /**
     * Verify payment data feed.
     *
     */
    public function verifyPaymentDatafeed($src, $prc, $successCode, $merchantReferenceNumber, $paydollarReferenceNumber, $currencyCode, $amount, $payerAuthenticationStatus, $secureHashSecret, $secureHash) {
        $buffer = $src . '|' . $prc . '|' . $successCode . '|' . $merchantReferenceNumber . '|' . $paydollarReferenceNumber . '|' . $currencyCode . '|' . $amount . '|' . $payerAuthenticationStatus . '|' . $secureHashSecret;
        $verifyData = sha1($buffer);
        if ($secureHash == $verifyData) {
            return true;
        }
        return false;
    }

    /**
     * Merge request data then create session for processing.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function mergeRequestData(Request $request)
    {
        if (Auth::user()) {
            $data = $this->getAuthenticatedUser()->toArray();
        } else {
            $data = session('patient_data');
        }

        $rData = $request->except(['_token', 'attachments']);
        session(['patient_data' => array_merge($data, $rData)]);
    }

}
