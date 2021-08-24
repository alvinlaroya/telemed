<?php

namespace App\Http\Controllers\Doctor;

use DB;
use Arr;
use Mail;
use App\City;
use App\Doctor;
use App\Booking;
use App\Package;
use App\Service;
use App\Setting;
use App\Schedule;
use Carbon\Carbon;
use App\Consultation;
use App\BookingCenter;
use App\BookingService;
use App\PatientScreening;
use App\Jobs\ProcessSmsSending;
use App\Mail\BookingPlacedMail;
use App\Mail\OrderHomeVisitCreated;
use App\Http\Controllers\Controller;
use App\Mail\BookingPlacedAdminMail;
use Illuminate\Support\Facades\Notification;

class OrderHomeVisitController extends Controller
{

    public function create($consultation)
    {
        $cities = City::with(['province'])->orderBy('name')->get();
        $packages = Package::orderBy('name')->get();

        return view('doctor.consultations.home-visit', compact('cities', 'packages', 'consultation'));
    }

    public function doctorSearchBySpecializationAndLocation()
    {
        $this->validate(request(), ['city' => 'required']);

        $doctors = Doctor::whereHas('address', function($query) {
                return $query->where('city', request('city'));
            })
            ->whereHas('specializations', function($query) {
                return $query->where('name', 'Covid Home Visit');
            })
            ->get();

        return response()->json(compact('doctors'));
    }

    public function getDoctorScheduleDate($doctorId)
    {
        if($doctorId < 1) {
            return response()->json(['message' => 'Doctor does not exists.']);
        }

        $dates = array_unique(
            Arr::flatten(
                Schedule::getAvailableDateByDoctor($doctorId, 'date', 'Y,m,d')
            )
        );

        return response()->json(compact('dates'));
    }

    public function getDoctorScheduleTime($doctorId, $date)
    {
        if(empty($doctorId) || empty($date)) {
            return response()->json(['message' => 'Doctor or date is invalid.']);
        }

        $times = Arr::flatten(Schedule::getAvailableTimeByDoctorAndDate($doctorId, $date));

        return response()->json(compact('times'));
    }

    public function store()
    {
        $this->validate(request(), [
            'packageId' => 'required',
            'doctorId' => 'required',
            'date' => 'required',
            'time' => 'required',
            'packageId' => 'required'
        ]);

        $schedulerId = auth()->user()->doctor->id; // Doctor A
        $doctor = Doctor::find(request('doctorId')); // Doctor B

        if(!$doctor) {
            return response()->json(['message' => 'Doctor does not exists.']);
        }

        $consultation = Consultation::with('patient')->find(request('appointmentId'));
        $package = Package::with('services')->find(request('packageId'));
        $patient = $consultation->patient;

        if(!$consultation) {
            return response()->json(['message' => 'Consultation does not exists.']);
        }

        $scheduleDateRaw = new \DateTime(str_replace(',', '', request('date')) . ' ' . request('time'));
        $scheduleDate = $scheduleDateRaw->format('Y-m-d H:i:s');
        $scheduleTime = $scheduleDateRaw->format('H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Needs DB transaction to make sure that data is complete
        |--------------------------------------------------------------------------
        */
        DB::transaction(function() use($consultation, $schedulerId, $doctor, $package, $scheduleDateRaw, $scheduleDate, $scheduleTime, $patient) {
            /*
            |--------------------------------------------------------------------------
            | UPDATE THE CONSULTATION STATUS
            |--------------------------------------------------------------------------
            */
            $packageIdForOrigConsultation = ($consultation->package_id == null) ? request('packageId') : $consultation->package_id;
            $statusForOrigConsultation = ($consultation->status == 'pending') ? 'approved' : $consultation->status;

            $consultation->update([
                'package_id' => $packageIdForOrigConsultation,
                'status' => $statusForOrigConsultation
            ]);

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE THE TRANSACTION FOR DOCTOR B
            |--------------------------------------------------------------------------
            |
            */
            $consultationB = $consultation->replicate()->fill([
                'reference_no' => Consultation::generateUniqueRef(),
                'doctor_id' => request('doctorId'),
                'scheduler_doctor_id' => $schedulerId,
                'actual_datetime' => $scheduleDate,
                'consultation_fee' => $package->price,
                'status' => 'approved'
            ]);

            $consultationB->save();

            if($package->services()->count() > 0)
            {
                $requestedDate = (new \Datetime(
                    str_replace(',', '', request('date'))
                ))->format('m/d/Y');

                $followUpDate = Schedule::getFollowUpDateByDoctor($schedulerId, $requestedDate);

                /*
                |--------------------------------------------------------------------------
                | CREATE THE FOLLOW UP (IF ANY)
                |--------------------------------------------------------------------------
                | 
                */
                $followUpService = Service::where('product_code', 'follow-up')->first();
                if($package->hasFollowUpService()) {
                    $consultationFollowUp = $consultation->replicate()->fill([
                        'reference_no' => Consultation::generateUniqueRef(),
                        'doctor_id' => $schedulerId,
                        'package_id' => request('packageId'),
                        'service_id' => ($followUpService) ? $followUpService->id : null,
                        'follow_up_schedule' => $followUpDate,
                        'scheduler_doctor_id' => $schedulerId,
                        'actual_datetime' => $followUpDate,
                        'consultation_fee' => 0,
                        'status' => 'approved'
                    ]);

                    $consultationFollowUp->save();
                }

                /*
                |--------------------------------------------------------------------------
                | SAVE THE DATA FOR SERVICES BOOKING
                |--------------------------------------------------------------------------
                | 
                */
                $bookingData = [];
                $newBooking = Booking::create([
                    'patient_id' => $patient->id,
                    'booking_reference_no' => Booking::generateUniqueBookingRef(),
                    'mode_of_payment' => 'MyHospital',
                    'mop_other' => 'Direct Deposit',
                    'amount_paid' => 0,
                    'is_home_visit' => 1,
                    'package_id' => $package->id,
                    'status' => 'approved'
                ]);

                foreach($package->getCenters() as $centerId => $centerName)
                {
                    $services = $package->services->where('product_code', '!=', 'follow-up')->where('category_id', $centerId);
                    
                    /*
                    |--------------------------------------------------------------------------
                    | CREATE BOOKING CENTER
                    |--------------------------------------------------------------------------
                    | 
                    */
                    $newBookingCenter = BookingCenter::create([
                        'booking_id' => $newBooking->id,
                        'service_category_id' => $centerId ?? null,
                        'name' => $centerName ?? '',
                        'preferred_date' => $scheduleDateRaw->format('Y-m-d'),
                        'available_date' => $scheduleDate,
                        'available_time' => request('time'),
                        'custom_fields' => []
                    ]);

                    $procedures = null;

                    foreach($services as $packageService) {

                        /*
                        |--------------------------------------------------------------------------
                        | CREATE BOOKING SERVICE
                        |--------------------------------------------------------------------------
                        | 
                        */
                        BookingService::create([
                            'service_id' => $packageService->id,
                            'booking_center_id' => $newBookingCenter->id,
                            'booking_id' => $newBooking->id,
                            'name' => $packageService->name,
                            'preferred_date' => $scheduleDate,
                            'status' => 'approved'
                        ]);

                    }
                }

                /*
                |--------------------------------------------------------------------------
                | SEND EMAIL TO PATIENT
                |--------------------------------------------------------------------------
                | 
                */
                if($newBooking->patient->email) {
                    $this->makeBookingPlacedEmail($newBooking);
                }

                /*
                |--------------------------------------------------------------------------
                | SCREENING
                |--------------------------------------------------------------------------
                | 
                */
                if($patient) {
                    $patientScreening = PatientScreening::create([
                        'patient_id' => $patient->id,
                        'center' => $centerId,
                        'from' => 'booking'
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | NOTIFICATIONS
                |--------------------------------------------------------------------------
                | 
                */
                $usersToNotify = $newBooking->centerUsers();
                $bookingData = ['booking' => $newBooking, 'patient' => $newBooking->patient];
                Notification::send($usersToNotify, new \App\Notifications\Booking(get_class($newBooking), 'add', $bookingData));

                /*
                |--------------------------------------------------------------------------
                | SMS TO PATIENT
                |--------------------------------------------------------------------------
                | 
                */
                if($patient->mobile)
                {
                    $bCenter = $newBooking->bookingCenters->first();

                    ProcessSmsSending::dispatch('patient_service_booked', $patient->mobile , [
                        'first_name' => $patient->first_name,
                        'last_name' => $patient->last_name,
                        'misc_shortcodes' => json_encode([
                            'reference_no' => $newBooking->booking_reference_no,
                            'booking_date' => $bCenter->preferred_date->format(self::DATE_FORMAT),
                            'procedures' => $procedures,
                        ])
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | SMS FOR CENTER ADMIN
                |--------------------------------------------------------------------------
                | 
                */
                $booking = $newBooking->fresh('bookingCenters');
                foreach ($booking->bookingCenters as $bCenter)
                {
                    $center = $bCenter->serviceCenter;
                    foreach ($center->mobile_recepients as $mobile) {
                        ProcessSmsSending::dispatch('admin_service_booked', $mobile, [
                            'first_name' => $patient->first_name,
                            'last_name' => $patient->last_name,
                            'misc_shortcodes' => json_encode([
                                'reference_no' => $booking->booking_reference_no,
                                'booking_date' => $bCenter->preferred_date->format(self::DATE_FORMAT)
                            ])
                        ]);
                    }
                }

            }


        });

        // RETURN RESPONSE
        return response()->json([
            'status' => 200,
            'redirectURL' => route('doctor.appointments')
        ]);
    }

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

    public function viewPackage($packageId)
    {
        $package = Package::with('services')->findOrFail($packageId);

        return view('doctor.consultations.package-view', compact('package'));
    }

}
