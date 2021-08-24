@extends('layouts.patient')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Services Booking</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Services Booking</h1>
</div>

<form action="" method="get">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') ? request('search'): '' }}">
            </div>
        </div>
        {{-- <div class="col-3">
            <div class="form-group">
                <label for="filterCenter">Center</label>
                <select name="center" id="filterCenter" class="form-control">
                    <option value="">-- Filter by Center --</option>
                    @forelse($centers as $center)
                        <option value="{{ $center->id }}" {{ request('center') == $center->id ? 'selected' : '' }} >{{ $center->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div> --}}
        <div class="col-3">
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
                <a href="{{ route('admin.servicesBooking') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reference #</th>
      <th scope="col">Name</th>
      <th scope="col">Service</th>
      <th scope="col">Mobile</th>
      <th scope="col">Preferred Date</th>
      <th scope="col">Status</th>
      <th scope="col" width="200">Actions</th>
    </tr>
  </thead>
  <tbody>
        @forelse($bookings as $booking)
        <tr>
        	<td>{{ $booking->booking_reference_no }}</td>
            <td>{{ $booking->patient->name }}</td>
            <td>
                <ul>
                    @foreach($booking->bookingServices as $bookingService)
                        <li>
                            {{ $bookingService->service->name }}
                        </li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $booking->patient->mobile }}</td>
            <td>@dateFormat($booking->preferred_date)</td>
            <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
            <td>
                <a href="{{ route('admin.servicesBooking.show', $booking) }}" title="Edit"
                class="btn btn-sm btn-info">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                {{-- <a href="{{ route('admin.servicesBooking.show', $booking) }}" title="Edit"
                class="btn btn-sm btn-success">
                    <i class="fas fa-check"></i>
                </a>
                <a href="{{ route('admin.servicesBooking.show', $booking) }}" title="Edit"
                class="btn btn-sm btn-warning">
                    <i class="fas fa-times"></i>
                </a>
                <a href="{{ route('admin.servicesBooking.show', $booking) }}" title="Edit"
                class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </a> --}}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">No record(s) found!</td>
        </tr>
        @endforelse
   </tbody>
</table>
<div class="float-right">
    {{ $bookings->links() }}
</div>

@endsection
