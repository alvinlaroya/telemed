@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Patients</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Patients</h1>
	{{-- <div>
        <a class="btn btn-sm" href="{{ route('admin.doctors.bulk-upload.data') }}" role="button">Upload Doctors</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.doctors.create') }}" role="button">Add</a>   
    </div> --}}
</div>

<form action="{{ route('admin.search.patient') }}" method="get" class="form-inlines">
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="search" class="sr-only">Search</label>
                <input type="text" name="search" value="{{request('search')}}" id="search"
                    class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-info">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('admin.patients.index') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

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
    @if(count($patients) > 0)
        @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->first_name }}</td>
            <td>{{ $patient->last_name }}</td>
            <td>{{ $patient->email }}</td>
            <td>{{ $patient->mobile }}</td>
            <td colspan="2">
                {{-- <a href="{{route('admin.doctors.secretaries.index', $doctor)}}" title="Manage Secretaries" class="btn btn-sm btn-success">
                    <i class="fa fa-user-nurse" aria-hidden="true"></i>
                </a>
                <a href="{{route('admin.doctors.edit', [$doctor])}}" title="Edit" class="btn btn-sm btn-info">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.doctors.destroy', $doctor),
                ]) --}}
                <div style="flex-direction: row; display: flex; width: 100%">
                    <a href="{{ route('book-doctor-on-behalf-of-patient', $patient->id) }}" class="btn btn-primary">Book a Doctor</a>&nbsp;
                    <a href="{{ route('book-lab-on-behalf-of-patient', $patient->id) }}" class="btn btn-primary">Book a Labs</a>
                </div>
            </td>
        </tr>
        @endforeach
    @else
        <tr><td class="text-center" colspan="4">No records found.</td></tr>
    @endif
   </tbody>
</table>
{{-- <div class="float-right">
    {{ $doctors->links() }}
</div> --}}

@endsection
