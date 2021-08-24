@extends('layouts.doctor')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Schedule</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Schedule</h1>
</div>

<week-schedule 
	url="/doctor"
	:leaves="{{$leaves->toJson()}}" 
	:doctor="{{auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor}}"
	:types="{{json_encode($types)}}"
	></week-schedule>	

<div class="mb-5"></div>

@endsection