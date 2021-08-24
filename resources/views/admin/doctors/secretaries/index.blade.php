@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item">
		<a href="{{route('admin.doctors.index')}}">Doctors</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Secretaries</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">{{ $doctor->name }}'s Secretaries</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.doctors.secretaries.create', array('doctor' => $doctor)) }}" role="button">Add</a>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($secretaries) > 0)
        @foreach($secretaries as $secretary)
        <tr>
            <td>{{ $secretary->name }}</td>
            <td>{{ $secretary->email }}</td>
            <td>
                <a href="{{route('admin.doctors.secretaries.edit', array('doctor' => $doctor, 'secretary' => $secretary))}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.doctors.secretaries.destroy', array('doctor' => $doctor, 'secretary' => $secretary)),
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
    {{ $secretaries->links() }}
</div>

@endsection
