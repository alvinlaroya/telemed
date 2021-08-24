@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},<p>
<p></p>
<p>Your appointment with Reference #{{ $booking->booking_reference_no }} for the following service(s) has been reviewed:</p>
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
<p><span>Appointment schedule for the following centers: </span>
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
<p>Payment Mode: {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}
@if($booking->mode_of_payment != 'credit_card')
    ( {{ $booking->mop_other }} )
@endif
</p>
@if($booking->patient->pwd_senior)
<p><span>Senior Citizen or PWD: </span> Yes</p>
<p><span>ID #: </span> {{ $booking->patient->id_number }}</p>
<p><span>Sub Total: </span> &#8369;{{number_format($booking->total_amount, 2)}}</p>
<p><span>Discount: </span> &#8369;{{number_format($booking->discount, 2)}}</p>
<p><b>Amount: </b> &#8369;{{number_format($booking->discounted_total_amount, 2)}}</p>
@else
<p><b>Amount: </b> &#8369;{{number_format($booking->total_amount, 2)}}</p>
@endif

<p>Please bring your documentation upon availing of the service</p>
<p></p>
@if($booking->comment)
<p><b>Additional Information:</b></p>
<p>{{$booking->comment}}</p>
@endif
<p></p>
Thank you!<br>
{{ config('app.name') }}
@endcomponent
