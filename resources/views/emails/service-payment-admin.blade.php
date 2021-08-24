@component('mail::message')

<p>Patient {{ $booking->patient->name }} has successfully paid with reference # {{ $booking->booking_reference_no }}</p>

<p>Payment Reference #: {{ $booking->payment_ref }}</p>

<p>Click this link for details : <a href="{{ route('center.bookings.details', $booking) }}">{{ route('center.bookings.details', $booking) }}</a></p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
