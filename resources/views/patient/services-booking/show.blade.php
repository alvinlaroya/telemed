@extends('layouts.patient')

@section('content')

    <div class="page-header">
        <h1 class="h2">Booking Details
            <span class="badge {{ $booking->status }}">
                @if ($booking->status == 'approved')
                    Requested
                @else
                    {{ ucfirst($booking->status) }}
                @endif
            </span>
        </h1>
    </div>


    <div class="row">
        <div class="col-6">

            <dl class="row">
                <dt class="col-sm-4">Reference no.</dt>
                <dd class="col-sm-8">
                    {{ $booking->booking_reference_no }}
                </dd>
                <dt class="col-sm-4">Actual Date & Time: </dt>
                <dd class="col-sm-8">
                    {{ $booking->available_date ? date('D, M d, Y', strtotime($booking->available_date)) . ' ' . date('h:i A', strtotime($booking->available_time)) : 'N/A' }}
                </dd>
                <dt class="col-sm-4">Centers</dt>
                <dd class="col-sm-8">
                    <ul>
                        @forelse($booking->bookingCenters as $bookingCenter)
                            <li>
                                <span>{{ $bookingCenter->name }}</span>
                                <ul>
                                    @foreach ($bookingCenter->bookingServices as $bookingService)
                                        @if ($booking->is_home_visit && !in_array($bookingService->name, ['Covid Primary Package', 'Covid Secondary Package']))
                                            <li>
                                                {{ $bookingService->name }} (&#8369; 0.00)
                                            </li>
                                        @else
                                            <li>
                                                {{ $bookingService->name }} (&#8369;
                                                {{ $booking->patient->pwd_senior == 1 ? number_format($bookingService->service->serivce_discounted, 2) : number_format($bookingService->service->price, 2) }})
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </dd>
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->name }}
                </dd>
                <dt class="col-sm-4">Birthdate</dt>
                <dd class="col-sm-8">

                    @if ($booking->patient->birthdate)
                        @dateFormat($booking->patient->birthdate)
                    @else
                        n/a
                    @endif
                </dd>
                <dt class="col-sm-4">Age</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->age_formatted }}
                </dd>
                <dt class="col-sm-4">Mobile</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->mobile }}
                </dd>
                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->email }}
                </dd>
                <dt class="col-sm-4">House Number</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->house_number != null ? $booking->patient->house_number : 'n/a' }}
                </dd>
                <dt class="col-sm-4">Street</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->street != null ? $booking->patient->street : 'n/a' }}
                </dd>
                <dt class="col-sm-4">Barangay</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->address ? \App\Barangay::where('id', $booking->patient->address->barangay)->first()->name : 'n/a' }}
                </dd>
                <dt class="col-sm-4">City</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->address ? \App\City::where('city_id', $booking->patient->address->city)->first()->name : 'n/a' }}
                </dd>
                <dt class="col-sm-4">Province</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->address ? \App\Province::where('province_id', $booking->patient->address->province)->first()->name : 'n/a' }}
                </dd>
                <dt class="col-sm-4">Zipcode</dt>
                <dd class="col-sm-8">
                    {{ $booking->patient->zipcode != null ? $booking->patient->zipcode : 'n/a' }}
                </dd>
                <!-- <dt class="col-sm-4">Fall Risk</dt>
                <dd class="col-sm-8">
                    {!! $booking->patient->is_fallrisk ? '<span class="badge badge-danger">Yes</span>' : 'No' !!}
                    @if ($booking->patient->is_fallrisk)
                    <a href="{{ route('view-patient-screening', ['patient' => $booking->patient, 'screening' => $booking->patient->screening, 'type' => 'fallrisk']) }}" title="View {{ $booking->patient->name }}'s Fall Risk Form" target="_blank"><i class="fas fa-info-circle"></i></a>
                    @endif
                </dd> -->
                <!-- @if (count($booking->patient->screenings) > 0) <dt class="col-sm-4">COVID Screenings</dt>
                    <dd class="col-sm">
                        <dl class="row mb-0 ml-1">
                        @foreach ($booking->patient->screenings as $key => $screening)
                            <div>
                                @dateFormat($screening->created_at)<br>
                                <a href="{{ route('view-patient-screening-2', ['patient' => $booking->patient, 'screening' => $screening, 'type' => 'booking']) }}" title="View {{ $booking->patient->name }}'s Screening Form" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Patient</a>
                                @if (($screening->data['has_companion'] ?? '') == 'Yes')
                                    <a href="{{ route('view-patient-screening-2', ['patient' => $booking->patient, 'screening' => $screening, 'type' => 'booking', 'view' => 'companion']) }}" title="View {{ $booking->patient->name }}'s Companion Screening Form" class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i> Companion</a> @endif
                            </div>
                            <dt class="col-12 ml-0 pl-0">
                                <hr class="mt-2 mb-1" style="border-color:#e9ecef">
                            </dt>
                        @endforeach
                        </dl>
                    </dd>
                    <dt class="col-12"></dt>
                @endif -->
                @if ($booking->patient->pwd_senior)
                    <dt class="col-sm-4">Senior Citzen or PWD</dt>
                    <dd class="col-sm-8">Yes</dd>
                    <dt class="col-sm-4">ID Number</dt>
                    <dd class="col-sm-8">{{ $booking->patient->id_number }}</dd>
                    @if (count($booking->getMedia('senior-pwd-id')) > 0)
                        <dt class="col-sm-4">Senior/PWD ID (Front)</dt>
                        <dd class="col-sm-8">
                            <dl class="row mb-0 ml-1">
                                @foreach ($booking->getMedia('senior-pwd-id') as $media)
                                    <div>
                                        <a href="{{ $media->getUrl() }}" title="{{ $media->name }}"
                                            class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i>
                                            Attachment</a>
                                    </div>
                                @endforeach
                            </dl>
                        </dd>
                    @endif
                    @if (count($booking->getMedia('senior-pwd-id-back')) > 0)
                        <dt class="col-sm-4">Senior/PWD ID (Back)</dt>
                        <dd class="col-sm-8">
                            <dl class="row mb-0 ml-1">
                                @foreach ($booking->getMedia('senior-pwd-id-back') as $media2)
                                    <div>
                                        <a href="{{ $media2->getUrl() }}" title="{{ $media2->name }}"
                                            class="btn btn-sm btn-light" target="_blank"><i class="fab fa-wpforms mr-1"></i>
                                            Attachment</a>
                                    </div>
                                @endforeach
                            </dl>
                        </dd>
                    @endif
                @endif
                <dt class="col-sm-4">Mode of Payment</dt>
                <dd class="col-sm-8">
                    {{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}
                    @if ($booking->mode_of_payment != 'credit_card')
                        ( {{ $booking->mop_other }} )
                    @endif
                </dd>
                <dt class="col-sm-4">Total Amount</dt>
                <dd class="col-sm-8">
                    @if ($booking->is_home_visit)
                        {{ number_format($booking->package->price, 2) }}
                    @elseif($booking->patient->pwd_senior)
                        @money($booking->discounted_total_amount)
                    @else
                        @money($booking->total_amount)
                    @endif
                </dd>
                @if ($booking->paid_at)
                    <dt class="col-sm-4">Amount Paid</dt>
                    <dd class="col-sm-8">
                        @money($booking->amount_paid)
                    </dd>
                    <dt class="col-sm-4">Payment Reference No.</dt>
                    <dd class="col-sm-8">
                        {{ $booking->payment_ref ? $booking->payment_ref : 'N/A' }}
                    </dd>
                @endif
                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                    <span class="badge {{ $booking->status }}">
                        @if ($booking->status == 'approved')
                            Requested
                        @else
                            {{ ucfirst($booking->status) }}
                        @endif
                    </span>
                </dd>
            </dl>
            @if ($booking->custom_fields)
                <h5 class="border-top pt-3">Additional Information</h5>
                <dl class="row">
                    @foreach ($booking->custom_fields as $fields)
                        <dt class="col-sm-3">{{ $fields['question'] }}</dt>
                        <dd class="col-sm-9">
                            @if ($fields['type'] == 'checkbox')
                                @if (isset($fields['arr_answer']))
                                    @foreach ($fields['arr_answer'] as $arrAnswer)
                                        <span>{{ $arrAnswer }}</span>
                                    @endforeach
                                @else
                                    <span>N/A</span>
                                @endif
                            @elseif($fields['type'] == 'radio')
                                @if (isset($fields['arr_answer']))
                                    <span>{{ $fields['arr_answer'] }}</span>
                                @else
                                    <span>N/A</span>
                                @endif
                            @else
                                <span>{{ $fields['answer'] ? $fields['answer'] : 'N/A' }}</span>
                            @endif
                        </dd>
                    @endforeach
                </dl>
            @endif
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('patient.bookings.send.documents', $booking) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message">Message ( Will be received by your email. )</label>
                            <textarea name="message" rows="1" class="form-control @error('message') is-invalid @enderror"
                                id="message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="multiFiles">
                            <h3 class="title">Upload Deposit slip, prescriptions and other files</h3>
                            {{-- <a href="javascript:void(0);" class="btn btn-primary btn-addFile">Add File</a> --}}
                            <div class="row fileRow">
                                <div class="col-12 col-lg mb-2 mb-lg-0 pr-lg-0">
                                    <label>Attach File</label>
                                    <input name="attachments[0][file]" type="file" class="form-control-file">
                                </div>
                                <div class="col col-lg pr-lg-0">
                                    <label>Title</label>
                                    <input type="text" name="attachments[0][title]" class="form-control">
                                </div>
                                {{-- <div class="col-auto">
                                <a href="javascript:void(0);" class="btn btn-danger btn-removeFile" style="margin-top: 30px"><i class="fas fa-times"></i></a>
                            </div> --}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Send</button>
                    </form>
                </div>
            </div>
            <h5 class="border-top mt-4 pt-2 pt-3">Uploaded Documents</h5>
            <div class="list-group attachedFiles">
                @forelse($booking->getMedia('service-booking-'.auth()->user()->patient->id) as $media)
                    <div class="list-group-item flex-column">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h5 class="mb-1">
                                {{ $media->name }}<br />
                                <small class="d-block">Size: {{ $media->human_readable_size }}</small>
                                <small class="d-block">Date & Time Uploaded: @dateTimeFormat($media->created_at)</small>
                            </h5>
                            <div class="buttons" style="flex-shrink:0">
                                @if (strpos($media->mime_type, 'image') !== false)
                                    <a href="{{ $media->getFullUrl() }}" class="btn btn-primary btn-sm"
                                        data-rel="lightcase" title="{{ $media->name }}"><i class="fas fa-eye"></i></a>
                                @else
                                    <a href="{{ $media->getFullUrl() }}" class="btn btn-primary btn-sm"
                                        target="_blank"><i class="fas fa-eye"></i></a>
                                @endif
                                <a href="{{ $media->getUrl() }}" class="btn btn-success btn-sm" download>
                                    <i class="fas fa-download"></i>
                                </a>
                                @include('admin.inline-delete', [
                                'action' => route('patient.bookings.media.remove', [$booking, $media]),
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
{{--             <h5 class="border-top mt-4 pt-2 pt-3">Labs/Diagnostic Center Documents</h5>
            <div class="list-group attachedFiles">
                @forelse($booking->getMedia('service-booking-'.$booking->patient->id) as $media)
                    <div class="list-group-item flex-column">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h5 class="mb-1">
                                {{$media->name}}<br/>
                                <small class="d-block">Size: {{ $media->human_readable_size }}</small>
                                <small class="d-block">Date & Time Uploaded: @dateTimeFormat($media->created_at)</small>
                            </h5>
                            <div class="buttons" style="flex-shrink:0">
                                @if(strpos($media->mime_type, 'image') !== false)
                                    <a href="{{ $media->getFullUrl() }}" class="btn btn-primary btn-sm" data-rel="lightcase" title="{{$media->name}}"><i class="fas fa-eye"></i></a>
                                @else
                                    <a href="{{ $media->getFullUrl() }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                                @endif
                                <a href="{{ $media->getUrl() }}" class="btn btn-success btn-sm" download>
                                    <i class="fas fa-download"></i>
                                </a>
                                @include('admin.inline-delete', [
                                    'action' => route('patient.bookings.media.remove', [$booking, $media]),
                                ])
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
                        <h5 class="mb-0">No uploaded files.</h5>
                    </div>
                @endforelse
            </div> --}}
        </div>
    </div>
@endsection
