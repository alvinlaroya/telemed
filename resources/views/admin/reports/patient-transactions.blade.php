@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Transaction Per Patients</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Transaction Per Patients</h1>
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
                <a href="{{ route('admin.reports.patientTransactions') }}" class="btn btn-danger ml-2">Reset</a>
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
      <th scope="col">Patient</th>
      <th scope="col">No. of Transaction</th>
    </tr>
  </thead>
  <tbody>
    @if(count($patients) > 0)
        @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->name }}</td>
            <td><a href="{{ route('admin.reports.patientTransactionDetails', $patient) }}">{{ $patient->bookings_count }}</a></td>
        </tr>
        @endforeach
    @else
        <tr><td class="text-center" colspan="5">No records found.</td></tr>
    @endif
   </tbody>
</table>
<div class="float-right">
    {{ $patients->links() }}
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
