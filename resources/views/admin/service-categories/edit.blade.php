@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.index')}}">Centers</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $serviceCategory->name }}</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Edit Center</h1>
</div>

@include('admin.service-categories.form', [
    'serviceCategory' => $serviceCategory,
    'parents' => $parents
])

@endsection
