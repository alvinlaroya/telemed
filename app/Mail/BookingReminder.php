<?php

namespace App\Mail;

use App\BookingCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $bCenter;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookingCenter $bCenter)
    {
        $this->bCenter = $bCenter;
        $this->booking = $bCenter->booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking-reminder');
    }
}
