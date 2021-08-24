<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RedoPatientScreening extends Mailable
{
    use Queueable, SerializesModels;

    public $patient, $booking, $screeningUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $booking, $screeningUrl)
    {
        $this->patient = $patient;
        $this->booking = $booking;
        $this->screeningUrl = $screeningUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->subject('Fillup New Screening Record')
            ->markdown('emails.patient-screening-new');

        return $email;
    }
}
