@component('mail::message')

GREETINGS!

<p>You have received the following file from Patient {{ $patientName }}.   
<p>If this is a deposit slip, please confirm schedule and approve transaction at <a href="{{ route('center.bookings.details', $booking) }}">{{ route('center.bookings.details', $booking) }}</a></p>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
