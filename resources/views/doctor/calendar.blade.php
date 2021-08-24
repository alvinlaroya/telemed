@extends('layouts.doctor')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Calendar</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Calendar</h1>
</div>

<div class="customCalendar">
    <div id="calendar" data-url="{{ route('doctor.calendar-fetch') }}"></div>
</div>

@endsection
