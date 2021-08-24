<?php

namespace App\Jobs;

use App\Booking;
use App\BaseModel;
use App\BookingCenter;
use Illuminate\Bus\Queueable;
use App\Jobs\ProcessSmsSending;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemindBookings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('RemindBookings called every 5 mins');

        $date = new \DateTime();
        $date->modify('+1 hour');
        $formattedDate = $date->format('Y-m-d H:i:s');

        // booking reminder
        $query = BookingCenter::confirmed()
                    ->where('reminder_sent', false)
                    ->where('available_date', '<=', $formattedDate);

        $bCenters = $query->get();
        if ($bCenters->count() > 0) {
            foreach ($bCenters as $bCenter) {
                Mail::to($bCenter->email)->queue(new \App\Mail\BookingReminder($bCenter));

                $booking = $bCenter->booking;
                ProcessSmsSending::dispatch('patient_service_reminder', $booking->patient->mobile , [
                    'first_name' => $booking->patient->first_name,
                    'last_name' => $booking->patient->last_name,
                    'misc_shortcodes' => json_encode([
                        'reference_no' => $booking->booking_reference_no,
                        'booking_date' => $bCenter->available_date->format(BaseModel::DATETIME_FORMAT),
                    ])
                ]);
            }

            $query->update(['reminder_sent' => true]);
        }

        // payment reminder 1 hr before payment_expiration
        $reminderQuery = Booking::approved()
                            ->whereNull('paid_at')
                            ->where('payment_reminder_sent', false)
                            ->where('expiration', '<=', $formattedDate)
                            ->whereHas('bookingCenters', function($q) use($formattedDate) {
                                $q->where('preferred_date', '>=', $formattedDate);
                            });

        $remindBookings = $reminderQuery->get();
        if ($remindBookings->count() > 0) {
            foreach($remindBookings as $b) {
                Mail::to($b->patient->email)->queue(new \App\Mail\BookingPaymentReminder($b));
            }

            $reminderQuery->update(['payment_reminder_sent' => true]);
        }

        // set status to expired for payments not setted
        $expiredQuery = Booking::approved()
                    ->whereNull('paid_at')
                    ->where('expiration', '<=', now()->format('Y-m-d H:i:s'));

        // save each para mag fire ung model events
        foreach ($expiredQuery->get() as $expired) {
            $expired->status = Booking::EXPIRED;
            $expired->save();

            $expired->bookingCenters()->update([
                'status' => Booking::EXPIRED
            ]);
            $expired->bookingServices()->update([
                'status' => Booking::EXPIRED
            ]);
        }

        echo now()->format('Y-m-d H:i:s');
    }
}
