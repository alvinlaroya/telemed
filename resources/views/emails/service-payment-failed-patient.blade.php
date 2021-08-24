@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},</p>
<p></p>
<p>Your payment for appointment reference # {{ $booking->booking_reference_no }} has failed.</p>

<p><b>Appointment Details:</b></p>
<p><b>Reference #: </b> {{ $booking->booking_reference_no }}</p>
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
<p><span>Available date & time slot for the following centers: </span>
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
<p><span>Sub Total: </span> &#8369;{{number_format($booking->total_amount, 2)}}</p>
<p><span>Discount: </span> &#8369;{{number_format($booking->discount, 2)}}</p>
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->discounted_total_amount, 2)}}</p>
@else
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->total_amount, 2)}}</p>
@endif

If you wish to book again, please go to <a href="{{ route('booking-service-patient') }}">{{ route('booking-service-patient') }}</a>

<p>Thank you!</p>
{{ config('app.name') }}
@endcomponent
