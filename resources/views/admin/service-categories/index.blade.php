@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Centers</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Centers</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.service-categories.create') }}" role="button">Add</a>
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
            <a href="{{ route('admin.service-categories.index') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">No. of Services</th>
      <th scope="col" width="170">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($serviceCategories) > 0)
        @foreach($serviceCategories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td><span class="badge badge-sm badge-primary">{{ count($category->services) }}</span></td>
            <td>
                <a href="{{route('admin.service-categories.users.index', $category)}}" title="Manage Center Administrators" class="btn btn-sm btn-success">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </a>
                <a href="{{route('admin.center.custom-fields', [$category])}}"
                    title="Custom fields" class="btn btn-sm btn-info">
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                </a>
                <a href="{{route('admin.service-categories.edit', [$category])}}" title="Edit" class="btn btn-sm btn-info">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.service-categories.destroy', $category),
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
    @php
        $pagelinks = array('search' => request('search'), 'status' => request('status'));
    @endphp
    {{ $serviceCategories->appends($pagelinks)->links() }}
</div>
.
@endsection
