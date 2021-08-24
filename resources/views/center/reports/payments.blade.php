@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Payments</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Payments</h1>
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
                <label for="mop">Mode of Payment</label>
                <select name="mop" id="center" class="form-control">
                    <option value="">-- Filter by Mode of Payment --</option>
                    <option value="">All</option>
                    @foreach(config('telemed.mode_of_payment') as $key => $mode)
                        <option value="{{ $key }}" {{ request('mop') == $key ? 'selected' : '' }}>{{ $mode }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text"
                name="date"
                id="date"
                class="form-control date-range-picker"
                autocomplete="off"
                value="{{ request('date') ? request('date'): '' }}">
            </div>
        </div>
        <div class="col-auto" style="margin-top: 30px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
                <a href="{{ route('center.reports.payments') }}" class="btn btn-danger ml-2">Reset</a>
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
      <th scope="col">Payment Ref #</th>
      <th scope="col">Date of Payment</th>
      <th scope="col">Mode of Payment</th>
      <th scope="col">Payment</th>
    </tr>
  </thead>
  <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
        <tr>
            <td><a href="{{ route('center.bookings.details', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
            <td>{{ $booking->patient->name }}</td>
            <td>{{ $booking->payment_ref ? $booking->payment_ref : 'N/A' }}</td>
            <td>@if($booking->paid_at)@dateFormat($booking->paid_at) @else N/A @endif</td>
            <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
            @if(request('center'))
                @forelse($booking->bookingCenters as $center)
                    @if($booking->mode_of_payment == 'credit_card')
                        <td class="price">&#8369;{{ number_format($center->amount_paid, 2) }}</td>
                    @else
                        <td class="price">&#8369;{{ number_format($center->center_discounted_totalAmount, 2) }}</td>
                    @endif
                @empty
                @endforelse
            @else
                @if($booking->mode_of_payment == 'credit_card')
                    <td class="price">&#8369;{{ number_format($booking->amount_paid, 2)  }}</td>
                @else
                    <td class="price">&#8369;{{ number_format($booking->discounted_total_amount, 2)  }}</td>
                @endif
            @endif
        </tr>
        @endforeach
        <tr>
            <td colspan="5"></td>
            <td class="price"><b>Total: </b> <span>&#8369; {{ number_format($total, 2) }}</span></td>
        </tr>
    @else
        <tr><td class="text-center" colspan="6">No records found.</td></tr>
    @endif
   </tbody>
</table>
<div class="float-right">
    {{ $bookings->links() }}
</div>

@endsection

@push('custom-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>
@endpush
