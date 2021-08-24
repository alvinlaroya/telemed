@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},</p>
<p></p>
<p>Your payment for appointment reference # {{ $booking->booking_reference_no }} is successful.</p>

<p>Payment Reference #: {{ $booking->payment_ref }}</p>

<p>You will receive another email with the appointment information voucher.</p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
