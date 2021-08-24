@extends('layouts.doctor')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('doctor.users.index')}}">Users</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit User</h1>
</div>

@include('doctor.users.form', [
	'user' => $user,
])

@endsection
