@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Doctors</h1>
	<div>
        <a class="btn btn-sm" href="{{ route('admin.doctors.bulk-upload.data') }}" role="button">Upload Doctors</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.doctors.create') }}" role="button">Add</a>   
    </div>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($doctors) > 0)
        @foreach($doctors as $doctor)
        <tr>
            <td>{{ $doctor->first_name }}</td>
            <td>{{ $doctor->last_name }}</td>
            <td>{{ $doctor->email }}</td>
            <td>{{ $doctor->mobile }}</td>
            <td>
                <a href="{{route('admin.doctors.secretaries.index', $doctor)}}" title="Manage Secretaries" class="btn btn-sm btn-success">
                    <i class="fa fa-user-nurse" aria-hidden="true"></i>
                </a>
                <a href="{{route('admin.doctors.edit', [$doctor])}}" title="Edit" class="btn btn-sm btn-info">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.doctors.destroy', $doctor),
                ])
            </td>
        </tr>
        @endforeach
    @else
        <tr><td class="text-center" colspan="4">No records found.</td></tr>
    @endif
   </tbody>
</table>
<div class="float-right">
    {{ $doctors->links() }}
</div>

@endsection
