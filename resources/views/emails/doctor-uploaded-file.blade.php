@component('mail::message')

GREETINGS! YOU HAVE RECEIVED A DOCUMENT. 

<p>Hi {{ $patientFirstName }},</p>

<p>You have received the following file from Doctor {{ $doctorFullName }}. </p>
<p>To view the file, please login at <a href="{{ route('appointment.patient.details', $appointment) }}">{{ route('appointment.patient.details', $appointment) }}</a></p><br>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
