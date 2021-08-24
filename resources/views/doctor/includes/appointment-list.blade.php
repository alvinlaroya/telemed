<li class="list-group-item">
    <div class="row align-items-center">
        <div class="col">
        {{ $appointment->name }} <span class="badge badge-secondary {{ $appointment->status }} ml-1">
            @if($appointment->status == "approved")
                Requested
            @else
                {{ ucfirst($appointment->status) }}
            @endif
        </span>
            <small class="d-block"><i class="fa fa-{{ optional($appointment->patient)->gender == 'female' ? 'venus' : 'mars' }}" style="width:15px"></i> {{ $appointment->age_formatted }}</small>
            @php
                $typeIcon = 'user-md';
                if($appointment->type == 'walkin'){
                    $typeIcon = 'walking';
                }elseif($appointment->type == 'online'){
                    $typeIcon = 'chalkboard-teacher';
                }
            @endphp
            @if($appointment->type)
            <small class="d-block"><i class="fa fa-{{ $typeIcon }}" style="width:17px"></i> {{ $appointment->type_display }}</small>
            @endif
            <small class="d-block"><i class="fa fa-comment" style="width:15px"></i> {{ $appointment->complaint }}</small>
        </div>
        <div class="col-auto">
            <a href="{{ route('doctor.appointments.show', $appointment) }}" class="btn btn-sm btn-primary">View <i class="fa fa-angle-right ml-2"></i></a>
        </div>
    </div>
</li>
