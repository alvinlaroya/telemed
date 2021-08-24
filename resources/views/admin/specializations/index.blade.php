@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Specializations</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Specializations</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.specializations.create') }}" role="button">Add</a>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Parent</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($specializations) > 0)
        @foreach($specializations as $specialization)
        <tr>
            <td>{{ $specialization->name }}</td>
            <td>{{ optional($specialization->parent)->name }}</td>
            <td>
                <a href="{{route('admin.specializations.edit', [$specialization])}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.specializations.destroy', $specialization),
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
    {{ $specializations->links() }}
</div>

@endsection
