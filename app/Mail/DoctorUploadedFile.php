<?php

namespace App\Mail;

use App\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DoctorUploadedFile extends Mailable
{
    use Queueable, SerializesModels;

    public $doctorFullName;
    public $patientFirstName;
    public $appointment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patientFirstName, $doctorFullName, Consultation $appointment)
    {
        $this->doctorFullName   = $doctorFullName;
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
        return $this->subject('Doctor uploaded a document')
            ->markdown('emails.doctor-uploaded-file');
    }
}
