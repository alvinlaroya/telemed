@component('mail::message')

<p>PROCEDURE BOOKING REQUEST</p>

<p>A procedure appointment request has been placed with reference #{{ $booking->booking_reference_no }}.</p>

<p>Click this link for details : <a href="{{ route('center.bookings.details', $booking) }}">{{ route('center.bookings.details', $booking) }}</a></p>

<p>Please confirm the date and enter time of service (s).  Upon confirmation of payment, MyHospital will click APPROVE to confirm the booking.</p>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
