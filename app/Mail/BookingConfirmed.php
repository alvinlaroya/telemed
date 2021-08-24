<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $totalAmount;
    public $amountPaid;
    public $discount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $totalAmount, $amountPaid, $discount)
    {
        $this->booking = $booking;
        $this->totalAmount = $totalAmount;
        $this->amountPaid = $amountPaid;
        $this->discount = $discount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email =  $this->subject('Your Appointment Has Been Confirmed')
            ->markdown('emails.booking-confirmed');
            // ->attachData($this->pdf->output(), Carbon::now()." payment-voucher.pdf");

        if($this->booking->bookingCenters) {
            foreach($this->booking->bookingCenters as $key => $bookingCenter) {
                if($bookingCenter->isWithin5Days()) {
                    $booking = $this->booking;
                    $center = $bookingCenter;
                    $pdf = PDF::loadView('pdf.booking-voucher', compact('booking', 'center'))->output();
                    $email->attachData($pdf, Carbon::now(). ' ' . $center->name ."-payment-voucher.pdf");
                }
            }
        }

        return $email;
    }
}
