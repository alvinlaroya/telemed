<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientUploadedFileOnLabs extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $patientName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $patientName)
    {
        $this->booking = $booking;
        $this->patientName = $patientName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Patient uploaded a document')
            ->markdown('emails.patient-uploaded-file-on-labs');
    }
}
