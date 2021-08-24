@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h2>Fall Risk Screening Form</h2>
        <p class="lead">Safety is our top priority.  We would like to know how we can we assist you more during your visit.</p>
    </div>
    <form class="fallriskScreeningForm" action="{{ route('bookingService') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h5 class="mb-3">In the past two weeks did the patient have any of the following</h5>
                <div class="question-1-3">
                    <ol>
                        @include('includes.screening.list-fallrisk')
                    </ol>
                </div>
                <div class="button-wrapper">
                    {{-- <button type="button" class="btn-s1 btn btn-primary">Next</button> --}}
                    {{-- <button type="button" class="btn-s2 btn btn-primary d-none">Next</button> --}}
                    <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </div>
            <div class="col-12">
                @include('includes/service-text-assistance')
            </div>
        </div>
    </form>

@endsection
