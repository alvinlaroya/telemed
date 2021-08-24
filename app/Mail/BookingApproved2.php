<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class BookingApproved2 extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Your request has been reviewed')
            ->markdown('emails.booking-approved2');

        if($this->booking->bookingCenters) {
            foreach($this->booking->bookingCenters as $key => $bookingCenter) {
                $booking = $this->booking;
                $center = $bookingCenter;
                $pdf = PDF::loadView('pdf.appointment-slip', compact('booking', 'center'))->output();
                $email->attachData($pdf, Carbon::now(). ' ' . $center->name ."-appointment-slip.pdf");
            }
        }

        return $email;
    }
}
