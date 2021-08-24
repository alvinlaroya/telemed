@extends('layouts.home')

@section('content')
    @if (isset($settings) && $settings['maintenance'] == 1)
        <div class="alert alert-danger mt-5" role="alert">
            {{ $settings['notice'] }}
        </div>
    @else
        <div class="container pb-5">
            <div class="py-5 text-center">
                <h2>Appointment Scheduling</h2>
            </div>

            @include('form-notification')

            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">Booking Information</h3>
                    <h5> Already have an account? <a href="{{ route('login') }}">Login here</a></h5>
                    <hr />
                    <form action="{{ route('centerForms') }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control d-none" id="forCenterValidaiton" required>
                        {{-- <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ $patient_id}}"> --}}
                        <div class="row basicForms">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="centers" class="required">Centers</label>
                                        <select name="center" id="centers" class="custom-select d-block w-100"
                                            data-action="{{ route('getCenters') }}" required>
                                        </select>
                                        <div class="invalid-feedback">Please select a center.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-8 col-md-10 mb-3"> --}}
                                    <div class="col-12 mb-3">
                                        <label for="services" class="required">Services</label>
                                        <select name="services" id="services" class="custom-select d-block w-100"
                                            data-action="{{ route('getServices') }}" disabled required>
                                        </select>
                                        <div class="invalid-feedback">Please select a service.</div>
                                        <p id="notice" class="invalid-feedback" style="display:none;">Please add a service!
                                        </p>
                                    </div>
                                    {{-- <div class="col-4 col-md-2 mb-3">
                                <label for="btn-add">&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-md btn-block"
                                id="btn-add"
                                disabled
                                >ADD</button>
                            </div> --}}
                                </div>

                                <div class="row" id="multiNotes">
                                    <div class="col-12">
                                        <span class="multi-notes">Note: For multiple services simply select another center
                                            and
                                            service.</span>
                                    </div>
                                </div>

                                <div class="row" class="display-centerservice" id="displayCentersServices"></div>

                                {{-- <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="required">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">First name is required.</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName" class="required">Middle Name</label>
                                <input type="text" name="middlename" class="form-control" id="middleName" placeholder="" value="">
                                <div class="invalid-feedback">Middle name is required.</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="required">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">Last name is required.</div>
                            </div>
                        </div> --}}

                                {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="required">Province</label>
                                <select name="province"
                                    id="province"
                                    class="custom-select d-block w-100"
                                    data-action="{{ route('getProvinces') }}"
                                    required>
                                </select>
                                <div class="invalid-feedback">Please select a province.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="required">City</label>
                                <select name="city"
                                    id="city"
                                    class="custom-select d-block w-100"
                                    data-action="{{ route('getCities') }}"
                                    disabled
                                    required>
                                </select>
                                <div class="invalid-feedback">Please select a city.</div>
                            </div>
                        </div> --}}

                                {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="birthdate" class="required">Date of Birth</label>
                                <div class="d-flex">
                                    <select class="custom-select" name="birthdate_month" required>
                                        <option value="">Month</option>
                                        @foreach (\App\Date::$months as $key => $month)
                                        <option value="{{$key}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                    <select class="custom-select" name="birthdate_day" required>
                                        <option value="">Day</option>
                                        @foreach (range(1, 31) as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>
                                    <?php
//$currYear = date("Y")
?>
                                    <select class="custom-select" name="birthdate_year" required>
                                        <option value="">Year</option>
                                        @foreach (range($currYear, $currYear - 115) as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="required">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                        </div> --}}

                                {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="required">Mobile</label>
                                <input type="text" name="mobile" class="form-control phone" id="mobile" placeholder="" value="" required>
                                <div class="invalid-feedback">Valid mobile number is required.</div>
                            </div>
                        </div> --}}
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="modeOfPayment" class="required">Mode of Payment</label>
                                        <select name="modeOfPayment" id="modeOfPayment" class="custom-select d-block w-100"
                                            required>
                                            <option value="">Select mode of payment</option>
                                            @foreach (config('telemed.mode_of_payment') as $key => $mode)
                                                <option value="{{ $key }}">{{ $mode }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Select mode of payment.</div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="mopHolder" style="display: none;">
                                        <label for="mopOther" class="required" id="mopTitle"></label>
                                        <input type="mopOther" name="mopOther" class="form-control" id="mopOther">
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="hmoHolder" style="display: none;">
                                        <label for="mopHMO" class="required">HMO Accreditation</label>
                                        <select name="mopOther" id="mopHMO" class="custom-select d-block w-100">
                                            <option value="">-- Please choose --</option>
                                            @forelse($hmos as $hmo)
                                                <option value="{{ $hmo->name }}">{{ $hmo->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="corpHolder" style="display: none;">
                                        <label for="mopCorp" class="required">Corporate Accounts</label>
                                        <select name="mopOther" id="mopCorp" class="custom-select d-block w-100">
                                            <option value="">-- Please choose --</option>
                                            @forelse($corporateAccounts as $corporateAccount)
                                                <option value="{{ $corporateAccount->name }}">
                                                    {{ $corporateAccount->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <hr />
                                        <div class="multiFiles">
                                            <h3 class="title">Attach doctor's request</h3>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-addFile">Add File</a>
                                            <div class="row fileRow">
                                                <div class="col-12 col-sm pr-sm-0 mb-2 mb-sm-0">
                                                    <label>Attach File</label>
                                                    <input name="attachments[0][file]" type="file"
                                                        class="form-control-file">
                                                </div>
                                                <div class="col col-sm pr-0">
                                                    <label>Title</label>
                                                    <input type="text" name="attachments[0][title]" class="form-control">
                                                </div>
                                                <div class="col-auto">
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-removeFile"
                                                        style="margin-top: 30px"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div> --}}

                                {{-- <div class="row">
                            <div class="col-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="seniorPWD" class="custom-control-input" id="seniorPWD">
                                    <label class="custom-control-label" for="seniorPWD">Are you a Senior Citizen or PWD?</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 displayIDNo">
                                <label for="idNumber" class="required">ID Number</label><span class="note">NOTE: NUMBER WILL BE VALIDATED ONCE YOU AVAIL THE SERVICE</span>
                                <input type="text" name="idNumber" class="form-control" id="idNumber" placeholder="ID Number" value="">
                                <div class="invalid-feedback">ID Number is required.</div>
                            </div>
                        </div> --}}
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="mb-4">
                            <div class="button-wrapper">
                                <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                                <button class="btn btn-primary" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>We will send available time for your confirmation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/multifield.js') }}"></script>
    <script>
        $('.multiFiles').multifield({
            section: '.fileRow',
            btnAdd: '.btn-addFile',
            btnRemove: '.btn-removeFile'
        });
    </script>
@endpush
