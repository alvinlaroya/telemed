@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h2>Book a Service</h2>
    </div>

    <div class="row ccf">
        <div class="col-12">
            <form action="{{ route('customFields') }}" method="POST" class="needs-validation" enctype="multipart/form-data"  >
                @csrf

                <h4 class="mb-3">Additional Information</h4>
                @foreach($centers as $center)
                    @if(isset($center->customFields) && $center->customFields->count() > 0)
                        <h5 class="mb-3">({{ $center->name }})</h5>
                        <input type="hidden" name="answers[{{ $center->id }}][center_id]"
                            value="{{ $center->id }}">
                        <input type="hidden" name="answers[{{ $center->id }}][center_name]"
                            value="{{ $center->name }}">
                        <div class="row mb-3">
                            @foreach($center->customFields as $field)
                                <div class="col-12 mb-3">
                                    <x-custom-field :field="$field" :center="$center" />
                                </div>
                            @endforeach
                        </div>
                        <hr class="mb-4">
                    @endif
                @endforeach

                <div class="button-wrapper">
                    <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>
            </form>
            @include('includes/service-text-assistance')
        </div>
    </div>

@endsection
