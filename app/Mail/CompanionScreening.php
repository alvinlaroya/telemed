<?php

namespace App\Mail;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanionScreening extends Mailable
{
    use Queueable, SerializesModels;

    public $patient, $screening, $type, $referralType;

    public $firstname, $lastname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $screening, $type = null, $referralType = null)
    {
        $this->patient = $patient;
        $this->screening = $screening;
        $this->type = $type;
        $this->referralType = $referralType;

        $screeningData = (array)$this->screening->data;
        $this->firstname = $screeningData['companion_details']['firstname'] ?? null;
        $this->lastname = $screeningData['companion_details']['lastname'] ?? null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->subject("Your Companion Screening Record")
            ->markdown('emails.companion-screening');

        $patient = $this->patient;
        $screening = (array)$this->screening->data;
        $datetime = $this->screening->created_at;
        $center = $this->screening->center;
        $from = $this->screening->from;
        $type = $this->type;
        // if(isset($screening['has_companion']) && $screening['has_companion'] == 'Yes'){
            $companionPdf = PDF::loadView('pdf.patient-screening-companion', compact('patient', 'screening', 'datetime', 'type', 'center', 'from'))->output();
            $email->attachData($companionPdf, $this->firstname."-".$this->lastname."-Screening.pdf");
        // }
        logger('companion email moved successfully!');

        return $email;
    }
}
