@extends('layouts.support')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2
    mb-3 border-bottom">

    <h1 class="h2">Dashboard</h1>

</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header customCardHeader">Latest Bookings</h5>
            <ul class="list-group list-group-flush">
                @if(count($bookings) > 0)
                    @foreach($bookings as $key => $booking)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                {{ $booking->patient->name }} <span class="badge badge-secondary ml-1 {{ $booking->status }}">{{ ucwords($booking->status) }}</span>
                                    <small class="d-block"><i class="fa fa-at" style="width:15px"></i> {{ $booking->patient->email }}</small>
                                    <small class="d-block"><i class="fa fa-mobile" style="width:15px"></i> {{ $booking->patient->mobile }}</small>
                                </div>
                                {{-- <div class="col-auto">
                                    <a href="{{ route('admin.servicesBooking.show', $booking) }}" class="btn btn-sm btn-primary">View <i class="fa fa-angle-right ml-2"></i></a>
                                </div> --}}
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item">No Latest Bookings</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header customCardHeader">This Month</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="box">
                            <div class="number">
                                <span id="numOfTrans">{{ number_format($noOfTransactions)}}</span>
                            </div>
                            <div class="label-holder">
                                <span>No. of Transactions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <div class="number">
                                <span id="completeTrans">{{ number_format($completedTransactions) }}</span>
                            </div>
                            <div class="label-holder">
                                <span>Completed Transactions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <div class="number price">
                                &#8369;<span id="monthTotal">{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="label-holder">
                                <span>Total Amount</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
