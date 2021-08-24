<?php

namespace App\Mail;

use App\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientUploadedFile extends Mailable
{
    use Queueable, SerializesModels;

    public $patientFirstName;
    public $appointment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patientFirstName, Consultation $appointment)
    {
        $this->patientFirstName = $patientFirstName;
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Patient uploaded a document')
            ->markdown('emails.patient-uploaded-file');
    }
}
