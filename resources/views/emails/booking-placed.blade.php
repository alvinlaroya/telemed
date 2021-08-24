@component('mail::message')

GREETINGS! YOUR REQUEST HAS BEEN RECEIVED.

<p>Hi {{ $booking->patient->first_name }},<p>

<p>Your appointment with Reference #{{ $booking->booking_reference_no }} for the following service(s) has been received.</p>

@forelse ($booking->bookingCenters as $bookingCenter)
   
{{ $bookingCenter->name }}
@if($bookingCenter->bookingServices)

@foreach ($bookingCenter->bookingServices as $service)
{{ $service->name }} {{ Str::upper($booking->status) }}
@endforeach

@endif

@empty
@endforelse

Appointment Details:<br />
<strong>Reference #:</strong>{{ $booking->booking_reference_no }}<br />

<p>
    <span>Amount due: </span>
    <span class="{{ $booking->patient->pwd_senior ? 'discounted' : '' }}">
        @money($booking->total_amount)
    </span>
    @if($booking->patient->pwd_senior)
    <span>@money($booking->discounted_total_amount) (with 20% Discount)</span>
    @endif
</p>

<strong>Payment Instructions:</strong> 
<p>Please deposit to any of the following accounts:</p> 

BPI:  3025-6112-75
BDO:  007380153363
GCash:  09178818268

Upon completion of payment, kindly upload deposit slip through this link <a href="{{ route('patient.servicesBooking.show', $booking) }}">{{ route('patient.servicesBooking.show', $booking) }}</a><br>

Thank you!<br>
{{ config('app.name') }} Team
@endcomponent
