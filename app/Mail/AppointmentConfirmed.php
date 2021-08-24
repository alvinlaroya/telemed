<?php

namespace App\Mail;

use App\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppointmentConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Consultation $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::signedRoute('appointment.details', $this->appointment);

        return $this->markdown('emails.consultation-confirmation')
                    ->with([
                        'url' => $url,
                    ]);
    }
}
