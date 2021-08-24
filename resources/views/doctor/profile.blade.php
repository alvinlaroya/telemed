@extends('layouts.doctor')

@push('custom-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css">
	<style>
		body { display: none; }
        .text-ucwords { text-transform: none; }
	</style>
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{{ $type == 'edit' ? (auth()->user()->isSecretary() ? "Doctor's Profile" : "My Profile") : 'Settings' }}</li>
@endpush

@section('content')

<div class="page-header">
    <h1 class="h2">{{ $type == 'edit' ? (auth()->user()->isSecretary() ? "Doctor's Profile" : "My Profile") : 'Settings' }}</h1>
</div>

@include('doctor.forms.profile', [
    'doctor' => $doctor,
    'type' => $type
])

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    <script>
        $(function() {
            $('body').css('display', 'block')
            
            $('.selectizable').selectize({
                placeholder: 'Select City',
                closeAfterSelect: true
            })
        })
    </script>
@endpush
