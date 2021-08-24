@component('mail::message')
GREAT NEWS! YOUR CONSULTATION HAS BEEN SCHEDULED. 

Hi {{ $appointment->first_name }},

Your consultation with Dr. {{ $appointment->doctor->full_name }} has been scheduled.

Appointment Details: <br>
<strong>Reference #:</strong> {{ $appointment->reference_no }} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date:</strong> @dateFormat($appointment->actual_datetime) <br>
<strong>Time:</strong> @timeFormat($appointment->actual_datetime) - @timeFormat($appointment->actual_endtime)<br>
<strong>Type of Consultation:</strong> {{ $appointment->type_display }} <br>
<strong>Amount to be paid:</strong> ₱ {{ $appointment->consultation_fee }} <br>

<strong>Payment Instructions:</strong>

Please deposit payment to {{ strip_tags($paymentInstructions) }}

Upon completion of payment, kindly upload deposit slip through this link <a href="{{ route('appointment.patient.details', $appointment) }}">{{ route('appointment.patient.details', $appointment) }}</a>


Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
