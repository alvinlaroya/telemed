@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Users</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.users.create') }}" role="button">Add</a>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" id="search" class="form-control">
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label for="statusDropdown">Status</label>
                <select name="status"
                    id="statusDropdown"
                    class="custom-select d-block w-100">
                    <option value="">-- Filter by Status --</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-auto" style="margin-top:34px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($users) > 0)
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role_formatted }}</td>
            <td>
                <a href="{{route('admin.users.edit', [$user])}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.users.destroy', $user),
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
