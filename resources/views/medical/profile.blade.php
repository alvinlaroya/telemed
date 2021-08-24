@extends('layouts.medical')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('medical.doctors')}}">Doctors</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit profile of {{ $doctor->name }}</li>
@endpush

@section('content')

<div class="page-header">
    <h1 class="h2">Edit profile of {{ $doctor->name }}</h1>
</div>

@include('medical.forms.profile', [
    'doctor' => $doctor,
])

@endsection
