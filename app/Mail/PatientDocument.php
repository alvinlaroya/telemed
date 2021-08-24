<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientDocument extends Mailable
{
    use Queueable, SerializesModels;

    public $booking, $message, $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $message, $files)
    {
        $this->booking = $booking;
        $this->message = $message;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  $this->subject('You have received a document')
            ->markdown('emails.patient-document');

        $files = $this->files;

        if (count($files) > 0) {
            foreach($files as $file) {
                $email->attach($file->getPath(), array(
                    'as' => $file->name,
                    'mime' => $file->mime_type)
                );
            }
        }

        return $email;
    }
}
