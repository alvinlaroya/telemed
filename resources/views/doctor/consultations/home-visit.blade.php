@extends('layouts.doctor')
@push('custom-styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/themes/classic.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/themes/classic.date.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/themes/classic.time.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css">
	<style>
		body { display: none; }
		#btnSubmit { text-transform: none; font-weight: 100; }
	</style>
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Order Home Visit</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">
		Order Home Visit
	</h1>
</div>

<div class="container" id="patientForm">
	<div class="row">

		{{-- <div class="form-group col">
			<label for="consultationType">Region</label>
			<select class="form-control" id="region">
				<option></option>
				@foreach($regions as $region)
					<option value="{{ $region->region_id }}">{{ $region->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col">
			<label for="consultationType">Province</label>
			<select class="form-control" id="province" disabled=""></select>
		</div>
		--}}
		
		<div class="form-group col-md-6">
			<label for="consultationType">City</label>
			<select id="city">
				<option></option>
				@foreach($cities as $city)
					<option value="{{ $city->city_id }}">
						{{ $city->name }}, {{ $city->province->name }}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<button type="button" class="btn btn-outline-secondary" id="btnSearchDoctor">
			<span class="fa fa-search"></span> Search Doctor
		</button>
	</div>

	<div id="doctorContainer" class="mt-4 pt-4 border-top">
		<div class="row">
			<div class="form-group col">
				<label for="doctor">Doctor*</label>
				<select name="doctor" id="doctor" class="form-control"></select>
			</div>
			<div class="form-group col">
				<input type="hidden" id="dateInput">
				<label for="date">Date*</label>
				<input type="text" id="date" class="form-control datepicker" readonly="">
			</div>
			<div class="form-group col">
				<label for="time">Time*</label>
				<input type="text" id="time" class="form-control timepicker" readonly="">
			</div>
		</div>
	</div>

	<div id="packageContainer">
		<div class="row">
			<div class="form-group col-md-4">
				<label for="package">Package*</label>
				<select name="package" id="package" class="form-control">
					<option></option>
					@if(count($packages) > 0)
						@foreach($packages as $package)
							<option value="{{ $package->id }}">{{ $package->name }}</option>
						@endforeach
					@endif
				</select>
			</div>
			<div class="col-md-4 d-flex align-items-center mt-3">
				<small class="d-none view-package-catalog">
					<a href="#" target="_blank">View package contents and price</a>
				</small>
			</div>
		</div>
	</div>

	<div class="form-group">
		<button type="button" class="btn btn-primary text-ucwords" id="btnSubmit">Submit</button>
	</div>
</div>
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/picker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/picker.date.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.2/picker.time.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
	<script>
		$(function() {
			$('body').css('display', 'block')

			$('#city').selectize({ placeholder: 'Select City' })

			$('#doctor').select2({ placeholder: '-- Select Doctor --', allowClear: false})
			$('#package').select2({ placeholder: '-- Select Package --', allowClear: false})

			/*
			$('#region').select2({ placeholder: '-- Select Region --', allowClear: false})
			$('#province').select2({ placeholder: '-- Select Province --', allowClear: false})

			$(document).on('change', '#region', function(){
				$('#province').prop('disabled', true)

				$('#city').val(null).trigger('change')
				$('#city').prop('disabled', true)

				$.ajax({
					url: '/api/address/provinces/' + $(this).val(),
					method: 'get',
					dataType: 'json',
					success: function(provinces) {
						let selectData = '<option></option>'

						for(let provinceCount = 0; provinceCount < provinces.length; provinceCount++) {
							selectData += `
								<option value=" ${provinces[provinceCount].province_id }">${ provinces[provinceCount].name }</option>
							`
						}

						$('#province').html(selectData)
						$('#province').removeAttr('disabled')
					},
					error: function(response) {}
				})
			})

			$(document).on('change', '#province', function(){
				$('#city').prop('disabled', true)

				$.ajax({
					url: '/api/address/cities/' + $(this).val().trim(),
					method: 'get',
					dataType: 'json',
					success: function(cities) {
						let selectData = '<option></option>'

						for(let cityCount = 0; cityCount < cities.length; cityCount++) {
							selectData += `
								<option value=" ${cities[cityCount].city_id }">${ cities[cityCount].name }</option>
							`
						}

						$('#city').html(selectData)
						$('#city').removeAttr('disabled')
					},
					error: function(response) {}
				})
			})
			*/

			$(document).on('click', '#btnSearchDoctor', function(){
				let city = $('#city').val() || null

				// EMPTY THE DATE AND TIME FIELD
				$('#date').val('')
				$('#time').val('')

				if(city == null) {
					alert('You need to complete the location filter.')
					return false
				}

				$.ajax({
					url: '{{ route("doctor.search.bySpecializationAndLocation") }}',
					method: 'post',
					dataType: 'json',
					data: {
						_token: $('meta[name=csrf-token]').attr('content'),
						city: city
					},
					success: function(response) {
						let doctors = response.doctors

						if(doctors.length > 0) {
							let selectData = '<option></option>'

							for(let doctorCount = 0; doctorCount < doctors.length; doctorCount++) {
								selectData += `
									<option value="${doctors[doctorCount].id }">${ doctors[doctorCount].first_name } ${ doctors[doctorCount].last_name }</option>
								`
							}
							
							$('#doctor').html(selectData)
						}
					},
					error: function(response) {}
				})
			})

			$(document).on('change', '#doctor', function(){
				let doctorId = $(this).val() || 0

				$.ajax({
					url: '/doctor/' + doctorId + '/appointments/doctor/schedules/date',
					method: 'get',
					dataType: 'json',
					success: function(response) {
						let dates = Object.values(response.dates)

						if(dates.length > 0) {

							let formattedDates = dates.map((date) => {
								return new Date(date)
							})

							formattedDates.unshift(true)

							$('.datepicker').pickadate({
								disable: formattedDates,
								onSet: function(dateContext) {

									let formattedDate = new Date(dateContext.select).toLocaleDateString('fr-CA')
									
									$.ajax({
										url: '/doctor/' + doctorId + '/appointments/doctor/schedule/date/' + formattedDate + '/time',
										method: 'get',
										dataType: 'json',
										success: function(response) {

											let times = response.times
											let formattedTimes = times.map((date) => {
												return new Date(date)
											})

											formattedTimes.unshift(true)

											$('.timepicker').pickatime({
												disable: formattedTimes,
												interval: 60
											})

										},
										error: function(response) {}
									})

								}
							})
							
						}
					},
					error: function(response) {}
				})

			})

			$(document).on('click', '#btnSubmit', function() {
				let doctorId = $('#doctor').val() || null
				let date = $('#date').val() || null
				let time = $('#time').val() || null
				let packageId = $('#package').val() || null

				if(doctorId == null || date == null || time == null || packageId == null) {
					alert('Please fill out all the required fields.')
					return false
				}

				$(this).html('Please wait...')
				$(this).prop('disabled', true)

				$.ajax({
					url: '{{ route("doctor.homevisit.store") }}',
					method: 'post',
					dataType: 'json',
					data: {
						_token: $('meta[name=csrf-token]').attr('content'),
						appointmentId: '{{ $consultation }}',
						doctorId: doctorId,
						date: date,
						time: time,
						packageId: packageId
					},
					success: function(response) {
						if(response.status == 200) {
							window.location = response.redirectURL
						}
					},
					error: function(response) {}
				})
			})

			$(document).on('change', '#package', function(){
				let viewPackageLink = $('.view-package-catalog')
				let URL = '/doctor/package/' + $(this).val() + '/view'
				
				if(viewPackageLink.hasClass('d-none')) {
					viewPackageLink.removeClass('d-none')
				}
				
				viewPackageLink.find('a').attr('href', URL)
			})
			
		})

	</script>
@endpush
