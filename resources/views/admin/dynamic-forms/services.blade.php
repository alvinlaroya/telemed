@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.index')}}">Centers</a>
	</li>
	<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.edit', $center)}}">{{ $center->name }}</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Forms</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">{{ $center->name }} <small class="text-muted">Service Form</small></h1>
</div>

<dynamic-forms
    :existing-items="{{ $questions->toJson() }}"
    url="{{route('admin.center.custom-fields.save', $center)}}"
    saving-type="service"></dynamic-forms>

@endsection
