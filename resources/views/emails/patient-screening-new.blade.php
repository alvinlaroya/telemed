@component('mail::message')
@php
    $latestSched = null;
    foreach($booking->bookingCenters as $key => $bookingCenter) {
        $latestSched = $bookingCenter->available_date;
    }
@endphp
<p>Hi {{ $patient->first_name }},</p>

<p>Your screening record has expired,</p>

<p>Please note that the screening form is valid for five (5) days only. Your previous patient and/or companion screening record dated {{ date('m/d/Y', strtotime($patient->getLatestScreeningForm()->created_at )) }} is no longer valid.  For your appointment scheduled on {{ date('m/d/Y', strtotime($latestSched)) }}, please fill out another one by clicking <a href="{{ $screeningUrl }}"><b>here.</b></a></p>

<p>Please bring a printed copy or saved copy of the new Patient Screening Form on your visit.</p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
