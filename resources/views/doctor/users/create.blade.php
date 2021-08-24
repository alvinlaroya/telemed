@extends('layouts.doctor')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('doctor.users.index')}}">Users</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Add User</h1>
</div>

@include('doctor.users.form', [
	'user' => new App\User,
])

@endsection
