@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h2>Custom Fields Form - Doctors</h2>
    </div>

    @include('form-notification', [
        'customHeading' => 'Thank you!'
    ])

    <div class="row">
        <div class="col-12">
            <form action="{{ route('doctorsFormDynamic.save') }}" method="POST" class="needs-validation" novalidate>
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
                <div class="form-group">
                    <label for="mobile">Complaint</label>
                    <textarea name="complaint" id="complaint" class="form-control" rows="5" required></textarea>
                    <div class="invalid-feedback">Complaint is required</div>
                </div>
                <hr>
                <h4 class="mb-3">Additional Information</h4>
                <div class="row">
                    @foreach($customFields as $fields)
                        <div class="col-12 mb-3">
                            @if($fields->type == 'field')
                                <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                                <input type="text" name="fields[{{ $fields->id }}][answer]" class="form-control" id="field_{{ $fields->id }}" {{ $fields->required ? 'required' : '' }}>
                                <input type="hidden" name="fields[{{ $fields->id }}][type]" value="{{ $fields->type }}">
                                <input type="hidden" name="fields[{{ $fields->id }}][question]" value="{{ $fields->question }}">
                                @if($fields->required)
                                    <div class="invalid-feedback">This field cannot be empty.</div>
                                @endif
                            @endif

                            @if($fields->type == 'text')
                                <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                                <textarea name="fields[{{ $fields->id }}][answer]" class="form-control" id="field_{{ $fields->id }}" rows="3" {{ $fields->required ? 'required' : '' }}></textarea>
                                <input type="hidden" name="fields[{{ $fields->id }}][type]" value="{{ $fields->type }}">
                                <input type="hidden" name="fields[{{ $fields->id }}][question]" value="{{ $fields->question }}">
                                @if($fields->required)
                                    <div class="invalid-feedback">This field cannot be empty.</div>
                                @endif
                            @endif

                            @if($fields->type == 'radio')
                                <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                                <input type="hidden" name="fields[{{ $fields->id }}][type]" value="{{ $fields->type }}">
                                <input type="hidden" name="fields[{{ $fields->id }}][question]" value="{{ $fields->question }}">
                                @foreach($fields->options as $innerKey => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fields[{{ $fields->id }}][arr_answer]" id="fieldoption_{{ $fields->id . '-' . $innerKey }}" value="{{ $option }}" {{ $fields->required ? 'required' : '' }}>
                                        <label class="form-check-label" for="fieldoption_{{ $fields->id . '-' . $innerKey }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                                @if($fields->required)
                                    <div class="invalid-feedback">This field cannot be empty.</div>
                                @endif
                            @endif

                            @if($fields->type == 'checkbox')
                                <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                                <input type="hidden" name="fields[{{ $fields->id }}][type]" value="{{ $fields->type }}">
                                <input type="hidden" name="fields[{{ $fields->id }}][question]" value="{{ $fields->question }}">
                                @foreach($fields->options as $innerKey => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fields[{{ $fields->id }}][arr_answer][]" id="fieldoption_{{ $fields->id . '-' . $innerKey }}" value="{{ $option }}">
                                        <label class="form-check-label" for="fieldoption_{{ $fields->id . '-' . $innerKey }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                                @if($fields->required)
                                    <div class="invalid-feedback">This field cannot be empty.</div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>

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