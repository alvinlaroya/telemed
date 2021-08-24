@component('mail::message')
Hi {{ $appointment->first_name }},

Your appointment with Dr. {{ $appointment->doctor->full_name }} has been approved.

Appointment Details: <br>
<strong>Reference #:</strong> {{$appointment->reference_no}} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date:</strong> @dateFormat($appointment->actual_datetime) <br>
<strong>Time:</strong>
@timeFormat($appointment->actual_datetime) - @timeFormat($appointment->actual_endtime)
<br>
<strong>Type of Consultation:</strong> {{$appointment->type_display}} <br>
@if($appointment->payment_required)
<strong>Amount to be paid:</strong> @money($appointment->consultation_fee) <br>
@endif
@if($remarks)
<strong>Remarks:</strong> {{ $remarks }} <br>
@endif

@if($appointment->payment_required)
Payment Instructions: <br>
{!! $appointment->doctor->payment_instructions !!}
@endif
<br>

Thank you!<br>
{{ config('app.name') }}
@endcomponent
