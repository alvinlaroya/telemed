@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Custom Forms</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Custom Forms ({{$center->name}})</h1>
</div>

<dynamic-forms
    :existing-items="{{ $questions->toJson() }}"
    url="{{route('center.custom-fields.save', $center)}}"
    saving-type="service"></dynamic-forms>

@endsection
