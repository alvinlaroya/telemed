@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{route('admin.appointments')}}">Appointments</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Details</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">
		Appointment Details
		<span class="badge badge-secondary">{{ ucfirst($consultation->status) }}</span>

		@if($consultation->paid)
			<span class="badge badge-success">Paid</span>
		@endif
	</h1>
</div>

<div class="row mb-5">
	<div class="col-6">
		<dl class="row">
			<dt class="col-sm-3">Name</dt>
			<dd class="col-sm-9">
				{{ $consultation->name }}
			</dd>
			<dt class="col-sm-3">Date & Time</dt>
			<dd class="col-sm-9">
			    @dateTimeFormat($consultation->actual_datetime)
			</dd>
			<dt class="col-sm-3">Mobile</dt>
			<dd class="col-sm-9">
			    {{ $consultation->mobile }}
			</dd>
			<dt class="col-sm-3">Email</dt>
			<dd class="col-sm-9">
			    {{ $consultation->email }}
			</dd>
			<dt class="col-sm-3">Birthdate</dt>
			<dd class="col-sm-9">
				@if($consultation->birthdate)
			    	@dateFormat($consultation->birthdate)
			    @else
			    	n/a
			    @endif
			</dd>
			<dt class="col-sm-3">Gender</dt>
			<dd class="col-sm-9">
				@if($consultation->gender)
			    	{{ ucfirst($consultation->gender) }}
			    @else
			    	n/a
			    @endif
			</dd>
			<dt class="col-sm-3">Address</dt>
			<dd class="col-sm-9">
			    {{ $consultation->address ?? 'n/a' }}
			</dd>
			<dt class="col-sm-3">Complaint</dt>
			<dd class="col-sm-9">
			    {{ $consultation->complaint }}
			</dd>
			<dt class="col-sm-3">Remarks</dt>
			<dd class="col-sm-9">
			    {{ $consultation->remarks ?? 'n/a' }}
			</dd>
		</dl>
		<h5 class="border-top pt-3">Patient attached files</h5>
		<table class="table table-striped table-sm">
			<tbody>
				@forelse($consultation->getMedia('patient') as $media)
				<tr>
					<td>
						<a href="{{ $media->getUrl() }}" target="_blank">{{$media->name}}</a> <br>
					</td>
					<td width="50">
						@include('admin.inline-delete', [
		                    'action' => route('admin.appointments.media.remove', [$consultation, $media]),
		                ])
					</td>
				</tr>
				@empty
				<tr>
					<td>none</td>
				</tr>
				@endforelse
			</tbody>
		</table>
		<h5 class="border-top pt-3">Your attached files</h5>
		<table class="table table-striped table-sm">
			<tbody>
				@forelse($consultation->getMedia('doctor') as $media)
				<tr>
					<td>
						<a href="{{ $media->getUrl() }}" target="_blank">{{$media->name}}</a> <br>
					</td>
					<td width="50">
						@include('admin.inline-delete', [
		                    'action' => route('admin.appointments.media.remove', [$consultation, $media]),
		                ])
					</td>
				</tr>
				@empty
				<tr>
					<td>none</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="col-3 offset-3">
		<div class="card {{ $consultation->isCompleted() ? 'd-none' : '' }}">
			<div class="card-header text-center mb-2">
			  	Actions Required
			</div>
			<div class="p-2">
				@if($consultation->isPending())
					<button type="submit" class="btn btn-block btn-primary mb-3" data-toggle="modal"
						data-target="#approveModal">
						Approve
					</button>
				@endif
				@if($consultation->isApproved())
					<form action="{{ route('admin.appointments.confirm', $consultation)}}" method="post"
						class="d-inline">
						@csrf
						<button type="submit" class="btn btn-block mb-3 btn-success confirmSubmit">
							Confirm
						</button>
					</form>
				@endif
				@if($consultation->isConfirmed())
					<form action="{{ route('admin.appointments.complete', $consultation)}}" method="post" 	class="d-inline">
						@csrf
						<button type="submit" class="btn btn-block mb-3 btn-success confirmSubmit">
							Complete
						</button>
					</form>
				@endif
				<a href="#" class="btn btn-danger btn-block confirmWarning" data-cancel-text="Close"
					data-confirm-text="Cancel this appointment.">
					Cancel
				</a>
				<hr>
				<a href="#" class="btn btn-info btn-block" data-toggle="modal"
					data-target="#updateModal">
					Update
				</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <form action="{{ route('admin.appointments.approve', $consultation) }}" method="POST">
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
					    <input type="time" name="time" class="form-control"
					    	value="{{$consultation->date_time->format('H:i')}}" id="timeInput" disabled>
				    </div>
				</div>
			    <div class="form-group">
				    <label for="hrs">Duration</label>
				    <input type="number" name="duration" class="form-control" value="10" id="hrs">
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <form action="{{ route('admin.appointments.update', $consultation) }}" method="POST" enctype="multipart/form-data">
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
				<div class="form-group">
				    <label for="exampleFormControlFile1">Attach files</label>
				    <input name="files[]" type="file" class="form-control-file filepond" id="exampleFormControlFile1" multiple>
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

@endsection

@push('scripts')
<script>
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
</script>
@endpush
