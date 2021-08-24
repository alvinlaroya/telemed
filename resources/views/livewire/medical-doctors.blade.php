@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
@endpush

<div>
	<div class="page-header">
		<h1 class="h2">Doctors</h1>
	</div>

	<input type="text" wire:model.debounce.500ms="search" class="form-control" id="search"
		placeholder="Search">
	<br>

	<table class="table table-striped">
		<thead class="thead-dark">
		    <tr>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Mobile</th>
		      <th scope="col" width="200">Actions</th>
		    </tr>
		</thead>
	    <tbody>
	        @forelse($doctors as $doctor)
	        <tr>
	            <td>{{ $doctor->first_name }}</td>
	            <td>{{ $doctor->last_name }}</td>
	            <td>{{ $doctor->email }}</td>
	            <td>{{ $doctor->mobile }}</td>
	            <td>
	                <a href="{{route('medical.doctors.schedule', $doctor)}}" title="Manage Schedule" class="btn btn-sm btn-info">
	                    <i class="fas fa-calendar mr-1"></i>
	                    Schedule
	                </a>
	                <a href="{{route('medical.doctors.profile', $doctor)}}" title="Edit Profile" class="btn btn-sm btn-success">
	                    <i class="fas fa-user-edit mr-1"></i>
	                    Profile
	                </a>
	            </td>
	        </tr>
	        @empty
	        <tr><td class="text-center" colspan="4">No records found.</td></tr>
	        @endforelse
	    </tbody>
	</table>

	<div class="float-right">
	    {!! $doctors->links() !!}
	</div>
</div>
