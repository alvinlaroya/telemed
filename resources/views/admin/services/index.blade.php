@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Service</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Service</h1>
	<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.services.create') }}" role="button">Add</a>
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
        <div class="col-3">
            <div class="form-group">
                <label for="serviceCategoryDropdown">Center</label>
                <select name="center"
                    id="serviceCategoryDropdown"
                    class="custom-select d-block w-100"
                    data-action="{{ route('admin.service-categories.index') }}"
                    data-value="{{ request('center') }}"
                    data-placeholder="-- Filter by Center --">
                </select>
            </div>
        </div>
        <div class="col-auto" style="margin-top:34px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('admin.services.index') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Center</th>
      <th scope="col">Price</th>
      <th scope="col" width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($services) > 0)
        @foreach($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->category->name }}</td>
            <td class="price">{{ number_format($service->price, 2) }}</td>
            <td>
                <a href="{{route('admin.services.edit', [$service])}}" title="Edit" class="btn btn-sm btn-info">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </a>
                @include('admin.inline-delete', [
                    'action' => route('admin.services.destroy', $service),
                ])
            </td>
        </tr>
        @endforeach
    @else
        <tr><td class="text-center" colspan="5">No records found.</td></tr>
    @endif
   </tbody>
</table>
<div class="float-right">
    @php
        $pagelinks = array('search' => request('search'), 'status' => request('status'), 'center' => request('center'));
    @endphp
    {{ $services->appends($pagelinks)->links() }}
</div>

@endsection
