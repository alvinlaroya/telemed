@component('mail::message')
<p>Patient {{ $booking->patient->name }} has cancelled payment with reference # {{ $booking->booking_reference_no }}</p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
