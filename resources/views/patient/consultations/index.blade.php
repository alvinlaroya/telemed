@extends('layouts.patient')
@section('content')

<div class="page-header">
    <h1 class="h2">Consultations</h1>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="search" class="sr-only">Search</label>
                <input type="text" name="search" value="{{request('search')}}" id="search" class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label for="status" class="sr-only">Status</label>
                <select name="status" id="status" class="custom-select" placeholder="Status">
                    <option value="">-- Status --</option>
                    @foreach(\App\Consultation::$statuses as $key => $label)
                    <option value="{{$key}}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{$label}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto">
            <label for="sortBy" class="sr-only">Sort By</label>
            <select name="sort_by" id="sortBy" class="custom-select" placeholder="Sort By">
                <option value="appointment_date" {{ (!request('sort_by') || request('sort_by') == 'appointment_date') ? 'selected' : '' }}>
                    Sort by Appointment date
                </option>
                <option value="trans_date" {{ request('sort_by') == 'trans_date' ? 'selected' : '' }}>
                    Sort by Transaction date
                </option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-info">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('patient.appointments') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Patient Name</th>
            <th scope="col">Appointment Date & Time</th>
            <th scope="col">Purpose</th>
            {{-- <th scope="col" width="25%">Complaint</th> --}}
            <th scope="col" width="100">Status</th>
            <th scope="col" width="100">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($consultations as $consultation)
        <tr>
            <td>{{ $consultation->first_name }} {{ $consultation->last_name }}</td>
            <td>
                @dateFormat($consultation->actual_datetime) <br>
                @timeFormat($consultation->actual_datetime)
            </td>
            <td>{{ $consultation->mobile }}</td>
            {{-- <td>{{ $consultation->complaint }}</td> --}}
            <td>
                <span class="badge badge-info pending {{ $consultation->status }}">
                    @if($consultation->status == "approved")
                    Requested
                    @else
                    {{ ucwords($consultation->status) }}
                    @endif
                </span>
            </td>
            <td>
                <a href="{{ route('appointment.patient.details', $consultation) }}" target="_blank" title="Edit" class="btn btn-sm btn-md-light">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                    Details
                </a>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                No results found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- <div class="text-center">
  {!! $consultations->withQueryString()->links() !!}
</div> --}}

@endsection
