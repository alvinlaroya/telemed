@component('mail::message')
Hi {{ $appointment->first_name }},

Greetings! Your appointment with Dr. {{ $appointment->doctor->full_name }} has been rescheduled.

Appointment Details: <br>
<strong>Reference #:</strong> {{$appointment->reference_no}} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date:</strong> @dateFormat($appointment->actual_datetime) <br>
<strong>Time:</strong>
@timeFormat($appointment->actual_datetime) - @timeFormat($appointment->actual_endtime)
<br>
<strong>Type of Consultation:</strong> {{ $appointment->type_display }} <br>
@if($appointment->payment_required)
<strong>Amount to be paid:</strong> @money($appointment->consultation_fee) <br>
@endif
@if($remarks)
<strong>Remarks:</strong> {{ $remarks }} <br>
@endif

@if($appointment->payment_required)
<strong>Payment Instructions:</strong> <br>

<p>If you have not yet paid, please deposit to {!! $appointment->doctor->payment_instructions !!}.</p>
@endif

<p>Upon completion of payment, kindly upload deposit slip through this link <a href="{{ route('appointment.patient.details', $appointment) }}">{{ route('appointment.patient.details', $appointment) }}</a></p><br>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
