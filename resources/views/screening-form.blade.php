@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h2>Patient Screening Form</h2>
        <p class="lead">Patients who cannot be seen immediately in the clinic should be assessed by phone or by teleconsultation.</p>
    </div>
    <form class="serviceScreeningForm" action="{{ route('booking-fallrisk-screening') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h5 class="mb-3">In the past two weeks did the patient have any of the following</h5>
                <div class="question-1-3">
                    <ol>
                        @include('includes.screening.list-service')
                    </ol>
                </div>
                <div class="button-wrapper">
                    <input type="hidden" id="emergencyLink" value={{ route('emergencyNotice') }}>
                    <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                    <button type="button" class="btn-s1 btn btn-primary">Next</button>
                    <button type="button" class="btn-s2 btn btn-primary d-none">Submit</button>
                    <button type="submit" class="btn-submit btn btn-primary d-none">Next</button>
                </div>
            </div>
            <div class="col-12">
                @include('includes/service-text-assistance')
            </div>
        </div>
    </form>

@endsection
