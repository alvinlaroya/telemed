@extends('layouts.home')

@section('content')
<div style="height: 75vh">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Appointment Scheduling</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <form action="{{ route('saveBookingService') }}" method="POST" id="saveBooking" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="summary-box">
                        <div class="head-wrap">
                            <h4>Summary</h4>
                        </div>
                        <div class="body-wrap">
                            <h5 class="border-top pt-3">Basic Information</h5>
                            <dl class="row">
                                <dt class="col-sm-5">Services: </dt>
                                <dd class="col-sm-7">
                                    @if($data['centers'])
                                    <ul>
                                        @foreach ($data['centers'] as $center)
                                        <li>
                                            <span><b>{{ $center['name'] }}</b> - {{ $center['preferred_date'] }}</span>
                                            @if($center['service'])
                                            <ul>
                                                @foreach($center['service'] as $service)
                                                <li>{{ $service['name'] }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </dd>
                                <dt class="col-sm-5">Name: </dt>
                                <dd class="col-sm-7">
                                    @isset($data['middlename'])
                                    {{ $data['firstname'] . ' ' . $data['middlename'] . ' ' . $data['lastname'] }}
                                    @endisset
                                    {{ $data['firstname'] . ' ' . $data['lastname'] }}
                                </dd>
                                <dt class="col-sm-5">Email: </dt>
                                <dd class="col-sm-7">
                                    {{ $data['email'] }}
                                </dd>
                                <dt class="col-sm-5">Mobile: </dt>
                                <dd class="col-sm-7">
                                    {{ $data['mobile'] }}
                                </dd>
                                <dt class="col-sm-5">Senior Citizen or PWD: </dt>
                                <dd class="col-sm-7">
                                    {{ isset($data['seniorPWD']) ? 'Yes' : 'No' }}
                                </dd>
                                <dt class="col-sm-5">Mode of Payment: </dt>
                                <dd class="col-sm-7">
                                    {{ isset($data['modeOfPayment']) ? config('telemed.mode_of_payment')[$data['modeOfPayment']] : '' }}
                                    {{ isset($data['mopOther']) ? '(' . $data['mopOther'] . ')' : '' }}
                                </dd>
                                @if(isset($data['seniorPWD']))
                                <dt class="col-sm-5">ID No: </dt>
                                <dd class="col-sm-7">
                                    {{ $data['idNumber'] ?? '' }}
                                </dd>
                                @endif
                                @if(isset($data['seniorPWD']))
                                <dt class="col-sm-5">Sub Total: </dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ $totalPayment }}</p>
                                </dd>
                                <dt class="col-sm-5">Discount:</dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ $discount }}</p>
                                </dd>
                                <dt class="col-sm-5">TOTAL AMOUNT:</dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ $withDiscount }}</p>
                                </dd>
                                @else
                                <dt class="col-sm-5">TOTAL AMOUNT:</dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ $totalPayment }}</p>
                                </dd>
                                @endif
                                {{-- @if($hasAfter5Days)
                                <dt class="col-sm-5">FIRST PAYMENT:</dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ number_format($firstPayment, 2) }}</p>
                                </dd>
                                <dt class="col-sm-5">OTHER PAYMENT:</dt>
                                <dd class="col-sm-7">
                                    <p class="price">&#8369;{{ number_format($otherPayment, 2) }}</p>
                                </dd>
                                @endif --}}
                            </dl>
                            <!-- @if($hasAfter5Days)
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                The preferred schedules of the services you selected are more than five (5) days apart. Because the patient screening form is valid for five (5) days only, you will be asked to fill out another form at least 24 hours before the next scheduled appointment. Separate payments will be requested accordingly.
                            </div>
                        @endif -->
                            @if(isset($data['answers']))
                            <h5 class="border-top pt-3">Additional Information</h5>
                            @foreach($data['answers'] as $answers)
                            @if(isset($answers['fields']))
                            <h6 class="pt-3">{{ $answers['center_name'] }}</h6>
                            <dl class="row">
                                @foreach($answers['fields'] as $fields)
                                <dt class="col-sm-5">{{ $fields['question'] }}</dt>
                                <dd class="col-sm-7">
                                    @if($fields['type'] == 'checkbox')
                                    @if(isset($fields['arr_answer']))
                                    @foreach($fields['arr_answer'] as $arrAnswer)
                                    <span>{{ $arrAnswer }}</span>
                                    @endforeach
                                    @else
                                    <span>N/A</span>
                                    @endif
                                    @elseif($fields['type'] == 'radio')
                                    @if(isset($fields['arr_answer']))
                                    <span>{{ $fields['arr_answer'] }}</span>
                                    @else
                                    <span>N/A</span>
                                    @endif
                                    @else
                                    <span>{{ ($fields['answer']) ? $fields['answer'] : 'N/A' }}</span>
                                    @endif
                                </dd>
                                @endforeach
                            </dl>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="button-wrapper">
                            <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                            <button class="btn btn-primary" type="submit">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>
        @endsection

        @push('scripts')
        <script>
            $('#saveBooking').submit(function() {
                $(this).find('button[type=submit]').prop('disabled', true);
            });

        </script>
        @endpush
