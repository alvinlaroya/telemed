@extends('layouts.admin')

@push('custom-styles')
	<style>
		.vh100 { height: 60vh; }
		.pointer { cursor: pointer; }
	</style>
@endpush

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.doctors.index')}}">Doctors</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Bulk Upload Data</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Bulk Upload Data</h1>
</div>

@if(session()->has('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session()->get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif

@if($errors->any())
	<div class="alert alert-warning text-center">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="d-flex justify-content-center align-items-center vh100">
	<form action="{{ route('admin.doctors.bulk-data.import') }}" method="post" enctype="multipart/form-data" id="formUpload">
		{{ csrf_field() }}

		<div class="mb-3">
			<input type="file" class="pointer" name="excel" accept=".xlsx">
		</div>

		<button class="btn btn-primary btn-block">
			<span class="fas fa-file-upload"></span> Upload
		</button>
	</form>
</div>

@endsection

@push('scripts')
	<script>
		$(function() {
			$(document).on('submit', '#formUpload', function(){
				$(this).find('button').prop('disabled', true)
			})
		})
	</script>
@endpush