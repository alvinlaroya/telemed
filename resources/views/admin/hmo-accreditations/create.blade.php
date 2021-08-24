@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.hmo-accreditations.index')}}">HMO Accreditations</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Add HMO Accreditation</h1>
</div>

@include('admin.hmo-accreditations.form', [
	'hmoAccreditation' => new App\HmoAccreditation,
])

@endsection
