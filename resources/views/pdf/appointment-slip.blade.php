<!DOCTYPE html>
<html>
    <head>
        <title>Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dejavu-sans@1.0.0/css/dejavu-sans.min.css">
        @include('pdf.style.style')
    </head>
    <body>
        <div class="header-table">
            <table width="100%">
                <tr>
                    <td width="60%" class="header-left">
                        <img class="header-logo" src="{{ asset('images/logo-v2.png')}}" alt="MyHospital">
                    </td>
                    <td width="40%" class="header-right company-details">
                        {{-- <h1>Voucher</h1> --}}
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="wrapper">
            <h2>Booking Details</h2>
            <p><span class="heading-details">Center: </span> {{ $center->name }}</p>
            <p><span class="heading-details">Reference no: </span> {{ $booking->booking_reference_no }}</p>
            <p><span class="heading-details">Patient Name: </span> {{ $booking->patient->name }}</p>
            <p><span class="heading-details">Mobile: </span> {{ $booking->patient->mobile }}</p>
            <p><span class="heading-details">Email: </span> {{ $booking->patient->email }}</p>
            <p><span class="heading-details">Service(s): </span></p>
            <ul>
                @forelse ($center->bookingServices as $bookingService)
                    @if($bookingService->status != 'cancelled')
                        <li>{{ $bookingService->service->name }}</li>
                    @endif
                @empty
                @endforelse
            </ul>
            <p><span style="font-weight: bold;">Senior Citizen or PWD: </span> {{ $booking->patient->pwd_senior ? 'Yes (20% Discounted)' : 'No' }}</p>
            @if($booking->patient->pwd_senior)
                <p><span style="font-weight: bold;">ID #: </span> {{ $booking->patient->id_number }}</p>
            @endif
            <p><span style="font-weight: bold;">Date & Time Slot: </span> {{ $center->available_date_time }}</p>

            @if($booking->patient->pwd_senior)
                <p><span style="font-weight: bold;">Total Amount: </span>&#8369; {{ number_format($center->center_discounted_total_amount, 2) }}</p>
            @else
                <p><span style="font-weight: bold;">Total Amount: </span>&#8369; {{ number_format($center->center_total_amount, 2) }}</p>
            @endif
            <p><span class="heading-details">Mode of Payment: </span> {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}
            @if($booking->mode_of_payment != 'credit_card')
                ( {{ $booking->mop_other }} )
            @endif
            </p>
        </div>
    </body>
</html>
