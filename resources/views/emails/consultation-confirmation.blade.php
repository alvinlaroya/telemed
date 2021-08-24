@component('mail::message')
Hi {{ $appointment->first_name }},

Your appointment with Dr. {{ $appointment->doctor->full_name }} has been confirmed.

Appointment Details: <br>
<strong>Reference #:</strong> {{$appointment->reference_no}} <br>
<strong>Name:</strong> {{$appointment->name}} <br>
<strong>Date & Time:</strong> @dateTimeFormat($appointment->actual_datetime)
<br>
<strong>Type of Consultation:</strong> {{$appointment->type_display}} <br>
@if($appointment->isOnline())
<strong>Teleconference Link:</strong> <a href="{{$appointment->join_url}}">{{$appointment->join_url}}</a> <br>
@endif

If you want to add more details for the appointment, click on the link below.

<a href="{{ $url }}">{{ $url }}</a>

Thank you!<br>
{{ config('app.name') }}
@endcomponent
