@extends('layouts.frontpage')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="book-details-page">
                @if($booking)
                <div class="row justify-content-center">
                    <div class="col-md-8 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Booking Details</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Booking Reference No.:</h6>
                                </div>
                                <span class="text-success">{{ $booking->booking_reference_no }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Service:</h6>
                                </div>
                                <span class="text-muted">
                                    <ul>
                                        @forelse ($booking->bookingCenters as $bookingCenter)
                                            {{-- @if($bookingCenter->isWithin5Days()) --}}
                                            <li>
                                                <span>{{ $bookingCenter->name }}</span>
                                                @if($bookingCenter->bookingServices)
                                                    <ul>
                                                        @foreach ($bookingCenter->bookingServices as $service)
                                                            <li>{{ $service->name }} <span class="badge {{ $service->status }}">{{ strtoupper($service->status) }}</span>
                                                                @if($service->status == 'cancelled')
                                                                    <p style="margin-bottom: 5px;"><b>Remarks:</b> {{ $service->remarks }}</p>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                            {{-- @endif --}}
                                        @empty
                                        @endforelse
                                    </ul>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Name:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Birthdate:</h6>
                                </div>
                                <span class="text-muted">@dateFormat($booking->patient->birthdate)</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Email:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->email}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Mobile:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->mobile }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Province:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->province->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">City:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->city->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">House number:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->house_number }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Street:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->street }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Barangay:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->barangay }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Zipcode:</h6>
                                </div>
                                <span class="text-muted">{{ $booking->patient->zipcode }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Mode of Payment:</h6>
                                </div>
                                <span class="text-muted">{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}
                                @if($booking->mode_of_payment != 'credit_card')
                                    ( {{ $booking->mop_other }} )
                                @endif
                                </span>
                            </li>
                            @if($booking->patient->pwd_senior)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Senior Citizen or PWD:</h6>
                                    </div>
                                    <span class="text-muted">{{ $booking->patient->pwd_senior ? 'Yes' : 'No' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">ID Number :</h6>
                                    </div>
                                    <span class="text-muted">{{ $booking->patient->id_number }}</span>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Available Date & Time slot:</h6>
                                </div>
                                <span>
                                    <ul>
                                        @forelse ($booking->bookingCenters as $bookingCenter)
                                            {{-- @if($bookingCenter->isWithin5Days()) --}}
                                                @if($bookingCenter->number_of_approved > 0)
                                                    <li><span>{{ $bookingCenter->name }} ( {{ $bookingCenter->available_date_time }} )</span></li>
                                                @else
                                                    <li><span>{{ $bookingCenter->name }} ( NOT AVAILABLE )</span></li>
                                                @endif
                                            {{-- @endif --}}
                                        @empty
                                        @endforelse
                                    </ul>
                                </span>
                            </li>
                            @if($booking->patient->pwd_senior)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0">Sub Total: </h6>
                                    </div>
                                    <span>&#8369;{{number_format($booking->total_amount, 2)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0">Discount: </h6>
                                    </div>
                                    <span>&#8369;{{number_format($booking->discount, 2)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0"><b>Amount to be paid: </b> </h6>
                                    </div>
                                    <span>&#8369;{{number_format($booking->discounted_total_amount, 2)}}</span>
                                </li>
                            @else
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0"><b>Amount to be paid: </b> </h6>
                                    </div>
                                    <span>&#8369;{{number_format($booking->total_amount, 2)}}</span>
                                </li>
                            @endif
                        </ul>
                        <form class="card p-2" name="payFormCcard" method="post" action="{{ config('telemed.asiapay.link') }}">
                            <input type="hidden" name="merchantId" value="{{ config('telemed.asiapay.merchantId') }}">
                            <input type="hidden" name="amount" value="{{ $booking->patient->pwd_senior ? $booking->discounted_total_amount : $booking->total_amount }}" >
                            <input type="hidden" name="orderRef" value="{{ $booking->booking_reference_no }}">
                            <input type="hidden" name="currCode" value="{{ config('telemed.asiapay.currCode') }}" >
                            <input type="hidden" name="mpsMode" value="{{ config('telemed.asiapay.mpsMode') }}" >
                            <input type="hidden" name="successUrl" value="{{ config('telemed.asiapay.successUrl') }}">
                            <input type="hidden" name="failUrl" value="{{ config('telemed.asiapay.failUrl') }}">
                            <input type="hidden" name="cancelUrl" value="{{ config('telemed.asiapay.cancelUrl') }}">
                            <input type="hidden" name="payType" value="{{ config('telemed.asiapay.payType') }}">
                            <input type="hidden" name="lang" value="{{ config('telemed.asiapay.lang') }}">
                            <input type="hidden" name="payMethod" value="{{ config('telemed.asiapay.payMethod') }}">
                            <input type="hidden" name="secureHash" value="{{ $securehash }}">
                            <div class="text-right">
                            {{-- <a href="javascript:void(0)"
                            id="cancelBooking"
                            class="btn btn-danger btn-paynow"
                            data-link="{{ route('servicesBooking.cancel', $booking) }}"><i class="fas fa-credit-card"></i> CANCEL BOOKING</a> --}}
                                <button type="submit" class="btn btn-primary btn-paynow"><i class="fas fa-credit-card"></i> PAY NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                    <div class="py-5 text-center">
                        <h2>LINK EXPIRED!</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
