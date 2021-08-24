@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h2>Custom Fields Form - Service</h2>
    </div>

    @include('form-notification', [
        'customHeading' => 'Thank you!'
    ])

    <div class="row">
        <div class="col-12">
            <form action="{{ route('serviceFormDynamic.save') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="doctor_id" value="1">
                <input type="hidden" name="date_time" value="{{ $currDate->toDatetimeString() }}">
                <h4 class="mb-3">Information</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">Last name is required.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">First name is required.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middleName">Middle Name</label>
                        <input type="text" name="middlename" class="form-control" id="middleName" placeholder="" value="" required>
                        <div class="invalid-feedback">Middle name is required.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="" value="" required>
                        <div class="invalid-feedback">Valid mobile number is required.</div>
                    </div>
                </div>
                <hr>
                <h4 class="mb-3">Additional Information</h4>
                @foreach($centers as $center)
                    <h5 class="border-bottom mb-2">{{ $center->name }}</h5>
                    <input type="hidden" name="answers[{{ $center->id }}][center_id]" 
                        value="{{ $center->id }}">
                    <input type="hidden" name="answers[{{ $center->id }}][center_name]" 
                        value="{{ $center->name }}">
                    <div class="row">
                        @foreach($center->customFields as $field)
                            <div class="col-12 mb-3">
                                <x-custom-field :field="$field" :center="$center" />
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-12">
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection