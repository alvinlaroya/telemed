<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecondPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $patient, $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $booking)
    {
        $this->patient = $patient;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Second Payment')
            ->markdown('emails.second-payment');
    }
}
