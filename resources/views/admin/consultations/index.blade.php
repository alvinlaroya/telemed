@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Appointments</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Appointments</h1>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Date & Time</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Complaint</th>
      <th scope="col" width="200">Actions</th>
    </tr>
  </thead>
  <tbody>
        @foreach($consultations as $consultation)
        <tr>
        	<td>@dateTimeFormat($consultation->date_time)</td>
            <td>{{ $consultation->first_name }}</td>
            <td>{{ $consultation->last_name }}</td>
            <td>{{ $consultation->mobile }}</td>
            <td>{{ $consultation->complaint }}</td>
            <td>
              <a href="{{ route('admin.appointments.show', $consultation) }}" title="Edit"
                class="btn btn-sm btn-info">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                    Details
                </a>
            </td>
        </tr>
        @endforeach
   </tbody>
</table>



@endsection
