<?php

namespace App\Mail;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientScreening extends Mailable
{
    use Queueable, SerializesModels;

    public $patient, $screening, $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $screening, $type = null)
    {
        $this->patient = $patient;
        $this->screening = $screening;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->subject('Your Screening Record')
            ->markdown('emails.patient-screening');

        $patient = $this->patient;
        $screening = (array)$this->screening->data;
        $datetime = $this->screening->created_at;
        $type = $this->type;
        $pdf = PDF::loadView('pdf.patient-screening', compact('patient', 'screening', 'datetime', 'type'))->output();
        $email->attachData($pdf, $patient->first_name."-".$patient->last_name."-Screening.pdf");

        return $email;
    }
}
