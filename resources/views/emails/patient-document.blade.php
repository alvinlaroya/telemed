@component('mail::message')

GREETINGS! YOU HAVE RECEIVED A DOCUMENT. 

<p>Hi {{ $booking->patient->first_name }},</p>

<p>You have received the following file from MyHospital.</p>

<p>{{ $message }}</p>

<p>For more information, please login at <a href="{{ route('patient.servicesBooking.show', $booking) }}">{{ route('patient.servicesBooking.show', $booking) }}</a></p>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
