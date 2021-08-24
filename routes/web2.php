<?php

use Illuminate\Support\Arr;

// Route::livewire('/book-doctor', 'book-doctor');
Route::get('book-a-doctor', 'DoctorController@booking')->name('book-doctor');
Route::get('book-a-doctor/on-behalf-of-patient/{patient_id}', 'DoctorController@bookingOnBehalfOfPatient')->name('book-doctor-on-behalf-of-patient');
Route::get('book-a-lab/on-behalf-of-patient/{patient_id}', 'DoctorController@bookingLabOnBehalfOfPatient')->name('book-lab-on-behalf-of-patient');
Route::get('book-a-doctor/{doctor}/appointment', 'DoctorController@makeAppointment')
    ->name('make-appointment');
Route::get('book-a-doctor/{slug}', 'DoctorController@profile')->name('doctor-profile');

Route::post('book-a-doctor/store', 'AppointmentController@bookDoctor')
    ->name('book-doctor.save');

Route::post('book-a-doctor/checkEmail', 'AppointmentController@checkEmail')
    ->name('appointment.check.email');

Route::get('appointment/{consultation}/details', 'AppointmentController@details')
    ->name('appointment.details');
Route::post('appointment/{consultation}/upload', 'AppointmentController@upload')
    ->name('appointment.upload');
Route::delete('appointment/{consultation}/media/{media}', 'AppointmentController@rmMedia')
    ->name('appointment.media.remove');

Route::put('appointment/{consultation}', 'AppointmentController@update')
    ->name('appointment.update');

// these routes are for patient dashboard
Route::group([
    'prefix' => 'patient/appointment'
], function() {
    Route::get('{consultation}/details', [
        'as' => 'appointment.patient.details',
        'uses' => 'AppointmentPatientController@details'
    ]);
    Route::post('{consultation}/upload', [
        'as' => 'appointment.patient.upload',
        'uses' => 'AppointmentPatientController@upload'
    ]);
    Route::delete('{consultation}/media/{media}', [
        'as' => 'appointment.patient.media.remove',
        'uses' => 'AppointmentPatientController@rmMedia'
    ]);
});

Route::get('enrollment-form', 'DownloadFormController@downloadEnrollmentForm')->name('download.enrollment.form');

Route::put('appointment/{consultation}', 'AppointmentPatientController@update')
    ->name('appointment.update');

Route::middleware(['auth'])->namespace('Admin')
	->prefix('admin')->name('admin.')
	->group(function () {

    Route::get('schedules', 'ScheduleController@index')->name('schedules');
    Route::post('schedules', 'ScheduleController@saveSchedule');
    Route::get('schedules/daily', 'ScheduleController@dailySchedule');
    Route::get('schedules/weekly', 'ScheduleController@weekSchedules');
    Route::post('schedules/{schedule}/update', 'ScheduleController@update');
    Route::post('schedules/daily-copy', 'ScheduleController@dailyCopySchedule');
    Route::post('schedules/week-copy', 'ScheduleController@weeklyCopySchedule');
    Route::post('schedules/{doctor}/set-working', 'ScheduleController@setWorking');
    Route::post('schedules/bulk-update-status', 'ScheduleController@bulkUpdateStatus');
    Route::post('schedules/{schedule}/update-status/{leave?}', 'ScheduleController@updateStatus');

    Route::get('schedule/weekly', 'DoctorScheduleController@weekSchedule');
    Route::post('schedule/{schedule}/update', 'DoctorScheduleController@update');
    Route::delete('schedule/{schedule}', 'DoctorScheduleController@deleteShift');
    Route::post('schedule/{doctor}/set-working', 'DoctorScheduleController@setWorking');
    Route::post('schedule/week-copy', 'DoctorScheduleController@weeklyCopySchedule');
    Route::post('schedule/{schedule}/update-status/{leave?}', 'DoctorScheduleController@updateStatus');

    Route::get('leaves', 'LeaveController@index')->name('leaves');

    Route::post('appointments/{consultation}/approve', 'ConsultationController@approve')
        ->name('appointments.approve');
    Route::post('appointments/{consultation}/paid', 'ConsultationController@markPaid')
        ->name('appointments.markPaid');
    Route::post('appointments/{consultation}/confirm', 'ConsultationController@confirm')
        ->name('appointments.confirm');
    Route::post('appointments/{consultation}/complete', 'ConsultationController@complete')
        ->name('appointments.complete');
    Route::post('appointments/{consultation}/cancel', 'ConsultationController@cancel')
        ->name('appointments.cancel');
    Route::put('appointments/{consultation}', 'ConsultationController@update')
        ->name('appointments.update');
    Route::delete('appointments/{consultation}/media/{media}', 'ConsultationController@removeMedia')
        ->name('appointments.media.remove');
    Route::get('appointments/{consultation}', 'ConsultationController@show')->name('appointments.show');
    Route::get('appointments', 'ConsultationController@index')->name('appointments');

});
