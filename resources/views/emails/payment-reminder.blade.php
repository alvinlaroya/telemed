@component('mail::message')
Hi {{ $appointment->first_name }},

If you haven't already, please settle the payment for your upcoming appointment.
If you have, thank you.

<dl>
	<dt>Reference #</dt>
    <dd>{{ $appointment->reference_no }}</dd>
    <dt>Doctor</dt>
	<dd>{{ $appointment->doctor->display_name }}</dd>
	<dt>Date and Time</dt>
    <dd>@dateTimeFormat($appointment->actual_datetime)</dd>
    <dt>Type of Consultaion</dt>
	<dd>{{ $appoointment->type_display }}</dd>
	<dt>Duration</dt>
    <dd>{{ $appointment->duration }} mins</dd>

</dl>

<br>
@if($appointment->payment_required)
Payment Instructions: <br>
{!! $appointment->doctor->payment_instructions !!}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
