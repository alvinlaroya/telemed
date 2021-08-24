@extends('layouts.doctor')

@section('content')

{{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2
    mb-3 border-bottom">

    <h1 class="h2">Hello {{ auth()->user()->isSecretary() ? auth()->user()->name : auth()->user()->doctor->name }}</h1>

</div> --}}

<div class="row">
    <div class="col-12 col-md-4">
        @if(count($doctorLogged->schedules) <= 0)
            <div class="alert alert-danger" role="alert">
                <strong>No schedules created.</strong> Click <a href="{{ route('doctor.schedule') }}"><strong>here</strong></a> to create your first schedule.
            </div>
        @endif
        @if(count($scheduleTomorrow) <= 0 && count($doctorLogged->schedules) > 0)
            <div class="alert alert-danger" role="alert">
                <strong>No set schedule for tomorrow.</strong> Click <a href="{{ route('doctor.schedule') }}"><strong>here</strong></a> to update your schedule.
            </div>
        @endif
        <div class="card">
            <h5 class="card-header customCardHeader">Appointments</h5>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-latest-tab" data-toggle="tab" href="#nav-latest" role="tab" aria-controls="nav-latest" aria-selected="true">Latest</a>
                    <a class="nav-item nav-link" id="nav-ongoing-tab" data-toggle="tab" href="#nav-ongoing" role="tab" aria-controls="nav-ongoing" aria-selected="false">Today</a>
                    <a class="nav-item nav-link d-none" id="nav-upcoming-tab" data-toggle="tab" href="#nav-upcoming" role="tab" aria-controls="nav-upcoming" aria-selected="false">Upcoming</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-latest" role="tabpanel" aria-labelledby="nav-latest-tab">
                    <ul class="list-group list-group-flush">
                        @if(count($latest) > 0)
                            @foreach($latest as $key => $appointment)
                                @include('doctor.includes.appointment-list', $appointment)
                            @endforeach
                        @else
                            <li class="list-group-item">No Latest Appointments</li>
                        @endif
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-ongoing" role="tabpanel" aria-labelledby="nav-ongoing-tab">
                    <ul class="list-group list-group-flush">
                        @if(count($ongoing) > 0)
                            @foreach($ongoing as $key => $appointment)
                                @include('doctor.includes.appointment-list', $appointment)
                            @endforeach
                        @else
                            <li class="list-group-item">No Ongoing Appointments</li>
                        @endif
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-upcoming" role="tabpanel" aria-labelledby="nav-upcoming-tab">
                    <ul class="list-group list-group-flush">
                        @if(count($upcoming) > 0)
                            @foreach($upcoming as $key => $appointment)
                                @include('doctor.includes.appointment-list', $appointment)
                            @endforeach
                        @else
                            <li class="list-group-item">No Upcoming Appointments</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-8">
        <div class="customCalendar">
            <div id="calendar" data-url="{{ route('doctor.calendar-fetch') }}"></div>
        </div>
    </div>
</div>

@endsection
