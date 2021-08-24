@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('admin.doctors.index')}}">Doctors</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.doctors.secretaries.index', $doctor)}}">{{ $doctor->name }}'s Secretaries</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Add Secretary</h1>
</div>

@include('admin.doctors.secretaries.form', [
	'secretary' => new App\User,
])

@endsection
