@component('mail::message')
<p>A procedure appointment request has been confirmed and paid with reference #{{$booking->booking_reference_no}}.</p>
<p>Click this link for details :<a href="{{ route('center.bookings.details', $booking) }}">{{ route('center.bookings.details', $booking->id) }}</a> </p>

Thank you!<br>
{{ config('app.name') }}
@endcomponent
