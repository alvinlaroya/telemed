@component('mail::message')
<p>Payment Failed for Patient {{ $booking->patient->name }}, reference # {{ $booking->booking_reference_no }}</p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
