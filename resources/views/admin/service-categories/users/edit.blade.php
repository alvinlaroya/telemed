@extends('layouts.admin')

@push('breadcrumb')
<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.index')}}">Centers</a>
	</li>
	<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.users.index', $serviceCategory)}}">{{ $serviceCategory->name }} Administrators</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Edit Adminitrator {{ $user->name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit Adminitrator {{ $user->name }}</h1>
</div>

@include('admin.service-categories.users.form', [
	'user' => $user,
])

@endsection
