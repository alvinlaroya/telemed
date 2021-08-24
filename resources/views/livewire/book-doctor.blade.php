@push('styles')
{{--  --}}
@endpush

<div class="{{ $show ?: 'd-none' }}">
	@if($success)
		<p class="text-center">successfully sent booking request!</p>
		<p class="text-center mt-4">
			<button wire:click="backToSearch" type="button" class="btn btn-link">
				<span aria-hidden="true">&laquo;</span> back
			</button>
		</p>
	@else
	<div class="row">
		<div class="col-4 offset-1 d-flex align-items-center">
			@if($doctor)
			<img src="{{$doctor->getFirstMediaUrl('avatar')}}" class="img-thumbnail w-50 mx-auto" alt="...">
			@endif
		</div>
		<div class="col-6">
			<h5>{{ $doctorName }}</h5>
		    <form wire:submit.prevent="submit">
		    	<input type="hidden" wire:model="doctorId">
		    	<input type="hidden" name="gg" value="kids">
		    	{{$date}} {{$time}} <br>
		    	<div class="row">
		    	   	<div class="form-group col-6">
					    <label for="fName">First Name</label>
					    <input type="text" wire:model="fname" class="form-control @error('fname') is-invalid @enderror" id="fName">
					    @error('fname')
					    <div class="invalid-feedback">{{ $message }}</div>
					    @enderror
					</div>
					<div class="form-group col-6">
					    <label for="lname">Last Name</label>
					    <input type="text" wire:model="lname" class="form-control @error('lname') is-invalid @enderror" id="lname">
					    @error('lname')
					    <div class="invalid-feedback">{{ $message }}</div>
					    @enderror
					</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-6">
					    <label for="mobile">Mobile No.</label>
					    <input type="text" wire:model="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile">
					    @error('mobile')
					    <div class="invalid-feedback">{{ $message }}</div>
					    @enderror
					</div>
					<div class="form-group col-6">
					    <label for="email">Email</label>
					    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email">
					    @error('email')
					    <div class="invalid-feedback">{{ $message }}</div>
					    @enderror
					</div>
		    	</div>
				<div class="form-group">
				    <label for="">Complaint</label>
				    <textarea wire:model="complaint" class="form-control @error('complaint') is-invalid @enderror" id="complaint" rows="3"></textarea>
				    @error('complaint')
				    <div class="invalid-feedback">{{ $message }}</div>
				    @enderror
				</div>
				
			    <button type="submit" class="btn btn-primary">Submit</button>
			    <button class="btn btn-light ml-2" wire:click="backToSearch">Cancel</button>
			</form>
		</div>
	</div>
	@endif
</div>

@push('scripts')
<script>
	// $(function() {
	// 	$('.datepicker').pickadate()
	// });
	// document.addEventListener("livewire:load", function(event) {
	// 	window.livewire.hook('afterDomUpdate',  () => {
	// 		console.log('afterDomUpdate');
	// 		setTimeout(() => {
	// 			$('.datepicker').pickadate()
	// 		}, 2500)
	// 	});
	// })
</script>
@endpush
