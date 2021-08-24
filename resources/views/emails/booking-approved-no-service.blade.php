@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},<p>
<p>The preferred schedules of the services you selected are more than five (5) days apart. Because the patient screening form is valid for five (5) days only, you will be asked to fill out another form at least 24 hours before the next scheduled appointment. Separate payments will be requested accordingly.</p>
{{ config('app.name') }}
@endcomponent
