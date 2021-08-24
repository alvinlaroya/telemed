<?php

namespace App\Jobs;

use App\Booking;
use App\Jobs\ProcessSmsSending;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RedoScreening implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('RedoScreening called daily');

        $bookings = Booking::Approved()->get();
        $bookingsToSend = array();

        if(count($bookings) > 0){
            foreach($bookings as $booking){
                $bookingCenters = $booking->bookingCenters;
                $lastScreening = $booking->patient->screenings()->latest()->first();
                $validity_from = $lastScreening->created_at->format('Y-m-d');
                $validity_to = date('Y-m-d', strtotime('+4 days', strtotime($lastScreening->created_at)));
                if(count($bookingCenters) > 0){
                    foreach($bookingCenters as $bookingCenter){
                        $scheduled_date = $bookingCenter->available_date->format('Y-m-d');
                        if($scheduled_date > $validity_to){
                            if(array_key_exists($booking->id, $bookingsToSend)){
                                $bookingsToSend[$booking->id]['centers'][] = $bookingCenter;
                            }else{
                                $bookingsToSend[$booking->id] = array(
                                    'booking' => $booking,
                                    'patient' => $booking->patient,
                                    'screening' => $lastScreening,
                                    'validity_from' => $validity_from,
                                    'validity_to' => $validity_to,
                                    'survey_fillout' => date('Y-m-d', strtotime('-2 days', strtotime($scheduled_date))),
                                    'centers' => array($bookingCenter)
                                );
                            }
                        }
                    }
                }
            }
        }
        
        logger(json_encode($bookingsToSend));

        if(count($bookingsToSend) > 0){
            foreach($bookingsToSend as $booking){
                $patient = $booking['patient'];
                // check for expired bookings first
                if($patient->screening_exp){
                    $screeningExpiration = date('Y-m-d', strtotime($patient->screening_exp));
                    $expDay = date('Y-m-d', strtotime('+1 day', strtotime($screeningExpiration)));
                    if(Carbon::today()->format('Y-m-d') > $expDay){
                        if(count($booking['centers']) > 0){
                            foreach($booking['centers'] as $center){
                                $center_available_date = $center->available_date->format('Y-m-d');
                                if(date('Y-m-d', strtotime('+2 day', strtotime($screeningExpiration))) == $center_available_date){
                                    if($center->status != Booking::EXPIRED){
                                        $center->status = Booking::EXPIRED;
                                        $center->save();
                                    }
                                }
                            }
                        }
                    }
                }
                // check for bookings to notify today
                if($booking['survey_fillout'] == Carbon::today()->format('Y-m-d')){
                    logger('Email sending for patient '.$booking['patient']->id.' with booking '.$booking['booking']->id);
                    $patient->screening_exp = $booking['survey_fillout'];
                    if($patient->save()){
                        $encryptedIDs = md5($booking['patient']->id.'-'.$booking['booking']->id);
                        $screeningUrl = route('re-screening', array('patient' => $booking['patient'], 'booking' => $booking['booking'], 'hash' => $encryptedIDs));
                        // sms for patient
                        if($patient->mobile){
                            logger('Sending sms to '.$patient->mobile);
                            ProcessSmsSending::dispatch('patient_next_screening', $patient->mobile , [
                                'first_name' => $patient->first_name,
                                'last_name' => $patient->last_name,
                                'misc_shortcodes' => json_encode([
                                    'reference_no' => $booking['booking']->booking_reference_no,
                                ])
                            ]);
                        }
                        // email for patient
                        Mail::to($booking['patient']->email)->queue(
                            new \App\Mail\RedoPatientScreening($booking['patient'], $booking['booking'], $screeningUrl)
                        );
                    }
                }
            }
        }

    }
}
