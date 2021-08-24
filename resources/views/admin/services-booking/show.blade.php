@extends('layouts.admin')

@push('styles')
@livewireStyles
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('center.bookings')}}">Bookings</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">#{{$booking->booking_reference_no}}</li>
@endpush

@section('content')

<div class="page-header">
    <h1 class="h2">
        Booking #{{$booking->booking_reference_no}}
        @if($booking->isPaid())
            <span class="badge badge-success paid">
                Paid
            </span>
        @endif
    </h1>
</div>

<div class="row mb-5">
    <div class="col-12 col-md-7" id="bookingDetails">
        @foreach($bookingCenters as $key => $bookingC)
        <div class="card mb-3">
            <h5 class="card-header">{{$bookingC->name}}
                <span class="badge badge-secondary {{ $bookingC->status }}">
                    {{ ucfirst($bookingC->status) }}
                </span>
            </h5>
            @foreach ($bookingC->bookingServices as $bService)
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $bService->service->name }}
                        
                        @if($booking->is_home_visit && !in_array($bService->name, ['Covid Primary Package', 'Covid Secondary Package']))
                            <span>(&#8369; 0.00)</span> {{$bService->name}}
                        @else
                            @if($booking->patient->pwd_senior)
                                <span>(&#8369; {{ number_format($bService->service->serivce_discounted, 2) }})</span>
                            @else
                                <span>(&#8369; {{ number_format($bService->service->price, 2) }})</span>
                            @endif
                        @endif

                        <span class="badge badge-secondary {{ $bService->status }}">
                            {{ ucfirst($bService->status) }}
                        </span>
                    </h5>
                    @if($bService->remarks)
                    <p class="text-secondary">
                        <strong>Remarks: </strong>
                        {{ $bService->remarks }}
                    </p>
                    @endif
                    <br>
                    @if($bService->isPending())
                        <form action="{{ route('admin.bookings.service.approve', [$booking, $bService])}}"
                            method="post" class="d-inline mr-2">
                            @csrf
                            @if(!$bookingC->available_time)
                            <button type="button" class="btn mb-3 btn-success"
                                onClick="alert('Set availability date and time below before clicking approve.')">
                                Approve
                            </button>
                            @else
                            <button type="submit" class="btn mb-3 btn-success confirmSubmit">
                                Approve
                            </button>
                            @endif
                        </form>
                    @endif
                    @if($bService->isApproved() && $booking->mode_of_payment == 'credit_card')
                    <form action="{{ route('center.bookings.service.confirm', [$booking, $bService])}}"
                        method="post" class="d-inline mr-2">
                        @csrf
                        <button type="submit" class="btn mb-3 btn-success confirmSubmit"
                            title="Confirm payment is receive"
                            data-confirm-text="Confirm booked service"
                            @if(!$bookingC->isPaid()) disabled @endif>
                            Confirm
                        </button>
                    </form>
                    @elseif($bService->isApproved() && $booking->mode_of_payment != 'credit_card')
                        <form action="{{ route('admin.bookings.service.complete', [$booking, $bService])}}"
                            method="post" class="d-inline mr-2">
                            @csrf
                            <button type="submit" class="btn mb-3 btn-success confirmSubmit">
                                Complete
                            </button>
                        </form>
                    @endif
                    @if($bService->isConfirmed())
                        <form action="{{ route('admin.bookings.service.complete', [$booking, $bService])}}"
                            method="post" class="d-inline mr-2">
                            @csrf
                            <button type="submit" class="btn mb-3 btn-success confirmSubmit">
                                Complete
                            </button>
                        </form>
                    @endif
                    @if($bService->isCancellable())
                    <form action="{{ route('admin.bookings.service.cancel', [$booking, $bService])}}"
                        method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="reason" class="reason-input">
                        <button type="submit" class="btn mb-3 btn-danger confirmCancel"
                            data-confirm-text="Cancel this booking">
                            Cancel
                        </button>
                    </form>
                    @endif
                </div>
            @endforeach
            <div class="card-body">
                @if(!$bookingC->available_time)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                      Set availability date and time by clicking on edit link below.
                </div>
                @endif
                <dl class="row">
                    @if($bookingC->preferred_date)
                        @if(!$bookingC->preferred_date->equalTo($bookingC->available_date)
                            && $bookingC->available_date)
                            <dt class="col-sm-4">Scheduled Date</dt>
                            <dd class="col-sm-8">
                                @if($bookingC->available_date)
                                @dateTimeFormat($bookingC->available_date)
                                @endif
                                <a href="#" class="ml-2 text-info" data-toggle="modal"
                                    data-target="#changeDateModal-{{ $key }}">
                                    Edit
                                </a>
                            </dd>
                            <dt class="col-sm-4">Prefered Date</dt>
                            <dd class="col-sm-8">
                                @if($bookingC->preferred_date)
                                    @dateFormat($bookingC->preferred_date)
                                @endif
                            </dd>
                        @else
                            <dt class="col-sm-4">Prefered Date</dt>
                            <dd class="col-sm-8">
                                @if($bookingC->preferred_date)
                                    @dateFormat($bookingC->preferred_date)
                                @endif
                                <a href="#" class="ml-2 text-info" data-toggle="modal"
                                    data-target="#changeDateModal-{{ $key }}">
                                    Edit
                                </a>
                            </dd>
                        @endif
                    @else
                        <dt class="col-sm-4">Prefered Date</dt>
                        <dd class="col-sm-8">
                            @if($bookingC->preferred_date)
                                @dateFormat($bookingC->preferred_date)
                            @endif
                            <a href="#" class="ml-2 text-info" data-toggle="modal"
                                data-target="#changeDateModal-{{ $key }}">
                                Edit
                            </a>
                        </dd>
                    @endif

                    @if($bookingC->remarks)
                        <dt class="col-sm-4">Remarks</dt>
                        <dd class="col-sm-8">
                            {!! $bookingC->remarks !!}
                        </dd>
                    @endif
                    @if($booking->mode_of_payment == 'credit_card')
                    <dt class="col-sm-4">Payment Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge badge-secondary {{ $bookingC->payment_status }}">
                            {{ ucfirst($bookingC->payment_status) }}
                        </span>
                    </dd>
                    @endif
                    @if($bookingC->isPaid())
                        <dt class="col-sm-4">Payment Ref. No.</dt>
                        <dd class="col-sm-8">
                            {{ $bookingC->payment_ref }}
                        </dd>
                        <dt class="col-sm-4">Paid At</dt>
                        <dd class="col-sm-8">
                            @dateTimeFormat($bookingC->paid_at)
                        </dd>
                        <dt class="col-sm-4">Amount Paid</dt>
                        <dd class="col-sm-8">
                            @money($bookingC->amount_paid)
                        </dd>
                    @endif
                </dl>
                <hr>
                <livewire:booking-notes :bCenter="$bookingC">
            </div>
        </div>
        <div class="modal fade" id="changeDateModal-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.bookings.center.datetime', [$booking, $bookingC]) }}"
                        method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Date & Time ({{ $bookingC->name }})</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            @if($bookingC->preferred_date)
                            Preferred Date: @dateFormat($bookingC->preferred_date)
                            @else
                            Preferred Date: ----
                            @endif
                        </p>
                        <div class="row">
                            @csrf
                            <div class="form-group col-6">
                                <label for="dateInput">Scheduled Date</label>
                                {{-- <input type="date" name="date" class="form-control"
                                    value="{{optional($bookingC->available_date)->toDateString()}}"
                                    id="dateInput"> --}}
                                <input type="text" name="date" class="form-control date-picks"
                                    value="{{$bookingC->available_date ? date('m/d/Y', strtotime($bookingC->available_date)) : ''}}"
                                    autocomplete="off"
                                    data-value="{{$bookingC->available_date ? date('m/d/Y', strtotime($bookingC->available_date)) : ''}}"
                                    id="dateInput">
                            </div>
                            <div class="form-group col-6">
                                <label for="timeInput">Scheduled Time</label>
                                {{-- <input type="time" name="time" class="form-control"
                                    value="{{ $bookingC->available_time }}"
                                    id="timeInput"> --}}
                                <input type="text" name="time" class="form-control time-picks"
                                    value="{{ $bookingC->available_time }}"
                                    readonly
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks ( Will be received by client )</label>
                            <textarea name="remarks" id="remarks" class="form-control">{{$bookingC->remarks}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="col-12 col-md-5">
        {{-- @if(!$bookingCenter->available_time)
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            Set availability date and time by clicking on edit link below.
        </div>
        @endif --}}
        <div class="card">
            <div class="card-body">
                {{-- @if($booking->payment_ref)
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Payment Ref. No.</dt>
                        <dd class="col-sm-8">
                            {{ $booking->payment_ref }}
                        </dd>
                        @if($booking->paid_at)
                        <dt class="col-sm-4">Paid At</dt>
                        <dd class="col-sm-8">
                            @dateTimeFormat($booking->paid_at)
                        </dd>
                        <dt class="col-sm-4">Amount Paid</dt>
                        <dd class="col-sm-8">
                            @money($amountPaid)
                        </dd>
                        @endif
                    </dl>
                    @if($booking->paid_at)
                    <div class="alert alert-success" role="alert">
                      Payment successfull
                    </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                      Payment failed
                    </div>
                    @endif
                    <hr>
                @endif --}}
                {{-- <dl class="row">
                    @if(!$bookingCenter->preferred_date->equalTo($bookingCenter->available_date)
                        && $bookingCenter->available_date)
                        <dt class="col-sm-4">Scheduled Date</dt>
                        <dd class="col-sm-8">
                            @dateTimeFormat($bookingCenter->available_date)
                            <a href="#" class="ml-2 text-info" data-toggle="modal"
                                data-target="#changeDateModal">
                                Edit
                            </a>
                        </dd>
                        <dt class="col-sm-4">Prefered Date</dt>
                        <dd class="col-sm-8">
                            @dateFormat($bookingCenter->preferred_date)
                        </dd>
                    @else
                        <dt class="col-sm-4">Prefered Date</dt>
                        <dd class="col-sm-8">
                            @dateFormat($bookingCenter->preferred_date)
                            <a href="#" class="ml-2 text-info" data-toggle="modal"
                                data-target="#changeDateModal">
                                Edit
                            </a>
                        </dd>
                    @endif
                    @if($bookingCenter->remarks)
                    <dt class="col-sm-4">Remarks</dt>
                    <dd class="col-sm-8">
                        {!! $bookingCenter->remarks !!}
                    </dd>
                    @endif
                </dl> --}}
                <dl class="row mb-0">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->name }}
                    </dd>
                    <dt class="col-sm-4">Mobile no.</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->mobile }}
                    </dd>
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->email }}
                    </dd>
                    <dt class="col-sm-4">Province</dt>
                    <dd class="col-sm-8">
                        {{ optional($booking->patient->province)->name ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">City</dt>
                    <dd class="col-sm-8">
                        {{ optional($booking->patient->city)->name ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">House number</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->house_number ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">Street</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->street ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">Barangay</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->barangay ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">Zipcode</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->zipcode ?? 'n/a' }}
                    </dd>
                    <dt class="col-sm-4">Age</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->age_formatted }}
                    </dd>

                    {{-- <dt class="col-sm-4">Fall Risk</dt>
                    <dd class="col-sm-8">
                        {!! $booking->patient->is_fallrisk ? '<span class="badge badge-danger">Yes</span>' : 'No' !!}
                        @if($booking->patient->is_fallrisk)
                        <a href="{{ route('view-patient-screening', array('patient' => $booking->patient, 'screening' => $booking->patient->screening, 'type' => 'fallrisk')) }}" title="View {{ $booking->patient->name }}'s Fall Risk Form" target="_blank"><i class="fas fa-info-circle"></i></a>
                        @endif
                    </dd>
                    
                    
                    @if(count($booking->patient->screenings) > 0)
                        <dt class="col-sm-auto">COVID Screenings</dt>
                        <dd class="col-sm">
                            <dl class="row mb-0">
                            @foreach($booking->patient->screenings as $key =>  $screening)
                                <div>
                                    @dateFormat($screening->created_at)<br>
                                    <a href="{{ route('view-patient-screening-2', array('patient' => $booking->patient, 'screening' => $screening, 'type' => 'booking')) }}" title="View {{ $booking->patient->name }}'s Screening Form" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Patient</a>
                                    @if(($screening->data['has_companion'] ?? '') == 'Yes')
                                        <a href="{{ route('view-patient-screening-2', array('patient' => $booking->patient, 'screening' => $screening, 'type' => 'booking', 'view' => 'companion')) }}" title="View {{ $booking->patient->name }}'s Companion Screening Form" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Companion</a>
                                    @endif
                                </div>
                                <dt class="col-12 ml-0 pl-0">
                                    <hr class="mt-2 mb-1" style="border-color:#e9ecef">
                                </dt>
                            @endforeach
                            </dl>
                        </dd>
                        <dt class="col-12"></dt>
                    @endif
                    --}}

                    @if($booking->patient->pwd_senior)
                    <dt class="col-sm-4">PWD / Senior</dt>
                    <dd class="col-sm-8">
                        {!! $booking->patient->pwd_senior ? '<span class="badge badge-success">Yes</span>' : 'No' !!}
                    </dd>
                    <dt class="col-sm-4">ID Number</dt>
                    <dd class="col-sm-8">
                        {{ $booking->patient->id_number }}
                    </dd>
                    @if(count($booking->getMedia('senior-pwd-id')) > 0)
                        <dt class="col-sm-4">Senior/PWD ID (Front)</dt>
                        <dd class="col-sm-8">
                            <dl class="row mb-0 ml-1">
                                @foreach($booking->getMedia('senior-pwd-id') as $media)
                                    <div>
                                        <a href="{{ $media->getUrl() }}" title="{{$media->name}}" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Attachment</a>
                                    </div>
                                @endforeach
                            </dl>
                        </dd>
                    @endif
                    @if(count($booking->getMedia('senior-pwd-id-back')) > 0)
                        <dt class="col-sm-4">Senior/PWD ID (Back)</dt>
                        <dd class="col-sm-8">
                            <dl class="row mb-0 ml-1">
                                @foreach($booking->getMedia('senior-pwd-id-back') as $media2)
                                    <div>
                                        <a href="{{ $media2->getUrl() }}" title="{{$media2->name}}" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Attachment</a>
                                    </div>
                                @endforeach
                            </dl>
                        </dd>
                    @endif
                    @endif
                    <dt class="col-sm-4">Mode of Payment</dt>
                    <dd class="col-sm-8">
                        {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}
                        @if($booking->mode_of_payment != 'credit_card' && $booking->mode_of_payment != 'philhealth')
                            ( {{ $booking->mop_other }} )
                        @endif
                        @if($booking->isApproved())
                        <form action="{{ route('center.bookings.resend_email', $booking)}}"
                        method="post" class="d-inline mr-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                Resend Email
                            </button>
                        </form>
                        @endif
                    </dd>
                    @if($booking->patient->pwd_senior)
                        <dt class="col-sm-4">Sub Total</dt>
                        <dd class="col-sm-8">
                            &#8369;{{number_format($subTotal, 2)}}
                        </dd>
                        <dt class="col-sm-4">Discount</dt>
                        <dd class="col-sm-8">
                            &#8369;{{number_format($discount, 2)}}
                        </dd>
                    @endif
                    <dt class="col-sm-4">Total Amount</dt>
                    <dd class="col-sm-8">
                        &#8369; {{ number_format($totalAmount, 2) }}
                    </dd>
                </dl>
                @foreach($bookingCenters as $bookingCent)
                @if(!empty($bookingCent->custom_fields))
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Center:</dt>
                    <dd class="col-sm-8">{{ $bookingCent->name }}</dd>
                    @foreach($bookingCent->custom_fields as $field)
                    <dt class="col-sm-4">{{ $field['question'] }}</dt>
                    <dd class="col-sm-8">
                        {{ $field['type'] == 'radio' || $field['type'] == 'checkbox' ? (isset($field['arr_answer']) ? (is_array($field['arr_answer']) ? implode(', ', $field['arr_answer']) : $field['arr_answer']) : 'n/a') : $field['answer'] }}
                    </dd>
                    @endforeach
                </dl>
                @endif
                @endforeach
            </div>
        </div>

        @if(count($booking->getMedia('doctor-request')) > 0)
            <div class="card mt-3">
                <h5 class="card-header">Doctor's Request Attachments</h5>
                <div class="card-body px-0 py-0" style="max-height:300px;overflow:auto">
                    <div class="list-group  list-group-flush">
                        @foreach($booking->getMedia('doctor-request') as $media)
                            <div class="list-group-item flex-column px-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="mb-1">
                                        {{$media->name}}<br/>
                                        <small class="d-block" style="font-size: 10px;">Size: {{ $media->human_readable_size }}</small>
                                        <small class="d-block" style="font-size: 10px;">Date & Time Uploaded: @dateTimeFormat($media->created_at)</small>
                                    </h5>
                                    <div class="buttons" style="flex-shrink:0">
                                        @if(strpos($media->mime_type, 'image') !== false)
                                            <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" data-rel="lightcase" title="{{$media->name}}"><i class="fas fa-eye"></i></a>
                                        @else
                                            <a href="{{ $media->getUrl() }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                                        @endif
                                        <a href="{{ $media->getUrl() }}" class="btn btn-success btn-sm" download><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="card mt-3">
            <h5 class="card-header">Booking Logs</h5>
            <div class="card-body px-0 py-0" style="max-height:300px;overflow:auto">
                <div class="list-group  list-group-flush">
                    @foreach($bookingCenters as $bookingCentre)
                        @foreach($bookingCentre->logs()->orderBy('created_at', 'DESC')->get() as $log)
                            <div class="list-group-item flex-column px-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        {{ $log->excerpt }} on @dateTimeFormat($log->created_at)
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    @foreach($booking->logs()->orderBy('created_at', 'DESC')->get() as $log)
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

    </div>
</div>

{{-- <div class="modal fade" id="changeDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('center.bookings.center.datetime', [$booking, $bookingCenter]) }}"
            method="POST">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Date & Time</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>
                Prefrered Date: @dateFormat($bookingCenter->preferred_date)
            </p>
            <div class="row">
                @csrf
                <div class="form-group col-6">
                    <label for="dateInput">Scheduled Date</label>
                    <input type="date" name="date" class="form-control"
                        value="{{optional($bookingCenter->available_date)->toDateString()}}"
                        id="dateInput">
                </div>
                <div class="form-group col-6">
                    <label for="timeInput">Scheduled Time</label>
                    <input type="time" name="time" class="form-control"
                        value="{{ $bookingCenter->available_time }}"
                        id="timeInput">
                </div>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks ( Will be received by client )</label>
                <textarea name="remarks" id="remarks" class="form-control">{{$bookingCenter->remarks}}</textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
  </div>
</div> --}}

@endsection

@push('scripts')
<script>
$(".confirmCancel").click(function(e) {
    e.preventDefault();
    let _self = $(this);
    Swal.fire({
      title: 'Cancel Booked Service',
      text: 'Enter reason for cancellation.',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      cancelButtonText: 'Close',
      confirmButtonText: 'Submit',
    }).then((result) => {
        if (result.value) {
            let input = _self.closest('form').find('.reason-input')
            input.val(result.value);
            _self.closest("form").submit();
            _self.prop('disabled', true);
        }
    })
})

$(document).ready(function(){

    $('form').on('submit', function(){
        $(this).find('button[type="submit"]').attr('disabled', true).text('Loading...');
    });

});
</script>
@livewireScripts
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
