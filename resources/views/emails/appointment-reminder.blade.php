@component('mail::message')
Hi {{ $appointment->first_name }},

Just want to remind you of your upcoming appointment an hour from now.

<dl>
	<dt>Doctor</dt>
	<dd>{{ $appointment->doctor->display_name }}</dd>
	<dt>Date and Time</dt>
	<dd>@dateTimeFormat($appointment->actual_datetime)</dd>
	<dt>Duration</dt>
    <dd>{{ $appointment->duration }} mins</dd>
    <dt>Type of Consultation</dt>
    <dd>{{ $appointment->type_display }}</dd>
    @if($appointment->isOnline())
    <dt>Teleconference Link</dt>
    <dd><a href="{{$appointment->join_url}}">{{$appointment->join_url}}</a></dd>
    @endif
</dl>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
