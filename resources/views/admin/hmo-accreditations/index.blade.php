@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">HMO Accreditations</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">HMO Accreditations</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.hmo-accreditations.create') }}" role="button">Add</a>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($hmoAccreditations) > 0)
        @foreach($hmoAccreditations as $hmoAccreditation)
        <tr>
            <td>{{ $hmoAccreditation->name }}</td>
            <td>{{ $hmoAccreditation->description }}</td>
            <td>
                <a href="{{route('admin.hmo-accreditations.edit', [$hmoAccreditation])}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.hmo-accreditations.destroy', $hmoAccreditation),
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
    {{ $hmoAccreditations->links() }}
</div>

@endsection
