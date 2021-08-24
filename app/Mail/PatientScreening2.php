<?php

namespace App\Mail;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PatientScreening2 extends Mailable
{
    use Queueable, SerializesModels;

    public $patient, $screening, $type, $referralType;

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
        $center = $this->screening->center;
        $from = $this->screening->from;
        $type = $this->type;
        $pdf = PDF::loadView('pdf.patient-screening-2', compact('patient', 'screening', 'datetime', 'type', 'center', 'from'))->output();
        $email->attachData($pdf, $patient->first_name."-".$patient->last_name."-Screening.pdf");
        if((isset($screening['has_companion']) && $screening['has_companion'] == 'Yes') && !$this->referralType){
            // $companionPdf = PDF::loadView('pdf.patient-screening-companion', compact('patient', 'screening', 'datetime', 'type', 'center', 'from'))->output();
            // $email->attachData($companionPdf, $patient->first_name."-".$patient->last_name."-Companion-Screening.pdf");
            // Separate companion email now for future usage
            $companionReferralType = isset($screening['companion_details']['status']) ? $screening['companion_details']['status'] : null;
            Mail::to($patient->email)->send(
                new CompanionScreening($this->patient, $this->screening, $this->type, $companionReferralType)
            );
        }

        return $email;
    }
}
