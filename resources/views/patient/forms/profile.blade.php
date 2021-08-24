<div class="row">
    <div class="col-12">
        <form id="patientForm" action="{{ route('patient.profile.update') }}" method="POST"
            class="needs-validation">
            @csrf
            {{-- <input type="hidden" name="doctor_id" id="doctorInput" value="{{ optional($doctor)->id }}"> --}}
            <input type="hidden" name="time" id="timeInput" value="">
            <input type="hidden" name="date" id="dateInput" value="">
            <input type="hidden" name="cityId" id="cityId" value="{{ $user->city_id }}">
            <input type="hidden" name="type" id="typeInput" value="{{ \App\Consultation::ONLINE }}">
{{--             <h4 class="mb-3 text-center">Patient Details</h4> --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="firstName" class="required">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">First name is required.</div>
                </div>
                <div class="col-md-4">
                    <label for="middleName">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $user->middle_name) }}" id="middleName" placeholder="" value="">
                    {{-- <div class="invalid-feedback">First name is required.</div> --}}
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lastName" class="required">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" id="lastName" placeholder="" value="" required>
                    <div class="invalid-feedback">Last name is required.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="email" class="required">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="email" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mobile" class="required">Mobile</label><br/>
                    <input type="text" name="mobile" class="form-control int-phone" value="{{ old('mobile', $user->mobile) }}" id="mobile" placeholder="" value="" required>
                    <div class="invalid-feedback">Valid mobile number is required.</div>
                    <span id="phone-valid-msg" class="valid-fb d-none">✓ Valid</span>
                    <span id="phone-error-msg" class="invalid-fb d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="birthdate">Date of Birth</label> <span style="color: red">*</span>
                    <div class="d-flex">
                        @if ($user->birthdate != null)     
                            <select class="custom-select" name="birthdate_month" required>
                                <option value="{{ date('M', strtotime($user->birthdate)) }}">{{ date('M', strtotime($user->birthdate)) }}</option>
                                @foreach(\App\Date::$months as $key => $month)
                                    <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                            <select class="custom-select" name="birthdate_day" required>
                                <option value="{{ date('d', strtotime($user->birthdate)) }}">{{ date('d', strtotime($user->birthdate)) }}</option>
                                @foreach(range(1, 31) as $day)
                                    <option value="{{$day}}">{{$day}}</option>
                                @endforeach
                            </select>
                            <?php $currYear = date("Y") ?>
                            <select class="custom-select" name="birthdate_year" required>
                                <option value="{{ date('Y', strtotime($user->birthdate)) }}">{{ date('Y', strtotime($user->birthdate)) }}</option>
                                @foreach(range($currYear, $currYear-115) as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>     
                        @else
                            
                            <select class="custom-select" name="birthdate_month" required>
                                <option value="">Month</option>
                                @foreach(\App\Date::$months as $key => $month)
                                <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                            <select class="custom-select" name="birthdate_day" required>
                                <option value="">Day</option>
                                @foreach(range(1, 31) as $day)
                                    <option value="{{$day}}">{{$day}}</option>
                                @endforeach
                            </select>
                            <?php $currYear = date("Y") ?>
                            <select class="custom-select" name="birthdate_year" required>
                                <option value="">Year</option>
                                @foreach(range($currYear, $currYear-115) as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="invalid-feedback">Date of birth is required.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="province">Province</label> <span style="color: red">*</span>
                    {{-- <select name="province"
                        id="province"
                        class="custom-select d-block w-100"
                        data-action="{{ route('getProvinces') }}"
                        data-value="{{ $user->province_id }}"
                    >
                    </select> --}}
                    <select name="province"
                        id="provinceJson"
                        class="custom-select d-block w-100 select2"
                        required
                    >
                        @foreach ($provinces as $province)
                            <option value="{{$province->province_id}}" {{ $province->province_id == $user->province_id ? 'selected' : ''}}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a province.</div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    @php
                        $defaultCity = \App\City::where('city_id', $user->city_id)->first();
                    @endphp
                    <label for="city">City</label> <span style="color: red">*</span>
                    <select name="city"
                        id="city"
                        class="custom-select d-block w-100 select2"
                        required
                    >
                        @if ($user->city_id)
                            <option value="{{ $user->city_id }}">{{ $defaultCity->name }}</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select a city.</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="houseNumber">House Number</label> <span style="color: red">*</span>
                    <input type="text" name="houseNumber" class="form-control" value="{{ old('house_number', $user->house_number) }}" id="houseNumber" placeholder="" value="" required>
                    <div class="invalid-feedback">House number is required.</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="street">Street</label> <span style="color: red">*</span>
                    <input type="text" name="street" class="form-control" value="{{ old('street', $user->street) }}" id="street" placeholder="" value="" required>
                    <div class="invalid-feedback">Street is required.</div>
                </div>
                {{-- <div class="col-md-3 mb-3">
                    <label for="barangay">Barangay</label> <span style="color: red">*</span>
                    <input type="text" name="barangay" class="form-control" value="{{ old('barangay', $user->barangay) }}" id="barangay" placeholder="" value="" required>
                    <div class="invalid-feedback">Barangay is required.</div>
                </div> --}}
                <div class="col-12 col-md-6 mb-3">
                    @php
                        $defaultBarangay = \App\Barangay::where('id', $user->barangay)->first();
                    @endphp
                    <label for="city">Barangay</label> <span style="color: red">*</span>
                    <select name="barangay"
                        id="barangay"
                        class="custom-select d-block w-100 select2"
                        required
                    >
                        @if ($user->address)
                            <option value="{{ $user->address->barangay }}">{{ $defaultBarangay->name }}</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select a city.</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode', $user->zipcode) }}" id="zipcode" placeholder="" value="">
                    <div class="invalid-feedback">Zipcode is required.</div>
                </div>
                <div class="col-12 col-md-6">
                    <label>Gender</label> <span style="color: red">*</span>
                    <div class="row mb-3">
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="male" name="gender" class="custom-control-input" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="male">Male</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="female" name="gender" class="custom-control-input" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <div class="text-center">
                <button class="btn btn-primary btn-lg" id="submitForm" type="submit">Submit</button>
                {{-- <button class="btn btn-light btn-lg ml-2" id="cancelPForm" type="button">Cancel</button> --}}
            </div>
            {{-- @include('terms-of-use') --}}

            <div class="modal fade" id="terms-of-use" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Terms of Use and Data Privac Policy</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ac turpis egestas sed tempus. Ut sem nulla pharetra diam sit amet nisl. Sollicitudin nibh sit amet commodo nulla facilisi. Adipiscing commodo elit at imperdiet dui accumsan. Purus non enim praesent elementum facilisis leo vel fringilla. Duis at consectetur lorem donec. Metus dictum at tempor commodo ullamcorper. Praesent semper feugiat nibh sed pulvinar proin gravida. Varius morbi enim nunc faucibus a pellentesque. Maecenas ultricies mi eget mauris pharetra et. Magna eget est lorem ipsum dolor sit. Mauris ultrices eros in cursus turpis massa.

                        Viverra tellus in hac habitasse platea dictumst vestibulum. Urna neque viverra justo nec ultrices dui sapien. Sem et tortor consequat id porta nibh venenatis. Ultricies lacus sed turpis tincidunt id aliquet risus. In tellus integer feugiat scelerisque varius. Convallis posuere morbi leo urna. Viverra vitae congue eu consequat ac felis donec et odio. Felis donec et odio pellentesque diam. Praesent semper feugiat nibh sed pulvinar. Nunc consequat interdum varius sit amet mattis vulputate enim nulla. Amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien.
                        
                        Amet consectetur adipiscing elit duis tristique sollicitudin nibh. Velit laoreet id donec ultrices tincidunt arcu non sodales. Nunc sed blandit libero volutpat sed cras ornare. Scelerisque viverra mauris in aliquam sem. Posuere morbi leo urna molestie at elementum eu facilisis. Sem viverra aliquet eget sit amet tellus. Condimentum vitae sapien pellentesque habitant morbi tristique senectus. Auctor eu augue ut lectus arcu bibendum. Sagittis orci a scelerisque purus semper eget duis. Quam quisque id diam vel quam elementum pulvinar etiam non. Elit duis tristique sollicitudin nibh sit. Neque gravida in fermentum et sollicitudin ac orci.
                        
                        Maecenas accumsan lacus vel facilisis volutpat est. Volutpat consequat mauris nunc congue. Porta non pulvinar neque laoreet suspendisse. Sollicitudin ac orci phasellus egestas tellus rutrum tellus pellentesque. Id diam vel quam elementum pulvinar etiam non quam lacus. Odio eu feugiat pretium nibh ipsum consequat nisl vel. Sed faucibus turpis in eu. Ut morbi tincidunt augue interdum velit euismod in. Ac odio tempor orci dapibus ultrices in iaculis nunc. Id eu nisl nunc mi ipsum. Gravida in fermentum et sollicitudin. Nam aliquam sem et tortor consequat id porta. Dui ut ornare lectus sit amet est placerat in. Enim sit amet venenatis urna cursus eget. Massa tempor nec feugiat nisl. Adipiscing vitae proin sagittis nisl. Ut diam quam nulla porttitor massa. Tincidunt augue interdum velit euismod in pellentesque.
                        
                        Scelerisque in dictum non consectetur a erat nam at lectus. Vitae semper quis lectus nulla at volutpat diam ut. Adipiscing elit pellentesque habitant morbi tristique senectus et netus et. Et pharetra pharetra massa massa. Sagittis purus sit amet volutpat consequat mauris nunc congue nisi. Tellus rutrum tellus pellentesque eu tincidunt. Est placerat in egestas erat. Malesuada fames ac turpis egestas maecenas. Leo vel fringilla est ullamcorper eget. Sed id semper risus in.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(".readonly").on('keydown paste', function(e){
    e.preventDefault();
});



$(document).ready(function() {
    $('.select2').select2();   
});


$(function() {

    var patientCity = $('#cityId').val()


    $(document).on('change', '#provinceJson', function(){
        $('#city').prop('disabled', true)

        $.ajax({
            url: '/api/address/cities/' + $(this).val().trim(),
            method: 'get',
            dataType: 'json',
            success: function(cities) {
                console.log(cities)
                let selectData = '<option></option>'

                for(let cityCount = 0; cityCount < cities.length; cityCount++) {
                    selectData += `
                        <option value=" ${cities[cityCount].city_id }">${ cities[cityCount].name }</option>
                    `
                }

                $('#city').html(selectData)
                $('#city').removeAttr('disabled')
            },
            error: function(response) {}
        })
    })

    $(document).on('change', '#city', function(){
        $('#barangay').prop('disabled', true)

        $.ajax({
            url: '/api/address/barangays/' + $(this).val().trim(),
            method: 'get',
            dataType: 'json',
            success: function(barangay) {
                console.log(barangay)
                let selectData = '<option></option>'

                for(let barangayCount = 0; barangayCount < barangay.length; barangayCount++) {
                    selectData += `
                        <option value=" ${barangay[barangayCount].id }">${ barangay[barangayCount].name }</option>
                    `
                }

                $('#barangay').html(selectData)
                $('#barangay').removeAttr('disabled')
            },
            error: function(response) {}
        })
    })

})



// https://github.com/amsul/pickadate.js/issues/424
// $(function() {
//     $('.birthpicker').pickadate({
//       selectYears: true,
//       selectMonths: true,
//       min: new Date(1988,3,20),
//       max: true
//     })
// })
</script>
@endpush

