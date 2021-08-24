<div class="card">
    <div class="card-body">
        <div class="d-flex flex-row">
            <span class="font-weight-bold">{{ $appointment->patient->name }}</span>
            <span class="badge badge-pill badge-secondary ml-1 {{ $appointment->status }}">
                @if($appointment->status == "approved")
                    Requested
                @else
                    {{ ucwords($appointment->status) }}
                @endif
            </span>
        </div>
        <div class="card-info" style="font-size: 13px">
            <div>
                <i class="far fa-clock"></i>&nbsp;
                <span>{{ date_format($appointment->created_at,"Y/m/d H:i:s") }}</span>
            </div>
            <div>
                @if ($appointment->type_display != null)
                    <i class="fab fa-chromecast"></i>&nbsp;
                @endif
                <span>{{ $appointment->type_display }}</span>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <div>
                    @if ($appointment->complaint != null)
                        <i class="fas fa-book-medical"></i>&nbsp;
                    @endif
                    <span>{{ $appointment->complaint }}</span>
                </div>
                <div>
                    <a href="{{ $appointment->type_display != null ? route('appointment.patient.details', $appointment) : route('patient.servicesBooking.show', $appointment) }}" target="_blank" class="btn btn-sm btn-primary">View <i class="fa fa-angle-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <li class="list-group-item">
    <div class="row align-items-center">
        <div class="col">
        {{ $booking->patient->name }} <span class="badge badge-secondary ml-1 {{ $booking->status }}">{{ ucwords($booking->status) }}</span>
            <small class="d-block"><i class="fa fa-at" style="width:15px"></i> {{ $booking->patient->email }}</small>
            <small class="d-block"><i class="fa fa-mobile" style="width:15px"></i> {{ $booking->patient->mobile }}</small>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.servicesBooking.show', $booking) }}" class="btn btn-sm btn-primary">View <i class="fa fa-angle-right ml-2"></i></a>
        </div>
    </div>
</li> --}}