@extends('layouts.patient')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.date.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.time.css') }}" rel="stylesheet">
@livewireStyles
@endpush
@push('custom-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css">
	<style>
		body { display: none; }
	</style>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">My Profile</h1>
</div>

@include('patient.forms.profile', [
    'patient' => $user,
    'type' => $type,
    'cities' => $cities,
    'provinces' => $provinces
])

@endsection