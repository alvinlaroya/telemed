@extends('layouts.doctor')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('doctor.appointments')}}">Appointments</a>
	</li>
	<li class="breadcrumb-item">
		<a href="{{route('doctor.appointments.show', $consultation)}}">{{ $consultation->reference_no }}</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit Appointment of {{ $consultation->name }}</h1>
</div>

@include('doctor.consultations.form', [
	'consultation' => $consultation,
])

@endsection
