@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Settings</h1>
</div>

@include('admin.settings.form', [
	'settings' => $settings,
])

@endsection
