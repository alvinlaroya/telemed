<form action="{{ route('doctor.update-profile', array('doctor' => $doctor, 'type' => $type)) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        @if($type == 'edit')
            @if($doctor->picture)
                <div class="col-12">
                    <div class="image-preview"><img src="{{ $doctor->picture }}" /></div>
                </div>
            @endif
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="hidden" name="inputPicture" id="inputPicture" value="">
                    <input type="file" name="choosePicture" id="choosePicture" class="d-none" accept="image/*">
                    <div class="buttons">
                        <a href="javascript:void(0);" class="btn btn-primary btn-icon-split mr-2" onclick="choosefile()">
                            <span class="icon text-white-50"><i class="fas fa-upload"></i></span>
                            <span class="text ml-2">Upload</span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#cameraModal">
                            <span class="icon text-white-50"><i class="fas fa-camera"></i></span>
                            <span class="text ml-2">Camera</span>
                        </a>
                    </div>
                    @error('choosePicture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    id="firstName" value="{{ old('first_name', $doctor->first_name) }}">
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="lastName" value="{{ old('last_name', $doctor->last_name) }}">
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-2">
                <div class="form-group">
                    <label for="suffix">Suffix</label>
                    <input type="text" name="suffix" class="form-control @error('suffix') is-invalid @enderror" id="suffix" value="{{ old('suffix', $doctor->suffix) }}">
                    @error('suffix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label>Gender</label>
                    <div class="row @error('gender') is-invalid @enderror">
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="radio" name="gender" class="form-check-input" id="male" value="male" {{ old('gender', $doctor->gender) == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">
                                Male
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="radio" name="gender" class="form-check-input" id="female" value="female" {{ old('gender', $doctor->gender) == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">
                                Female
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control phone @error('mobile') is-invalid @enderror" id="mobile" value="{{ old('mobile', $doctor->mobile) }}">
                    @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" id="telephone" value="{{ old('telephone', $doctor->telephone) }}">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 d-none">
                <div class="form-group">
                    <label for="email">Login Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $doctor->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Email and Password Old Location -->
            <div class="col-12">
                <div class="form-group">
                    <label for="description">About Me</label>
                    <textarea name="description" id="description" class="form-control wysiwyg" rows="3">{{ old('description', $doctor->description) }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="specializationDropdown">Specializations</label>
                            <select name="specializations[]" class="form-control @error('specializations') is-invalid @enderror" id="specializationDropdown" data-action="{{ route('doctor.specializations.index') }}" data-value="{{ old('specializations') ? implode(',', old('specializations')) : $doctor->specializations()->pluck('specializations.id')->implode(',') }}">
                            </select>
                            @error('specializations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="accreditationDropdown">HMO Accreditation(s)</label>
                            <select name="hmos[]" class="form-control @error('hmos') is-invalid @enderror" id="accreditationDropdown" data-action="{{ route('doctor.hmo-accreditations.index') }}" data-value="{{ old('hmos') ? implode(',', old('hmos')) : $doctor->hmos()->pluck('hmo_accreditations.id')->implode(',') }}">
                            </select>
                            @error('hmos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md">
                <div class="form-group">
                    <label>Clinic Days</label>
                    <div class="row @error('clinic_days') is-invalid @enderror">
                        @php
                            $clinicDays = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
                        @endphp
                        @foreach($clinicDays as $key => $day)
                            <div class="col-auto">
                                <div class="form-check">
                                <input type="checkbox" name="clinic_days[]" class="form-check-input" id="{{ $day }}" value="{{ $key }}" {{ old('clinic_days', $doctor->clinic_days) && in_array($key, old('clinic_days', $doctor->clinic_days)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $day }}">
                                        {{ $day }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('clinic_days')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>City Address</label>
                        <?php
                            $cityIds = Arr::flatten(auth()->user()->doctor->addresses()->get('city')->toArray());
                        ?>
                        <div id="cityList">

                            <select class="selectizable city" name="cities[]" required multiple>
                                <option></option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_id }}" {{ (isset(auth()->user()->address) && in_array($city->city_id, $cityIds)) ? ' selected' : '' }}>
                                        {{ $city->name }}, {{ $city->province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($type == 'settings')
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="email">Login Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $doctor->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="exampleInputPassword1">Change Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="zoom_key">Zoom Key</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">#</div>
                    </div>
                    <input type="text" name="zoom_key" min="0" step="0.01" class="form-control @error('zoom_key') is-invalid @enderror"
                    id="zoom_key" value="{{ old('zoom_key', $doctor->zoom_key) }}">
                    @error('zoom_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="zoom_secret">Zoom Secret</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">#</div>
                    </div>
                    <input type="text" name="zoom_secret" min="0" step="0.01" class="form-control @error('zoom_secret') is-invalid @enderror"
                    id="zoom_secret" value="{{ old('zoom_secret', $doctor->zoom_secret) }}">
                    @error('zoom_secret')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-3">
                <label for="consultation_fee">Price per Consultation</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="number" name="consultation_fee" min="0" step="0.01" class="form-control @error('consultation_fee') is-invalid @enderror"
                    id="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
                    @error('consultation_fee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label for="consultation_duration">Consultation Duration ( minutes )</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                    <input type="number" name="consultation_duration" min="0" class="form-control @error('consultation_duration') is-invalid @enderror"
                    id="consultation_duration" value="{{ old('consultation_duration', $doctor->consultation_duration) }}">
                    @error('consultation_duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group @error('email_to_receive_notifications') is-invalid @enderror">
                    <label for="email_to_receive_notifications">E-mail to Receive Notifications ( For multiple recipients put a comma in between e-mail addresses )</label>
                    <input type="text" name="email_to_receive_notifications" class="form-control @error('email_to_receive_notifications') is-invalid @enderror"
                    id="email_to_receive_notifications" value="{{ old('email_to_receive_notifications', $doctor->email_to_receive_notifications) }}" data-role="tagsinput" >
                    @error('email_to_receive_notifications')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group @error('mobile_to_receive_notifications') is-invalid @enderror">
                    <label for="mobile_to_receive_notifications">Mobile to Receive Notifications | <small style="color:#e3342f">Ex: 09123456789</small> | ( For multiple recipients put a comma in between mobile numbers )</label>
                    <input type="text" name="mobile_to_receive_notifications" class="form-control @error('mobile_to_receive_notifications') is-invalid @enderror"
                    id="mobile_to_receive_notifications" value="{{ old('mobile_to_receive_notifications', $doctor->mobile_to_receive_notifications) }}" data-role="tagsinput" >
                    @error('mobile_to_receive_notifications')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="payment_instructions">Payment Instructions</label>
                    <textarea name="payment_instructions" id="payment_instructions" class="form-control wysiwyg" rows="3">{{ old('payment_instructions', $doctor->payment_instructions) }}</textarea>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-auto pr-1">
            <button type="submit" class="btn btn-primary">
                {{ $doctor->exists ? 'Update' : 'Submit' }}
            </button>
        </div>
    </div>
</form>

@push('custom-styles')
<link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<div class="modal" id="cameraModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Take a picture</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="web-camera"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary camera" onclick="take_snapshot()"><i class="fas fa-camera mr-2"></i> Capture</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="cropModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Make a selection</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="cropimage" class="text-center" data-original-image="{{ asset('images/logo.png') }}">
                    <img id="imageprev" src="{{ asset('images/logo.png') }}" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Close</button>
                <button type="button" class="btn btnsmall btn-primary" id="rotateL" title="Rotate Left"><i class="fas fa-undo"></i></button>
                <button type="button" class="btn btnsmall btn-primary" id="rotateR" title="Rotate Right"><i class="fas fa-redo"></i></button>
                <button type="button" class="btn btnsmall btn-primary" id="scaleX" title="Flip Horizontal"><i class="fas fa-arrows-alt-h"></i></button>
                <button type="button" class="btn btnsmall btn-primary" id="scaleY" title="Flip Vertical"><i class="fas fa-arrows-alt-v"></i></button>
                <button type="button" class="btn btnsmall btn-primary" id="reset" title="Reset"><i class="fas fa-sync"></i></button>
                <button type="button" class="btn save btn-success" id="saveImage"><i class="fas fa-save mr-2"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/webcam.js') }}"></script>
<script src="{{ asset('js/cropper.js') }}"></script>
<script>
    var inputPicture = $('#inputPicture');
    var choosePicture = $('#choosePicture');
    var generatedObjectURL = '';
    Webcam.on( 'error', function(error) {
        var msg = error.toString();
        Swal.fire('Ooops', msg, 'error').then(() => {
            $("#cameraModal").modal('hide');
            $('.modal-backdrop').remove();
        });
    });
    function choosefile(){
        $('#choosePicture').click();
    }
    function configure(){
        Webcam.set({
            width: 640,
            height: 480,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach('#web-camera');
    }
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $("#cameraModal").modal('hide');
            $("#cropModal").modal({ backdrop: 'static' });
            $("#cropimage").html('<img id="imageprev" src="'+data_uri+'" />');;
            cropImage();
            //document.getElementById('cropimage').innerHTML = ;
        } );

        Webcam.reset();
    }
    $('#cameraModal').on('show.bs.modal', function () {
        configure();
    });
    $('#cameraModal').on('hide.bs.modal', function () {
        Webcam.reset();
        // $("#cropimage").html("");
        $("#cropimage").html('<img id="imageprev" src="'+$('#cropimage').data('original-image')+'" />');
    });
    $('#cropModal').on('hide.bs.modal', function () {
        $("#cropimage").html('<img id="imageprev" src="'+$('#cropimage').data('original-image')+'" />');
    });
    choosePicture.on('change', function(e){
        var image = $('#imageprev');
        var files = e.target.files;
        var done = function (url) {
            choosePicture.val('');
            image.attr('src', url);
            $("#cropModal").modal({ backdrop: 'static' });
            cropImage();
        };
        var reader;
        var file;
        if (files && files.length > 0) {
            file = files[0];
            generatedObjectURL = URL.createObjectURL(file);
            if (URL) {
                done(generatedObjectURL);
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    function cropImage() {
        var image = document.querySelector('#imageprev');
        var cropper = new Cropper(image, {
            // aspectRatio: 1/1,
            // minCropBoxWidth: 235,
            // minCropBoxHeight: 235,
            cropBoxResizable: true,
        });
        $("#scaleY").click(function(){
            var Yscale = cropper.imageData.scaleY;
            if(Yscale==1){ cropper.scaleY(-1); } else {cropper.scaleY(1);};
        });
        $("#scaleX").click( function(){
            var Xscale = cropper.imageData.scaleX;
            if(Xscale==1){ cropper.scaleX(-1); } else {cropper.scaleX(1);};
        });
        $("#rotateR").click(function(){ cropper.rotate(45); });
        $("#rotateL").click(function(){ cropper.rotate(-45); });
        $("#reset").click(function(){ cropper.reset(); });
        $("#saveImage").click(function(){
            var imagePreview = $('.image-preview');
            var canvas = null;
            canvas = cropper.getCroppedCanvas({ width: 235, height: 235 });
            if(canvas){
                var imageBlob = canvas.toDataURL();
                $("#cropModal").modal('hide');
                imagePreview.html('').addClass('loading');
                inputPicture.val('');
                imagePreview.html('<img src="'+imageBlob+'" />');
                inputPicture.val(imageBlob);
                setTimeout(function(){
                    imagePreview.removeClass('loading');
                }, 2000);
                if(generatedObjectURL){
                    URL.revokeObjectURL(generatedObjectURL);
                    generatedObjectURL = '';
                }
            }
        });
    }
    </script>
@endpush
