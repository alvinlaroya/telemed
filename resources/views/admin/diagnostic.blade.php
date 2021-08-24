@extends('layouts.admin')

@section('content')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">
        Diagnostic
    </li>
@endpush

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Diagnostic</h1>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header customCardHeader">Latest Center Bookings</h5>
            <ul class="list-group list-group-flush">
                @if(count($bookings) > 0)
                    @foreach($bookings as $key => $booking)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">
                                {{ $booking->patient->name }} <span class="badge badge-secondary ml-1 {{ $booking->status }}">
                                    @if($booking->status == "approved")
                                        Requested
                                    @else
                                        {{ ucwords($booking->status) }}
                                    @endif
                                </span>    
                                </span>
                                    <small class="d-block"><i class="fa fa-at" style="width:15px"></i> {{ $booking->patient->email }}</small>
                                    <small class="d-block"><i class="fa fa-mobile" style="width:15px"></i> {{ $booking->patient->mobile }}</small>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.servicesBooking.show', $booking) }}" class="btn btn-sm btn-primary">View <i class="fa fa-angle-right ml-2"></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item">No Latest Bookings</li>
                @endif
            </ul>
        </div>
    </div>
</div>

@endsection
