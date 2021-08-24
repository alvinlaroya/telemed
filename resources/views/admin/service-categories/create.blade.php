@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.index')}}">Centers</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Add Center or Unit</h1>
</div>

@include('admin.service-categories.form', [
    'serviceCategory' => new App\ServiceCategory,
    'parents' => $parents
])

@endsection
