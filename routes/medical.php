<?php

Route::middleware(['auth.medical'])->namespace('Medical')
	->prefix('medical-services')->name('medical.')
	->group(function () {

	Route::get('/', 'HomeController@index')->name('index');
	Route::livewire('doctors', 'medical-doctors')->layout('layouts.medical')->name('doctors');
	// Route::get('doctors', 'DoctorsController@index')->name('doctors');

    Route::resource('specializations', 'SpecializationController');
    Route::resource('hmo-accreditations', 'HmoAccreditationsController');

	Route::get('doctors/{doctor}/schedule', 'DoctorsController@schedule')->name('doctors.schedule');
    Route::get('doctors/{doctor}/profile', 'DoctorsController@profile')->name('doctors.profile');
    Route::put('doctors/{doctor}/profile', 'DoctorsController@update')->name('doctors.profile.update');

    Route::get('doctors/{doctor}/schedule/weekly', 'ScheduleController@weekSchedule');
    Route::post('doctors/{doctor}/schedule/{schedule}/update', 'ScheduleController@update');
    Route::delete('doctors/{doctor}/schedule/{schedule}', 'ScheduleController@deleteShift');
    Route::post('doctors/{doctor}/schedule/{doc}/set-working', 'ScheduleController@setWorking');
    Route::post('doctors/{doctor}/schedule/week-copy', 'ScheduleController@weeklyCopySchedule');
    Route::post('doctors/{doctor}/schedule/{schedule}/update-status/{leave?}',
    	'ScheduleController@updateStatus');

});
