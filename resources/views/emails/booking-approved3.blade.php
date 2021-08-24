@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},<p>
<p></p>
<p>Greetings! Your payment has been received and service request confirmed:</p>
<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        <li>
            <span><b>{{ $bookingCenter->name }}</b></span>
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

<p><b>Appointment Details:</b></p>
<p><b>Reference #: </b> {{ $booking->booking_reference_no }}</p>
<p><span>Appointment schedule for the following center(s): </span>
<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        @if($bookingCenter->number_of_approved > 0)
            <li><span>{{ $bookingCenter->name }} ( {{ $bookingCenter->available_date_time }} )</span>
                <p>Remarks: {{ $bookingCenter->remarks }}</p>
            </li>
        @else
            <li><span>{{ $bookingCenter->name }} ( NOT AVAILABLE )</span>
                <p>Remarks: {{ $bookingCenter->remarks }}</p>
            </li>
        @endif
    @empty
    @endforelse
</ul>
</p>
{{-- <p>Payment Mode: {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</p>
@if($booking->patient->pwd_senior)
<p><span>Senior Citizen or PWD: </span> Yes</p>
<p><span>ID #: </span> {{ $booking->patient->id_number }}</p>
<p><span>Sub Total: </span> &#8369;{{number_format($booking->total_amount, 2)}}</p>
<p><span>Discount: </span> &#8369;{{number_format($booking->discount, 2)}}</p>
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->discounted_total_amount, 2)}}</p>
@else
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->total_amount, 2)}}</p>
@endif --}}

<p>Review your appointment details and schedule at <a href="{{ route('patient.servicesBooking.show', $booking) }}">{{ route('patient.servicesBooking.show', $booking->booking_reference_no) }}</a>.  
Please complete any requirements needed for your appointment.  </p>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
