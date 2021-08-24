@component('mail::message')
<p>Hi {{ $booking->patient->first_name }},<p>
<p></p>
<p>Your appointment for the following service(s) has been reviewed:</p>
<ul>
    @forelse ($booking->bookingCenters as $bookingCenter)
        @if($bookingCenter->isWithin5Days())
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
        @endif
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
<p>Payment Mode: {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</p>
@if($booking->patient->pwd_senior)
<p><span>Senior Citizen or PWD: </span> Yes</p>
<p><span>ID #: </span> {{ $booking->patient->id_number }}</p>
<p><span>Sub Total: </span> &#8369;{{number_format($booking->total_amount, 2)}}</p>
<p><span>Discount: </span> &#8369;{{number_format($booking->discount, 2)}}</p>
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->discounted_total_amount, 2)}}</p>
@else
<p><b>Amount to be paid: </b> &#8369;{{number_format($booking->total_amount, 2)}}</p>
@endif

{{-- <i>All appointments require a Patient Screening Form which has a validity of five (5) days. If you have more than one (1) appointment and is scheduled after five (5) days, a separate notification will be sent to you two (2) days before this appointment.  You will be asked to fill out a new Patient Screening Form at least 24 hours prior to this appointment and settle the fees related to it.  All accomplished Patient Screening Forms are valid only for five (5) days.</i> --}}

<p>Payment is required to confirm this booking. To pay, please click the link below:</p>
<a href="{{ route('bookingService.payment', $booking->booking_reference_no) }}">{{ route('bookingService.payment', $booking->booking_reference_no) }}</a>
<p></p>
@if($booking->comment)
<p><b>Additional Information:</b></p>
<p>{{$booking->comment}}</p>
@endif
<i>Note: this transaction has to be paid within 24 hours. Otherwise, it will automatically be cancelled.</i>
<p></p>
Thank you!<br>
{{ config('app.name') }}
@endcomponent

