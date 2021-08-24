@extends('layouts.medical')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('medical.doctors')}}">Doctors</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">
    	{{ $doctor->name }} - <small>Schedule</small>
    </li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">{{ $doctor->name }} <small class="muted">Schedule</small></h1>
</div>

<week-schedule 
	url="/medical-services/doctors/{{$doctor->id}}"
	:leaves="{{$leaves}}" 
	:doctor="{{$doctor}}"
	:types="{{json_encode($types)}}"
	type-selected="{{App\Schedule::WALKIN}}"
	></week-schedule>	

<div class="mb-5"></div>

@endsection