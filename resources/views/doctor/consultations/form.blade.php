<form action="{{ route('doctor.appointments.edit-save', $consultation) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                id="first_name" value="{{ old('first_name', $consultation->first_name) }}">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                id="middle_name" value="{{ old('middle_name', $consultation->middle_name) }}">
                @error('middle_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                id="last_name" value="{{ old('last_name', $consultation->last_name) }}">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                id="email" value="{{ old('email', $consultation->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                id="mobile" value="{{ old('mobile', $consultation->mobile) }}">
                @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="birthdate" class="required">Date of Birth</label>
            <input type="text" name="birthdate" id="birthdate"
                class="form-control date-pick readonly" value="{{ date('m/d/Y', strtotime($consultation->patient->birthdate)) }}" autocomplete="off"
                style="background:white; cursor:pointer;" required>
            <div class="invalid-feedback">Date of birth is required.</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="province" class="required">Province</label>
            <select name="province"
                id="province"
                class="custom-select d-block w-100"
                data-action="{{ route('getProvinces') }}"
                data-value="{{ $consultation->patient->province_id }}"
                required>
            </select>
            <div class="invalid-feedback">Please select a city.</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="city" class="required">City</label>
            <select name="city"
                id="city"
                class="custom-select d-block w-100"
                data-action="{{ route('getCities') }}"
                data-value="{{ $consultation->patient->city_id }}"
                required>
            </select>
            <div class="invalid-feedback">Please select a city.</div>
        </div>
        <div class="col-12 col-md-6">
            <label class="required">Gender</label>
            <div class="row mb-3">
                <div class="col-auto">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="male" {{ $consultation->patient->gender == 'male' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="female" {{ $consultation->patient->gender == 'female' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="complaint">Complaint</label>
                <textarea name="complaint" id="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="5">{{ old('mocomplaintbile', $consultation->complaint) }}</textarea>
                @error('complaint')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            @if($customFields->count() > 0)
                <hr>
                <h4 class="mb-3">Additional Information</h4>
                <div class="row">
                    @foreach($customFields as $fields)
                    <div class="col-12 mb-3">
                        @if($fields->type == 'field')
                            <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                            <input type="text" name="fields[{{ $fields->id }}][answer]" class="form-control" value="{{ isset($consultation->custom_fields[$fields->id]) ? $consultation->custom_fields[$fields->id]['answer'] : '' }}" id="field_{{ $fields->id }}" {{ $fields->required ? 'required' : '' }}>
                            <input type="hidden" name="fields[{{ $fields->id }}][type]" value="{{ $fields->type }}">
                            <input type="hidden" name="fields[{{ $fields->id }}][question]" value="{{ $fields->question }}">
                            @if($fields->required)
                                <div class="invalid-feedback">This field cannot be empty.</div>
                            @endif
                        @endif

                        @if($fields->type == 'text')
                            <label for="field_{{ $fields->id }}"><h5>{{ $fields->question }}</h5></label>
                            <textarea name="fields[{{ $fields->id }}][answer]" class="form-control" id="field_{{ $fields->id }}" rows="3" {{ $fields->required ? 'required' : '' }}>{{ isset($consultation->custom_fields[$fields->id]) ? $consultation->custom_fields[$fields->id]['answer'] : '' }}</textarea>
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
                                    <input class="form-check-input" type="radio" name="fields[{{ $fields->id }}][arr_answer]" id="fieldoption_{{ $fields->id . '-' . $innerKey }}" value="{{ $option }}" {{ $fields->required ? 'required' : '' }} {{ isset($consultation->custom_fields[$fields->id]) && isset($consultation->custom_fields[$fields->id]['arr_answer']) && $consultation->custom_fields[$fields->id]['arr_answer'] == $option ? 'checked' : '' }}>
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
                                    <input class="form-check-input" type="checkbox" name="fields[{{ $fields->id }}][arr_answer][]" id="fieldoption_{{ $fields->id . '-' . $innerKey }}" value="{{ $option }}" {{ isset($consultation->custom_fields[$fields->id]) && isset($consultation->custom_fields[$fields->id]['arr_answer']) && in_array($option, $consultation->custom_fields[$fields->id]['arr_answer']) ? 'checked' : '' }}>
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
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        Update
    </button>
</form>

@push('custom-styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush
