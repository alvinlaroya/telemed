@extends('layouts.home')

@push('styles')
    <style>
        label {
            display: block;
            margin-bottom: 0;
            font-weight: bold;
        }

        .content {
            background: #e0e1ed;
        }

    </style>
@endpush

@section('content')
    <div class="doctor-profile-section">
        <div class="container">

            <div class="row mt-5">
                <div class="col-3 offset-1">
                    <img src="{{ $doctor->getFirstMediaUrl('avatar') }}" class="card-img-top mx-auto doctor-thumb"
                        alt="...">
                    @if ($doctor->consultation_duration && $doctor->consultation_fee)
                        <a href="{{ route('make-appointment', $doctor->id) }}" class="mt-3 btn btn-primary btn-block">
                            Make Appointment
                        </a>
                    @endif
                </div>
                <div class="col-7 doctor-card-info py-3">
                    <h1 class="text-d-blue">{{ $doctor->full_name }}</h1>
                    @if (count($doctor->specializations) > 0)
                        <p class="mb-2">
                            <label for="cdays">Specializations:</label>
                            {{ $doctor->specializations_formatted }}
                        </p>
                    @endif
                    @if ($doctor->clinic_days)
                        <p class="mb-2">
                            <label for="cdays">Clinic Days:</label>
                            {{ $doctor->clinic_days_formatted }}
                        </p>
                    @endif
                    @if ($doctor->hmos->count() > 0)
                        <p class="mb-2">
                            <label for="hmo">HMO Accreditations:</label>
                            {{ $doctor->hmos_formatted }}
                        </p>
                    @endif
                    <div class="mt-4 mb-5">{!! $doctor->description !!}</div>
                </div>
            </div>

        </div>
    </div>


@endsection
