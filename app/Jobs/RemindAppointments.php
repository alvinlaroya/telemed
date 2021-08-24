<?php

namespace App\Jobs;

use App\BaseModel;
use App\Consultation;
use Illuminate\Bus\Queueable;
use App\Jobs\ProcessSmsSending;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

// 1 hr before the appointment
class RemindAppointments implements ShouldQueue
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
        logger('RemindAppointments called every 5 mins');

        $date = new \DateTime();
        $date->modify('+1 hour');
        $formattedDate = $date->format('Y-m-d H:i:s');
        $query = Consultation::confirmed()
                            ->where('appt_reminder_sent', false)
                            ->where('actual_datetime', '<=', $formattedDate);

        $appointments = $query->get();
        if ($appointments->count() > 0) {
            foreach($appointments as $c) {
                Mail::to($c->email)->queue(new \App\Mail\AppointmentReminder($c));

                ProcessSmsSending::dispatch('doctor_appointment_reminder', $c->doctor->mobile, [
                    'first_name' => $c->doctor->first_name,
                    'last_name' => $c->doctor->last_name,
                    'misc_shortcodes' => json_encode([
                        'reference_no' => $c->reference_no,
                        'patient_name' => $c->patient->first_name . ' ' . $c->patient->last_name,
                        'booking_date' => $c->actual_datetime->format(BaseModel::DATETIME_FORMAT),
                    ])
                ]);
            }

            $query->update(['appt_reminder_sent' => true]);
        }

        // payment reminder 1 hr before payment_expiration
        $reminderQuery = Consultation::where('status', Consultation::APPROVED)
                            ->where('paid', false)
                            ->where('payment_required', true)
                            ->where('payment_reminder_sent', false)
                            ->where('payment_expiration', '<=', $formattedDate);

        $remindAppointments = $reminderQuery->get();
        if ($remindAppointments->count() > 0) {
            foreach($remindAppointments as $c) {
                Mail::to($c->email)->queue(new \App\Mail\PaymentReminder($c));
            }

            $reminderQuery->update(['payment_reminder_sent' => true]);
        }

        // set status to expired for payments not setted
        $expiredQuery = Consultation::where('status', Consultation::APPROVED)
                    ->where('paid', false)
                    ->where('payment_required', true)
                    ->where('payment_expiration', '<=', now()->format('Y-m-d H:i:s'));

        // save each para mag fire ung model events
        foreach ($expiredQuery->get() as $expired) {
            $expired->status = Consultation::EXPIRED;
            $expired->save();
        }

        echo now()->format('Y-m-d H:i:s');
    }
}
