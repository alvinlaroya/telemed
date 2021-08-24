@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Schedules</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Schedules</h1>
</div>

<week-schedule :leaves="{{$leaves->toJson()}}" :doctor="{{auth()->user()->doctor}}"></week-schedule>	

<div class="mb-5"></div>

@endsection