@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Transactions</h1>
</div>

<form action="" method="get">
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') ? request('search'): '' }}">
            </div>
        </div>
        <div class="col-auto">
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
        <div class="col-auto">
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
        <div class="col-auto">
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
                <a href="{{ route('center.reports.transactions') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
        <div class="col-auto" style="margin-top: 30px">
            <button type="submit" class="btn btn-success" name="excelDownload" value="excel">Download Excel</button>
        </div>
    </div>
</form>
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reference #</th>
      <th scope="col">Patient</th>
      <th scope="col">Centers</th>
      <th scope="col">Status</th>
      <th scope="col">Mode of Payment</th>
    </tr>
  </thead>
  <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
            <?php $centers = $booking->bookingCenters ?>
        <tr>
            <td><a href="{{ route('center.bookings.details', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
            <td>{{ $booking->patient->name }}</td>
            <td>
                <ul>
                    @forelse($centers as $center)
                        @if($center->available_date)
                            @if($center->available_date->format('m/d/Y') == request('date'))
                            <li>
                                <label><b>{{ $center->name }}</b>
                                    <span class="badge badge-info {{ $center->status ?? $center->status }}">
                                        {{ ucfirst($center->status ?? $center->status) }}
                                    </span>
                                    <p style="margin-bottom: 0;">Scheduled Date: @dateFormat($center->available_date)</p>
                                </label>
                                @if($center->bookingServices)
                                    <ul style="padding-left: 10px;">
                                        @foreach($center->bookingServices as $services)
                                            <li>{{ $services->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @elseif(request('date') == null)
                            <li>
                                <label><b>{{ $center->name }}</b>
                                    <span class="badge badge-info {{ $center->status ?? $center->status }}">
                                        {{ ucfirst($center->status ?? $center->status) }}
                                    </span>
                                    <p style="margin-bottom: 0;">Scheduled Date: @dateFormat($center->available_date)</p>
                                </label>
                                @if($center->bookingServices)
                                    <ul style="padding-left: 10px;">
                                        @foreach($center->bookingServices as $services)
                                            <li>{{ $services->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endif
                        @elseif(request('date') == null)
                            <li>
                                <label><b>{{ $center->name }}</b>
                                    <span class="badge badge-info {{ $center->status ?? $center->status }}">
                                        {{ ucfirst($center->status ?? $center->status) }}
                                    </span>
                                    @if($center->available_date)
                                        <p style="margin-bottom: 0;">Scheduled Date: @dateFormat($center->available_date)</p>
                                    @else
                                        <p style="margin-bottom: 0;">Scheduled Date: ----</p>
                                    @endif
                                </label>
                                @if($center->bookingServices)
                                    <ul style="padding-left: 10px;">
                                        @foreach($center->bookingServices as $services)
                                            <li>{{ $services->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @empty
                    @endforelse
                </ul>
            </td>
            <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
            <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
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
