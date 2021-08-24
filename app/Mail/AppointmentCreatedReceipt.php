<?php

namespace App\Mail;

use App\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCreatedReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $paymentInstructions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Consultation $appointment, $paymentInstructions)
    {
        $this->appointment         = $appointment;
        $this->paymentInstructions = $paymentInstructions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment has been placed')
                    ->markdown('emails.appointment-created-receipt');
    }
}
