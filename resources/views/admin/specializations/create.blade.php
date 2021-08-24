@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.specializations.index')}}">Specializations</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Add Specialization</h1>
</div>

@include('admin.specializations.form', [
    'specialization' => new App\Specialization,
    'parents' => $parents,
])

@endsection
