<?php

namespace App\Mail;

use App\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $rescheduled;
    public $appointment;
    public $remarks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Consultation $appointment, $rescheduled = false, $remarks = '')
    {
        $this->remarks = $remarks;
        $this->appointment = $appointment;
        $this->rescheduled = $rescheduled;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->rescheduled) {
            return $this->subject('Appointment Rescheduled')
                        ->markdown('emails.appointment-rescheduled');
        }

        return $this->markdown('emails.consultation-approved');
    }
}
