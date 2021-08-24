@component('mail::message')

THANK YOU FOR YOUR PAYMENT!

Hi {{ $appointment->first_name }},

We have received your payment for your booking with reference #{{ $appointment->reference_no }}. Your apppointment is confirmed. 

Appointment Details: <br>
<strong>Reference #:</strong> {{$appointment->reference_no}} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date & Time:</strong> @dateTimeFormat($appointment->actual_datetime) <br>
<strong>Type of Consultation:</strong> {{$appointment->type_display}} <br>
@if($appointment->isOnline())
<strong>Teleconference Link:</strong> <a href="{{ $appointment->join_url }}">{{ $appointment->join_url }}</a> <br>
@endif

<p>Please submit Medical History and Chief Complaint form prior to your appointment. You may download the forms and upload at the link below.</p>
<a href="{{ route('appointment.patient.details', $appointment) }}">{{ route('appointment.patient.details', $appointment) }}</a>
<br><br>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
