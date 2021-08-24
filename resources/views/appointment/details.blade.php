@extends('layouts.appointment')

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
@endpush

@section('content')

<div class="row">
    <div class="col-12 col-lg-8 offset-lg-2">
        <div class="px-3 px-lg-0">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @error('attachments.*.file')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Some attached files exceeds the maximum upload limit of 5mb. Please try again.
                <button type="button" class="close" data-dism iss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row px-3 px-md-5 px-lg-1 mt-4">
    <div class="col-12 col-lg-4 offset-lg-2">
        <h2>Appointment Details</h2>
        <hr>
        <dl class="row">
            <dt class="col-sm-4">Reference #</dt>
            <dd class="col-sm-8">
                {{ $consultation->reference_no }}
            </dd>
            <dt class="col-sm-4">Name</dt>
            <dd class="col-sm-8">
                {{ $consultation->name }}
            </dd>
            <dt class="col-sm-4">Date</dt>
            <dd class="col-sm-8">
                @dateFormat($consultation->actual_datetime)
            </dd>
            <dt class="col-sm-4">Time</dt>
            <dd class="col-sm-8">
                @timeFormat($consultation->actual_datetime)
                <span>-</span>
                @timeFormat($consultation->actual_endtime)
            </dd>
            <dt class="col-sm-4">Mobile</dt>
            <dd class="col-sm-8">
                {{ $consultation->mobile }}
            </dd>
            <dt class="col-sm-4">Email</dt>
            <dd class="col-sm-8">
                {{ $consultation->email }}
            </dd>
            <dt class="col-sm-4">Age</dt>
            <dd class="col-sm-8">
                {{ $consultation->age_formatted }}
            </dd>
            <dt class="col-sm-4">Gender</dt>
            <dd class="col-sm-8">
                {{ ucwords(optional($consultation->patient)->gender) }}
            </dd>
            <dt class="col-sm-4">House Number</dt>
            <dd class="col-sm-8">
                {{ $consultation->patient->house_number }}
            </dd>
            <dt class="col-sm-4">Street</dt>
            <dd class="col-sm-8">
                {{ $consultation->patient->street }}
            </dd>
            <dt class="col-sm-4">Barangay</dt>
            <dd class="col-sm-8">
                {{ $consultation->patient->address ? \App\Barangay::where('id', $consultation->patient->address->barangay)->first()->name : 'n/a' }}
            </dd>
            <dt class="col-sm-4">City, Province</dt>
            <dd class="col-sm-8">
                {{ $consultation->patient->address ? \App\City::where('city_id', $consultation->patient->address->city)->first()->name .', '. \App\Province::where('province_id', $consultation->patient->address->province)->first()->name : 'n/a' }}
            </dd>
            <dt class="col-sm-4">Type of Consultation</dt>
            <dd class="col-sm-8">
                {{ $consultation->type_display }}
            </dd>
            <dt class="col-sm-4">Fee</dt>
            <dd class="col-sm-8">
                @money($consultation->consultation_fee)
                @if(!$consultation->payment_required)
                <span class="text-danger">
                    (No payment required)
                </span>
                @endif
            </dd>
            @if($consultation->isOnline())
            <dt class="col-sm-4">Teleconference Link</dt>
            <dd class="col-sm-8">
                @if($consultation->join_url)
                <a href="{{ $consultation->join_url }}">{{ $consultation->join_url }}</a>
                @else
                xxxxxxxxxx
                @endif
            </dd>
            @endif
            <dt class="col-sm-4">Complaint</dt>
            <dd class="col-sm-8">
                {!! $consultation->complaint !!}
            </dd>
            <dt class="col-sm-4">Name of Doctor</dt>
            <dd class="col-sm-8">
                {!! $consultation->doctor->name !!}
            </dd>
            <dt class="col-sm-4">Specializations</dt>
            <dd class="col-sm-8" style="margin-left: -20px">
                <ul>
                    @foreach ($consultation->doctor->specializations as $specialization)
                    <li>{{ $specialization->name }}</li>
                    @endforeach
                </ul>
            </dd>
            @if(count((array)$consultation->custom_fields) > 0)
            @foreach($consultation->custom_fields as $field)
            <dt class="col-sm-3">{{ $field['question'] }}</dt>
            <dd class="col-sm-9">
                {{ $field['type'] == 'radio' || $field['type'] == 'checkbox' ? (isset($field['arr_answer']) ? (is_array($field['arr_answer']) ? implode(', ', $field['arr_answer']) : $field['arr_answer']) : 'n/a') : $field['answer'] }}
            </dd>
            @endforeach
            @endif
        </dl>
        <h5 class="border-top pt-3">Attached Files</h5>
        <div class="list-group attachedFiles">
            @forelse($consultation->getMedia('patient') as $media)
            <div class="list-group-item flex-column">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h5 class="mb-1">
                        {{$media->name}}<br />
                        <small class="d-block">Size: {{ $media->human_readable_size }}</small>
                        <small class="d-block">Date & Time Uploaded: @dateTimeFormat($media->created_at)</small>
                    </h5>
                    <div class="buttons" style="flex-shrink:0">
                        @if(strpos($media->mime_type, 'image') !== false)
                        <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" data-rel="lightcase" title="{{$media->name}}"><i class="fas fa-eye"></i></a>
                        @else
                        <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ $media->getUrl() }}" class="btn btn-success btn-sm" download><i class="fas fa-download"></i></a>
                        @include('admin.inline-delete', [
                        'action' => route('appointment.media.remove', [$consultation, $media]),
                        ])
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item">
                <h5 class="mb-0">No uploaded files.</h5>
            </div>
            @endforelse
        </div>
        <h5 class="border-top pt-3 mt-3">Doctor file(s)</h5>
        <div class="list-group attachedFiles">
            @forelse($consultation->getMedia('doctor') as $media)
            <div class="list-group-item flex-column">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h5 class="mb-1">
                        {{$media->name}}<br />
                        <small class="d-block">Size: {{ $media->human_readable_size }}</small>
                        <small class="d-block">Date & Time Uploaded: @dateTimeFormat($media->created_at)</small>
                    </h5>
                    <div class="buttons" style="flex-shrink:0">
                        @if(strpos($media->mime_type, 'image') !== false)
                        <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" data-rel="lightcase" title="{{$media->name}}"><i class="fas fa-eye"></i></a>
                        @else
                        <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ $media->getUrl() }}" class="btn btn-success btn-sm" download><i class="fas fa-download"></i></a>
                        @include('admin.inline-delete', [
                        'action' => route('doctor.appointments.media.remove', [$consultation, $media]),
                        ])
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item">
                <h5 class="mb-0">No uploaded files.</h5>
            </div>
            @endforelse
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <form action="{{ route('appointment.update', $consultation) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="complaint"><b>Chief Complaint</b></label>
                <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="6" id="complaint">Please download Chief Complaint and Medical History forms and upload completed forms prior to you appointment</textarea>
                @error('complaint')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <div class="multiFiles">
                <h5 class="title" style="margin-right: 100px; font-size: 17px">Upload Deposit Slip, Medical History, Chief Complaint Forms and other files here: </h5>
                <a href="javascript:void(0);" class="btn btn-primary btn-addFile" style="margin-top: 15px">Add File</a>
                <div class="row fileRow">
                    <div class="col-12 col-sm pr-sm-0 mb-2 mb-sm-0">
                        <label>Attach File</label>
                        <input name="attachments[0][file]" type="file" class="form-control-file">
                    </div>
                    <div class="col col-sm pr-0">
                        <label>Title</label>
                        <input type="text" name="attachments[0][title]" class="form-control">
                    </div>
                    <div class="col-auto">
                        <a href="javascript:void(0);" class="btn btn-danger btn-removeFile" style="margin-top: 30px"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary mt-3">Update</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://kit.fontawesome.com/0faf1a2a97.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    $(".confirmDelete").click(function(e) {
        var msg = $(this).data('confirm') || 'Are you sure?';
        var msgText = $(this).data('confirm-text') || '';
        e.preventDefault();
        var _self = $(this);
        Swal.fire({
            title: msg
            , text: msgText
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#DD6B55'
            , cancelButtonColor: '#828384'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                _self.closest("form").submit();
                _self.prop('disabled', true);
                setTimeout(function() {
                    _self.prop('disabled', false);
                }, 2000);
            }
        })
    });
    // FilePond.setOptions({
    //     // maximum allowed file size
    //     maxFileSize: '5MB',
    //     // upload to this server end point
    //     server: 'upload',
    //     process:(fieldName, file, metadata, load, error, progress, abort) => {
    //     	request.setRequestHeader('X-CSRF-TOKEN' , $('meta[name="csrf-token"]').attr('content'));
    //     },
    //     headers: {
    //       'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     }
    // });
    // var pond = FilePond.create(document.querySelector('input[type="file"]'));

</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css" integrity="sha256-+bytSlt6ZKCfCCfKimCjD4CsDW9a0GpM85ZCOBDiLVI=" crossorigin="anonymous" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js" integrity="sha256-o/dXp1WxjpjU37PeBC5vxfc1yf/CgTCjWIzYUozOQ4Q=" crossorigin="anonymous"></script>
<script src="{{ asset('js/multifield.js') }}"></script>
<script>
    $('.multiFiles').multifield({
        section: '.fileRow'
        , btnAdd: '.btn-addFile'
        , btnRemove: '.btn-removeFile'
    });
    jQuery(document).ready(function($) {
        $('a[data-rel^=lightcase]').lightcase();
    });

</script>
@endpush
