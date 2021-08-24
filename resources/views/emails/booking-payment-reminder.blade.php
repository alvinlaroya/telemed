@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},<p>

If you haven't already, please settle the payment for your upcoming appointment.

<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        <li>
            <span>{{ $bookingCenter->name }}</span>
            @if($bookingCenter->bookingServices)
                <ul>
                    @foreach ($bookingCenter->bookingServices as $service)
                        <li>{{ $service->name }} <span class="badge {{ $service->status }}">{{ strtoupper($service->status) }}</span></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @empty
    @endforelse
</ul>

<p><b>Appointment Details:</b></p>
<p><span>Reference #: </span> {{ $booking->booking_reference_no }}</p>
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
<p>
    <span>Amount to be paid: </span>
    <span class="{{$booking->patient->pwd_senior ? 'discounted' : ''}}">
        @money($booking->total_amount)
    </span>
    @if($booking->patient->pwd_senior)
    <span>@money($booking->discounted_total_amount) (with 20% Discount)</span>
    @endif
</p>

<p>To pay, please click the link below:</p>
<a href="{{ route('bookingService.payment', $booking->booking_reference_no) }}">{{ route('bookingService.payment', $booking->booking_reference_no) }}</a>
<p></p>
@if($booking->comment)
<p><b>Additional Information:</b></p>
<p>{{$booking->comment}}</p>
@endif

Thank you!<br>
{{ config('app.name') }}
@endcomponent
