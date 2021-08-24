@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Audit Logs</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Audit Logs</h1>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') ? request('search'): '' }}">
            </div>
        </div>
        <div class="col-auto" style="margin-top: 30px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
                <a href="{{ route('center.reports.auditlog') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>
<table class="table audit-log-table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reference #</th>
      <th scope="col">Patient Name</th>
      <th scope="col">Logs</th>
      <th scope="col">Date & Time</th>
    </tr>
  </thead>
  <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $key => $booking)
            @php

                $noOfLogs = 1;
                $bookingCenters = $booking->bookingCenters()->ofCenters($assignedCenter)->latest()->get();
                foreach($bookingCenters as $bookingCentre) {
                    $noOfLogs += $bookingCentre->logs()->count();
                }
                $noOfLogs += $booking->logs()->count();

                $backgroundColor = ($key % 2 == 0) ? 'bg-none' : 'bg';

            @endphp
            <tr class="{{$backgroundColor}}">
                <td rowspan={{$noOfLogs}}><a href="{{ route('center.bookings.details', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
                <td rowspan={{$noOfLogs}}>{{ $booking->patient->name }}</td>

            </tr>
            @forelse ($bookingCenters as $bookingCentre)
                @forelse($bookingCentre->logs()->orderBy('created_at', 'DESC')->get() as $log)
                    <tr class="{{$backgroundColor}}">
                        <td>{{ $log->excerpt }}</td>
                        <td>@dateTimeFormat($log->created_at)</td>
                    </tr>
                @empty
                @endforelse
            @empty
            @endforelse
            @forelse($booking->logs()->orderBy('created_at', 'DESC')->get() as $log)
                <tr class="{{$backgroundColor}}">
                    <td>{{ $log->excerpt }}</td>
                    <td>@dateTimeFormat($log->created_at)</td>
                </tr>
            @empty
            @endforelse
        @endforeach
    @else
        <tr><td class="text-center" colspan="5">No records found.</td></tr>
    @endif
   </tbody>
</table>
<div class="float-right">
    {{ $bookings->links() }}
</div>

@endsection
