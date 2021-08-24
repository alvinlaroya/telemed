@push('styles')
<style>
.filter {
	background-color: #d5d5e1;
	border: 1px solid #cacad6;
}
.doctor-thumb {
	max-width: 200px;
	padding-top: 10px;
}
.doctor-card .card-body {
	padding: 15px 15px;
}
</style>
@endpush

{{-- <div class="{{ $doctorId ? 'd-none' : '' }}"> --}}
<div>
	<div class="filter card">
		<div class="card-body">
			<div class="row">
			    <div class="form-group col-4">
				    <label for="search">Doctor's Name</label>
				    <input type="text" wire:model.debounce.500ms="search" class="form-control" id="search" placeholder="Search">
				</div>

				<div class="form-group col-4">
				    <label for="search">Specialization</label>
				    <select name="specialization" wire:model="specializationId" class="form-control" id="specialization">
				    	<option value="">Any</option>
				    	@foreach($specializations as $specialization)
				    	<option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
				    	@endforeach
				    </select>
				</div>
				
				{{-- <div class="form-group col-3">
				    <label for="hmo">HMO</label>
				    <select name="hmo" wire:model="hmoId" class="form-control" id="hmo">
				    	<option value="">Any</option>
				    	@foreach($hmos as $hmo)
				    	<option value="{{ $hmo->id }}">{{ $hmo->name }}</option>
				    	@endforeach
				    </select> --}}
				    {{-- <input type="text" wire:model.debounce.800ms="hmo" class="form-control" id="hmo"> --}}
				{{-- </div> --}}
				<div class="col-4">
					<div class="form-group">
						<label for="hmo">Gender</label>
						<div class="mt-1">
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" wire:model="gender" id="customRadio1" value="male" class="custom-control-input">
			  					<label class="custom-control-label" for="customRadio1">Male</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" wire:model="gender" id="customRadio2" value="female" class="custom-control-input">
			  					<label class="custom-control-label" for="customRadio2">Female</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-7">
					<label>Clinic Days</label>
		            <div class="row">
						<div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Sun"
	                        	class="form-check-input" id="Sun" value="1">
	                            <label class="form-check-label" for="Sun">
	                                Sun
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Mon"
	                        	class="form-check-input" id="Mon" value="1">
	                            <label class="form-check-label" for="Mon">
	                                Mon
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Tue"
	                        	class="form-check-input" id="Tue" value="1">
	                            <label class="form-check-label" for="Tue">
	                                Tue
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Wed"
	                        	class="form-check-input" id="Wed" value="1">
	                            <label class="form-check-label" for="Wed">
	                                Wed
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Thu"
	                        	class="form-check-input" id="Thu" value="1">
	                            <label class="form-check-label" for="Thu">
	                                Thu
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Fri"
	                        	class="form-check-input" id="Fri" value="1">
	                            <label class="form-check-label" for="Fri">
	                                Fri
	                            </label>
	                        </div>
		                </div>
		                <div class="col-auto">
			                <div class="form-check">
	                        	<input type="checkbox"
	                        	wire:model="filterClinicDays.Sat"
	                        	class="form-check-input" id="Sat" value="1">
	                            <label class="form-check-label" for="Sat">
	                                Sat
	                            </label>
	                        </div>
		                </div>
		            </div>
				</div>
				<div class="col-5">
					<div class="filter-btns float-right">
						<button wire:click="resetSearch" class="btn btn-secondary mt-2">Reset</button>
						<button class="btn btn-primary mt-2 ml-2">
							Search
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<ul class="alphas d-flex flex-wrap list-unstyled justify-content-center mt-2">
		@foreach($alphas as $a)
	    <li class="alpha">
	    	<a wire:click="selectAlpha('{{$a}}')" href="javascript:;"
	    		class="page-link {{ ($a == $alpha) ? 'active' : '' }}" >
		    	{{ $a ?: 'ALL'}}
			</a>
		</li>
	    @endforeach
	    {{-- <li class="ml-3">
	    	<a wire:click="resetSearch" href="#" class="page-link reset">
		    	reset
			</a>
	    </li> --}}
	</ul>
	<hr>
	<div class="d-flex flex-wrap d-flex-inline justify-content-center mt-4 mb-5">
		@forelse($doctors as $doctor)
		<div class="card mx-4 mb-4 doctor-card text-center" style="width: 300px;">
			<img src="{{$doctor->getFirstMediaUrl('avatar')}}"
				class="card-img-top mx-auto doctor-thumb" alt="...">
			  	<div class="card-body">
				    <h5 class="card-title mb-1">
				    	<a href="{{ route('doctor-profile', $doctor->slug) }}" target="_blank">
				    		{{ $doctor->display_name }}
				    	</a>
				    </h5>
			        <p class="text-muted">
			        	{{ $doctor->specializations_formatted }}
			        </p>
			        @if($doctor->clinic_days)
			        <p>
			        	{{ $doctor->clinic_days_formatted }}
			        </p>
			        @endif
				    <button wire:click="selectDoctor({{ $doctor->id }})"
				    	class="btn btn-primary"
				    	@if(!$doctor->consultation_duration || !$doctor->consultation_fee)
				    	disabled
				    	@endif
				    	>
				    	Book Appointment
				    </button>
			 	</div>
		</div>
		{{-- <div class="card mx-4" style="max-width: 400px;">
			<div class="row no-gutters">
			    <div class="col-md-4">
			    	<img src="{{$doctor->getFirstMediaUrl('avatar')}}" class="card-img" alt="...">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title mb-1">{{ $doctor->display_name }}</h5>
			        <p class="text-muted">
			        	{{ $doctor->specializations_formatted }}
			        </p>
			        <p class="mb-0">
			        	{{ $doctor->clinic_days_formatted }}
			        </p>
			        <p class="card-text">{{ $doctor->description }}</p>
				    <a wire:click="selectDoctor({{ $doctor->id }})" href="javascript:;"
				    	class="btn btn-primary">
				    	Book Appointment
				    </a>
			      </div>
			    </div>
			</div>
		</div> --}}
		@empty
		<p class="text-center">no results found</p>
		@endforelse
	</div>
</div>
