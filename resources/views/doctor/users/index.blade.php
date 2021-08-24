@extends('layouts.doctor')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Users</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('doctor.users.create') }}" role="button">Add</a>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">E-mail</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($users) > 0)
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{route('doctor.users.edit', [$user])}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('doctor.inline-delete', [
                    'action' => route('doctor.users.destroy', $user),
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
    {{ $users->links() }}
</div>

@endsection
