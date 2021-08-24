@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item">
		<a href="{{route('admin.service-categories.index')}}">Centers</a>
	</li>
    <li class="breadcrumb-item active" aria-current="page">Administrators</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">{{ $serviceCategory->name }} Administrators</h1>
	<a class="btn btn-sm btn-outline-secondary d-none" href="{{ route('admin.service-categories.users.create', array('service_category' => $serviceCategory)) }}" role="button">Add</a>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      {{-- <th scope="col" width="150">Actions</th> --}}
    </tr>
  </thead>
  <tbody>
    @if(count($users) > 0)
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            {{-- <td>
                <a href="{{route('admin.service-categories.users.edit', array('service_category' => $serviceCategory, 'user' => $user))}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.service-categories.users.destroy', array('service_category' => $serviceCategory, 'user' => $user)),
                ])
            </td> --}}
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
