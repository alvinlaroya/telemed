@component('mail::message')

An appointment has been requested.

Details: <br>
<strong>Reference #:</strong> {{$appointment->reference_no}} <br>
<strong>Type of Consultation:</strong> {{$appointment->type_display}} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date & Time:</strong> @dateTimeFormat($appointment->actual_datetime) <br>
<strong>Complaint:</strong> <br>
{!! $appointment->complaint!!}
<br>

Click link below to view details.

<a href="{{ route('doctor.appointments.show', $appointment) }}">
	{{ route('doctor.appointments.show', $appointment) }}
</a>
<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
