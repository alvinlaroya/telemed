@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.users.index')}}">Users</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit User</h1>
</div>

@include('admin.users.form', [
	'user' => $user,
])

@endsection
