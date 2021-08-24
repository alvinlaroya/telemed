@component('mail::message')
Hi {{ $booking->patient->first_name }},

Just want to remind you of your upcoming appointment an hour from now.

<strong>Reference #:</strong> {{ $booking->booking_reference_no }} <br>
<strong>Date & Time:</strong> @dateTimeFormat($bCenter->available_date) <br>
<strong>{{ $bCenter->name }}</strong> <br>
<ul>
    @foreach($bCenter->bookingServices as $service)
    <?php if (!$service->isConfirmed()) continue; ?>
    <li>{{ $service->name }}</li>
    @endforeach
</ul>

Please bring your ID and show email notification or voucher (if applicable) on the day of your test or procedure.

See you in ABC Hospital. Safety is our utmost priority. As we are embrace the new normal we would like to remind you of extra care guidelines. <br>
<ol>
    <li>No Mask, No Entry </li>
    <li>No Face Shield No Entry (Face shield should cover the whole face, visor types are not allowed)</li>
    <li>Allow time for thermal and secondary screening</li>
    <li>Observe social distancing at all times</li>
    <li>Come approximately 20 minutes before your procedure</li>
    <li>Only one companion is allowed per patient inside the center</li>
</ol>
<br>

For any issues or concerns please contact us at {{ config('telemed.contact_no') }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
