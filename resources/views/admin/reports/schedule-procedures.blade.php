@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Booking/Schedule Procedures</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Booking/Schedule Procedures</h1>
</div>

<form action="" method="get">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') ? request('search'): '' }}">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="center">Center</label>
                <select name="center" id="center" class="form-control">
                    <option value="">-- Filter by Center --</option>
                    @forelse($centers as $key => $center)
                        <option value="{{ $center->id }}" {{ request('center') == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text"
                name="date"
                id="date"
                class="form-control date-pick"
                style="background:white; cursor:pointer;"
                readonly
                value="{{ request('date') ? request('date'): '' }}">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Filter by Status --</option>
                    @foreach(config('status.booking') as $key => $statusBooking)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $statusBooking }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto" style="margin-top: 30px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
                <a href="{{ route('admin.reports.transactions') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reference #</th>
      <th scope="col">Patient</th>
      <th scope="col">Centers</th>
      <th scope="col">Services</th>
    </tr>
  </thead>
  <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
        <tr>
            <td><a href="{{ route('admin.servicesBooking.show', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
            <td>{{ $booking->patient->name }}</td>
            <td>
                <ul>
                    @foreach($booking->bookingCenters as $bookingCenter)
                        <li>
                            {{ $bookingCenter->name }} ({{ $bookingCenter->available_date_time }})
                        </li>
                    @endforeach
                </ul>
            </td>
            <td>
                <ul>
                    @foreach($booking->bookingServices as $bookingService)
                        <li>
                            {{ $bookingService->name }}
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
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
