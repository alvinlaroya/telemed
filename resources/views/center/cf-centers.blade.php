@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Centers</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Centers</h1>
</div>

<form action="" method="get" class="form-inlines">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="search" class="sr-only">Search</label>
                <input type="text" name="search" value="{{request('search')}}" id="search"
                    class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-info">Filter</button>
            @if(request()->has('search'))
            <a href="{{ route('center.bookings') }}" class="btn btn-danger ml-2">Reset</a>
            @endif
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Center</th>
        <th scope="col" width="120">Actions</th>
      </tr>
    </thead>
    <tbody>
     @forelse($centers as $center)
      <tr>
          <td>{{$center->name}}</td>
          <td style="width: 200px;">
              <a href="{{route('center.custom-fields', array('center'=>$center->id))}}" title="Details"
                  class="btn btn-sm btn-info">
                  <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                  Edit Custom Forms
              </a>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="2">No results found</td>
      </tr>
      @endforelse
    </tbody>
   </table>

   {!! $centers->withQueryString()->links() !!}

   @endsection
