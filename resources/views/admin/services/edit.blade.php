@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.services.index')}}">Service</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit Service Category</h1>
</div>

@include('admin.services.form', [
	'service' => $service,
])

@endsection
