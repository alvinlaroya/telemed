<?php

Route::middleware('auth', 'auth.patient')->namespace('Patient')
    ->prefix('patient')->name('patient.')
    ->group(function() {

    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/appointments', 'HomeController@appointments')->name('appointments');
    Route::get('/calendar', 'HomeController@calendar')->name('calendar');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/forms', 'HomeController@forms')->name('forms');
    Route::get('calendar/fetch', 'CalendarController@fetch')->name('calendar-fetch');
    Route::get('appointments', 'ConsultationController@index')->name('appointments');
    Route::get('labs_diagnostic/appointments', 'ConsultationController@index')->name('labs.diagnostic.appointments');
    Route::get('appointments/{consultation}', 'ConsultationController@show')->name('appointments.show');
    Route::get('view', 'DownloadFormController@viewChiefComplaint')->name('view.chief.complaint');
    Route::get('/download/cheif-complaint', 'DownloadFormController@downloadChiefComplaint')->name('download.chief.complaint');
    Route::get('/download/medical-history', 'DownloadFormController@downloadMedicalHistory')->name('download.medical.history');
    Route::get('/download/form-for-it', 'DownloadFormController@downloadFormForIT')->name('download.forms.it');
    Route::get('reports/transactions', 'ReportsController@transactions')->name('reports.transactions');
    Route::get('services-booking', 'BookingController@index')->name('servicesBooking');
    Route::get('services-booking/{booking}', 'BookingController@show')->name('servicesBooking.show');
    Route::post('bookings/{booking}/send-patient-documents', 'BookingController@sendPatientDocuments')
        ->name('bookings.send.documents');
    Route::delete('bookings/{booking}/media/{media}', 'BookingController@removeMedia')
        ->name('bookings.media.remove');
    Route::post('profile/update', 'ProfileController@updateProfile')
    ->name('profile.update');
});