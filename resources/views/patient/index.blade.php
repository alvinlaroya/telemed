@extends('layouts.patient')

@section('content')

<div class="row">
    <div class="col-12 col-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2
            mb-3 border-bottom">

            <h1 class="h2">Appointments</h1>

        </div>
        <div class="card">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-latest-tab" data-toggle="tab" href="#nav-consultation" role="tab" aria-controls="nav-consultation" aria-selected="true">Consultation</a>
                    <a class="nav-item nav-link" id="nav-ongoing-tab" data-toggle="tab" href="#nav-diagnostic" role="tab" aria-controls="nav-diagnostic" aria-selected="false">Diagnostic</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-consultation" role="tabpanel" aria-labelledby="nav-latest-tab">
                    <ul class="list-group list-group-flush">
                        @if(count($latest) > 0)
                            @foreach($latest as $key => $appointment)
                                @include('patient.includes.appointment-list', $appointment)
                            @endforeach
                        @else
                            <li class="list-group-item">No Latest Appointments</li>
                        @endif
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-diagnostic" role="tabpanel" aria-labelledby="nav-latest-tab">
                    <ul class="list-group list-group-flush">
                        @if(count($bookings) > 0)
                            @foreach($bookings as $key => $appointment)
                                @include('patient.includes.appointment-list', $appointment)
                            @endforeach
                        @else
                            <li class="list-group-item">No Latest Appointments</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
       {{--  @if(count($bookings) > 0)
            @foreach($bookings as $key => $booking)
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                        {{ $booking->patient->name }} <span class="badge badge-secondary ml-1 {{ $booking->status }}">{{ ucwords($booking->status) }}</span>
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
        @endif --}}
        {{-- @if(count($latest) > 0)
            @foreach($latest as $key => $appointment)
                @include('patient.includes.appointment-list', $appointment)
            @endforeach
        @else
            <li class="list-group-item">No Latest Appointments</li>
        @endif --}}
        {{-- @include('patient.includes.appointment-list') --}} {{-- w/o back-end --}}
    </div>
    <div class="col col-md-8">
        <div class="customCalendar" style="padding-top: 7px">
            <div id="calendar" data-url="{{ route('patient.calendar-fetch') }}"></div>
        </div> 
    </div>
</div>

@endsection

