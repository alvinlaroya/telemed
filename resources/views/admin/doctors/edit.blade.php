@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.doctors.index')}}">Doctors</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $doctor->first_name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit Doctor</h1>
</div>

@include('admin.doctors.form', [
    'doctor' => $doctor,
    'new' => false
])

@endsection
