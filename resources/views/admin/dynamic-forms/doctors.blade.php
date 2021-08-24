@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">Dynamic Forms</li>
    <li class="breadcrumb-item active" aria-current="page">Doctors Form</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Doctors Form</h1>
</div>

<dynamic-forms
    :existing-items="{{ $questions->toJson() }}"
    url="{{route('admin.form.add-question')}}"
    saving-type="doctor"></dynamic-forms>

@endsection
