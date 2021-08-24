@component('mail::message')

DEAR DOCTOR, YOU RECEIVED A DOCUMENT. 

<p>You have received the following file from Patient {{ $patientFirstName }}.   
<p>If this is a deposit slip, please mark transaction as paid at <a href="{{ route('doctor.appointments.show', $appointment) }}">{{ route('doctor.appointments.show', $appointment) }}</a></p>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
