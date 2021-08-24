@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Services</li>
@endpush

@section('content')


<div class="page-header">
	<h1 class="h2">Services</h1>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-auto">
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
        <div class="col-auto">
            <div class="form-group">
                <label for="serviceCategoryDropdown">Center</label>
                <select name="center"
                    class="custom-select d-block w-100">
                    <option value="">-- Filter by Center --</option>
                    @if($serviceCenters)
                        @foreach($serviceCenters as $serviceCenter)
                            <option value="{{$serviceCenter->id}}" {{ request('center') == $serviceCenter->id ? 'selected' : '' }}>{{$serviceCenter->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-auto" style="margin-top:30px">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('center.servicePrices') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Product Code</th>
      <th scope="col">Center</th>
      <th scope="col">Status</th>
      <th scope="col">Eligible for Senior/PWD Discount</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    @if(count($services) > 0)
        @foreach($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->product_code }}</td>
            <td>{{ $service->category->name }}</td>
            <td>{{ $service->status ? 'Active' : 'Inactive' }}</td>
            <td>{{ $service->eligible ? 'Yes' : 'No' }}</td>
            <td class="price">{{ number_format($service->price, 2) }}</td>
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
