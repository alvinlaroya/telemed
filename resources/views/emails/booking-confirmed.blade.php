@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},</p>
<p></p>
<p>Your procedure schedule has been confirmed!</p>

<p><b>Appointment Details:</b></p>
<p><b>Reference #:</b> {{ $booking->booking_reference_no }}</p>
<p><span>Service/s:</span></p>
<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        <li>
            <span>{{ $bookingCenter->name }}</span>
            @if($bookingCenter->bookingServices)
                <ul>
                    @foreach ($bookingCenter->bookingServices as $service)
                        <li>{{ $service->name }} <span class="badge {{ $service->status }}">{{ strtoupper($service->status) }}</span>
                            @if($service->status == 'cancelled')
                                <p>Remarks: {{ $service->remarks }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @empty
    @endforelse
</ul>
<p><span>Procedure Schedule: </span>
<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        @if($bookingCenter->number_of_approved > 0)
            <li><span>{{ $bookingCenter->name }} ( {{ $bookingCenter->available_date_time }} )</span></li>
        @else
            <li><span>{{ $bookingCenter->name }} ( NOT AVAILABLE )</span></li>
        @endif
    @empty
    @endforelse
</ul>
</p>
@if($booking->patient->pwd_senior)
<p><span>Senior Citizen or PWD: </span> Yes</p>
<p><span>ID #: </span> {{ $booking->patient->id_number }}</p>
<p><span>Sub Total: </span> &#8369;{{number_format($totalAmount, 2)}}</p>
<p><span>Discount: </span> &#8369;{{number_format($discount, 2)}}</p>
<p><b>Amount paid: </b> &#8369;{{number_format($amountPaid, 2)}}</p>
@else
<p><b>Amount paid: </b> &#8369;{{number_format($amountPaid, 2)}}</p>
@endif
<p><b>Payment Reference #: </b> {{ $booking->payment_ref }}</p>

<p>
Please bring a valid photo ID and show this email notification or appointment information voucher on the day of your test or procedure.
{{-- Be ready to present your Screening Form at the entrance of ABC Hospital. --}}
</p>
<p></p>

<p>Your safety is a priority in ABC Hospital.  Please be guided by our safety protocols:</p>
<ol>
    <li>No Mask, No Entry </li>
    <li>No Face Shield No Entry (Face shield should cover the whole face, visor types are not allowed)</li>
    <li>Allow time for thermal and secondary screening</li>
    <li>Observe social distancing at all times</li>
    <li>Come approximately 20 minutes before your procedure</li>
    <li>
        Only one (1) companion is allowed per patient.
        {{-- Companion should also accomplish a Screening Form. --}}
    </li>
</ol>

<p>For any issues or concerns please contact ABC Hospital On-Call at +632 1111 2222 or email us at abc@hospital.com</p>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
