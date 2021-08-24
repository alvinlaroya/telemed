@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Bookings</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Bookings</h1>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="search" class="sr-only">Search</label>
                <input type="text" name="search" value="{{request('search')}}" id="search"
                    class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label for="center" class="sr-only">Center</label>
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
                <label for="status" class="sr-only">Status</label>
                <select name="status" id="status" class="form-control" placeholder="Status">
                    <option value="">-- Status --</option>
                    @foreach(\App\Booking::$statuses as $key => $label)
                    <option value="{{$key}}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{$label}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label for="date" class="sr-only">Date</label>
                <input type="date" name="date" value="{{request('date')}}" id="date"
                    class="form-control" placeholder="Date">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-info">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('center.bookings') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reference no.</th>
      <th scope="col">Name</th>
      <th scope="col">Centers</th>
      <th scope="col">Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Mode of Payment</th>
      <th scope="col" width="120">Actions</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($bookings as $booking)
	<tr>
        <?php $centers = $booking->bookingCenters ?>
		<td>{{$booking->booking_reference_no}}</td>
        <td>{{ $booking->patient->name }}</td>
        <td>
            <ul>
                @forelse($centers as $center)
                    @if($center->available_date)
                        @if($center->available_date->format('Y-m-d') == request('date'))
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
        <td>{{ $booking->patient->mobile }}</td>
        <td>
            <span class="badge badge-info {{ $booking->status ?? $booking->status }}">
                {{ ucfirst($booking->status ?? $booking->status) }}
            </span>
        </td>
        <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
		<td>
            <a href="{{route('center.bookings.details', $booking)}}" title="Details"
                class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                Details
            </a>
		</td>
	</tr>
    @empty
    <tr>
        <td colspan="7">No results found</td>
    </tr>
	@endforelse
  </tbody>
 </table>

 {!! $bookings->withQueryString()->links() !!}

@endsection
