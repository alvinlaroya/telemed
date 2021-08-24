@extends('layouts.patient')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('doctor.appointments')}}">Appointments</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Details</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">
		Appointment Details
		<span class="badge badge-secondary {{ $consultation->status }}">
			@if($consultation->status == "approved")
                Requested
            @else
                {{ ucwords($consultation->status) }}
            @endif
		</span>
		@if($consultation->paid)
		<span class="badge badge-success paid">
			Paid
		</span>
		@endif
	</h1>
</div>

<div class="row mb-5">
	<div class="col-12 col-md-6">
		<dl class="row">
			<dt class="col-sm-4">Reference no.</dt>
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
			    @if(!$consultation->isPending() && !$consultation->isCompleted())
			    <a href="#" data-toggle="modal" data-target="#reschedModal"
			    	class="ml-3 text-danger border-bottom font-italic">
					Reschedule
				</a>
				@endif
			</dd>
			<dt class="col-sm-4">Time</dt>
			<dd class="col-sm-8">
				@timeFormat($consultation->actual_datetime)
				<span>-</span>
				@timeFormat($consultation->actual_endtime)
            </dd>
			<dt class="col-sm-4">Type of Consultation</dt>
			<dd class="col-sm-8">
			    {{ $consultation->type_display }}
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
			<dt class="col-sm-4">Complaint</dt>
			<dd class="col-sm-8">
			    {{ $consultation->complaint }}
			</dd>
			<dt class="col-sm-4">Duration</dt>
			<dd class="col-sm-8">
			    {{ $consultation->duration }} mins
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
			<dt class="col-sm-4">City</dt>
            <dd class="col-sm-8">
                {{ optional($consultation->patient->city)->name ?? 'n/a' }}
            </dd>
            <dt class="col-sm-4">House Number</dt>
			<dd class="col-sm-8">
			    {{ $consultation->patient->house_number != null ? $consultation->patient->house_number : 'n/a' }}
            </dd>
            <dt class="col-sm-4">Street</dt>
			<dd class="col-sm-8">
			    {{ $consultation->patient->street != null ? $consultation->patient->street : 'n/a'}}
            </dd>
            <dt class="col-sm-4">Barangay</dt>
			<dd class="col-sm-8">
			    {{ $consultation->patient->barangay != null ? $consultation->patient->barangay : 'n/a' }}
            </dd>
            <dt class="col-sm-4">Zipcode</dt>
			<dd class="col-sm-8">
			    {{ $consultation->patient->zipcode ? $consultation->patient->zipcode : 'n/a' }}
            </dd>
			<dt class="col-sm-4">Remarks</dt>
			<dd class="col-sm-8">
			    {{ $consultation->remarks ?? 'n/a' }}
            </dd>
            @if(count((array)$consultation->custom_fields) > 0)
                @foreach($consultation->custom_fields as $field)
                    <dt class="col-sm-4">{{ $field['question'] }}</dt>
                    <dd class="col-sm-8">{{ $field['type'] == 'radio' || $field['type'] == 'checkbox' ? (isset($field['arr_answer']) ? (is_array($field['arr_answer']) ? implode(', ', $field['arr_answer']) : $field['arr_answer']) : 'n/a') : $field['answer'] }}</dd>
                @endforeach
            @endif
		</dl>
		<h5 class="border-top pt-3">Patient file(s)</h5>
		<div class="list-group attachedFiles">
            @forelse($consultation->getMedia('patient') as $media)
                <div class="list-group-item flex-column">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h5 class="mb-1">
                            {{$media->name}}<br/>
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
		<h5 class="border-top pt-3 mt-3">Center file(s)</h5>
        <div class="list-group attachedFiles">
            @forelse($consultation->getMedia('doctor') as $media)
                <div class="list-group-item flex-column">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h5 class="mb-1">
                            {{$media->name}}<br/>
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
	<div class="col-12 col-md-3 offset-md-3 mt-3 mt-md-0">
        @error('attachments.*.file')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Some attached files exceeds the maximum upload limit of 5mb. Please try again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
		<div class="card
			{{ ($consultation->isCancelled() || $consultation->isCompleted()) ? 'd-none' : '' }}">
			<div class="card-header text-center mb-2">
			  	Actions Required
			</div>
			<div class="p-2">
				@if(!$consultation->isCancelled())
				<form action="{{ route('doctor.appointments.cancel', $consultation)}}"
					method="post" class="d-inline">
					@csrf
					<button type="submit" class="btn btn-block mb-3 btn-danger confirmSubmit" disabled>
						Cancel
					</button>
				</form>
                @endif
                <button href="#" class="btn btn-info btn-block text-white" data-toggle="modal" data-target="#updateModal" disabled>
					Remarks
				</button>
			</div>
        </div>
        
		{{-- <div class="card mt-2">
        	<div class="p-2">
	        	<a href="{{ route('doctor.appointments.edit', $consultation) }}" class="btn btn-info btn-block text-white mb-3">
					Edit Details
				</a>
				<a href="#" class="btn btn-info btn-block text-white" data-toggle="modal" data-target="#updateModal">
					Remarks
				</a>
        	</div>
        </div> --}}

        @if(count($logs) > 0)
            <div class="card mt-3">
                <h5 class="card-header">Appointment Logs</h5>
                <div class="card-body px-0 py-0" style="max-height:300px;overflow:auto">
                    <div class="list-group  list-group-flush">
                        @foreach($logs as $log)
                            <div class="list-group-item flex-column px-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        {{ $log->excerpt }} on @dateTimeFormat($log->created_at)
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
	</div>
</div>

<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <form id="approveConsultationForm" action="{{ route('doctor.appointments.approve', $consultation) }}" method="POST">
	    	@csrf
		    <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Approve Appointment</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
				<div class="form-check form-group">
				  <input class="form-check-input" name="reschedule" type="checkbox" value="yes"
				  	id="rescheduleCheck">
				  <label class="form-check-label" for="rescheduleCheck">
				    Reschedule
				  </label>
				</div>
				<div class="row">
					<div class="form-group col-6">
					    <label for="dateInput">Date</label>
					    <input type="date" name="date" class="form-control"
					    	value="{{$consultation->date_time->toDateString()}}" id="dateInput" disabled>
				    </div>
				    <div class="form-group col-6">
					    <label for="timeInput">Time</label>
					    <input type="time" name="time" class="form-control timepicker"
					    	value="{{$consultation->date_time->format('h:i A')}}" id="timeInput" disabled>
				    </div>
				</div>
				<div class="row">
					<div class="form-group col-6">
					    <label for="timeInput">Amount</label>
					    <input type="number" step="any" name="consultation_fee" class="form-control"
					    	value="{{$consultation->consultation_fee}}">
				    </div>
					<div class="form-group col-6">
						<div class="form-check mt-4">
						  	<input class="form-check-input" name="no_payment_required" type="checkbox"
						  	value="1" id="noPaymentRequired">
							<label class="form-check-label" for="noPaymentRequired">
							    No payment required
							</label>
						</div>
					</div>
				</div>
			    <div class="form-group">
				    <label for="remarks">Remarks</label>
				    <textarea name="remarks" class="form-control" id="remarks"></textarea>
				    <small id="remarksHelp" class="form-text text-muted">
				    	Will be included in the email sent if given
					</small>
			    </div>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Submit</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="reschedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <form action="{{ route('doctor.appointments.reschedule', $consultation) }}" method="POST">
	    	@csrf
		    <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Reschedule Appointment</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
				<div class="row">
					<div class="form-group col-6">
					    <label for="dateInput">Date</label>
					    <input type="date" name="date" class="form-control"
					    	value="{{$consultation->actual_datetime->toDateString()}}" id="dateInput">
				    </div>
				    <div class="form-group col-6">
					    <label for="timeInput">Time</label>
					    <input type="time" name="time" class="form-control timepicker"
					    	value="{{$consultation->actual_datetime->format('h:i A')}}" 
							data-value="{{$consultation->actual_datetime->format('h:i A')}}" id="timeInput">
				    </div>
				</div>
				<div class="row">
					<div class="form-group col-6">
					    <label for="timeInput">Amount</label>
					    <input type="number" step="any" name="consultation_fee" class="form-control"
					    	value="{{$consultation->consultation_fee}}">
				    </div>
					<div class="form-group col-6">
						<div class="form-check mt-4">
						  	<input class="form-check-input" name="no_payment_required" type="checkbox"
						  	value="1" id="noPaymentRequired" {{ !$consultation->payment_required ? 'checked="checked"' : '' }}>
							<label class="form-check-label" for="noPaymentRequired">
							    No payment required
							</label>
						</div>
					</div>
				</div>
			    <div class="form-group">
				    <label for="remarks">Remarks</label>
				    <textarea name="remarks" class="form-control" id="remarks"></textarea>
				    <small id="remarksHelp" class="form-text text-muted">
				    	Will be included in the email sent if given
					</small>
			    </div>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Submit</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
	    <form action="{{ route('doctor.appointments.update', $consultation) }}" method="POST" enctype="multipart/form-data">
	    	@csrf
	    	@method('PUT')
		    <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Update Appointment</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
			    <div class="form-group">
				    <label for="remarks">Remarks</label>
				    <textarea name="remarks" class="form-control" id="remarks">{{$consultation->remarks}}</textarea>
                </div>
                <div class="multiFiles">
                    <h3 class="title">Upload Files</h3>
                    <a href="javascript:void(0);" class="btn btn-primary btn-addFile">Add File</a>
                    <div class="row fileRow">
                        <div class="col pr-0">
                            <label>Attach File</label>
                            <input name="attachments[0][file]" type="file" class="form-control-file">
                        </div>
                        <div class="col pr-0">
                            <label>Title</label>
                            <input type="text" name="attachments[0][title]" class="form-control">
                        </div>
                        <div class="col-auto">
                            <a href="javascript:void(0);" class="btn btn-danger btn-removeFile" style="margin-top: 30px"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Update</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		</form>
    </div>
  </div>
</div>

@endsection

@push('custom-styles')
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.date.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.time.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.js') }}" ></script>
<script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.date.js') }}" ></script>
<script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.time.js') }}" ></script>
<script>
let timePickContainer = $('.timepicker');
let $timePicker = timePickContainer.pickatime({
	interval: {{ $consultation->duration }},
	min: [8,0],
 	max: [17,0]
});
let timePicker = $timePicker.pickatime('picker');
timePicker.on('close', function() {
	let timeSelected = timePicker.get('value');
	$("#timeInput").val(timePicker.get('value'));
})


const checkbox = document.getElementById('rescheduleCheck')
checkbox.addEventListener('change', (event) => {
  	if (event.target.checked) {
    	$("#dateInput").prop("disabled", false);
    	$("#timeInput").prop("disabled", false);
  	} else {
    	$("#dateInput").prop("disabled", true);
    	$("#timeInput").prop("disabled", true);
  	}
})

$(document).ready(function(){

	$('form').on('submit', function(){
		$(this).find('button[type="submit"]').attr('disabled', true).text('Loading...');
	});

});
</script>
@endpush

@push('custom-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css" integrity="sha256-+bytSlt6ZKCfCCfKimCjD4CsDW9a0GpM85ZCOBDiLVI=" crossorigin="anonymous" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js" integrity="sha256-o/dXp1WxjpjU37PeBC5vxfc1yf/CgTCjWIzYUozOQ4Q=" crossorigin="anonymous"></script>
<script src="{{ asset('js/multifield.js') }}"></script>
<script>
    $('.multiFiles').multifield({
        section: '.fileRow',
        btnAdd:'.btn-addFile',
        btnRemove:'.btn-removeFile'
    });
    jQuery(document).ready(function($) {
		$('a[data-rel^=lightcase]').lightcase();
	});
</script>
@endpush
