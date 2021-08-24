<?php

Route::middleware(['auth', 'auth.doctor'])
    ->namespace('Doctor')
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {

        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/notifications', 'HomeController@notifications')->name('notifications');
        Route::put('/notification-mark', 'HomeController@markAsRead')->name('notification.mark');
        Route::get('/notification-mark-all', 'HomeController@markAllAsRead')->name('notification.mark-all');

        Route::get('{doctor}/profile/{type}', 'DoctorController@edit')->name('profile');
        Route::put('{doctor}/profile/{type}', 'DoctorController@update')->name('update-profile');
        Route::resource('specializations', 'SpecializationController');
        Route::resource('hmo-accreditations', 'HmoAccreditationsController');
        Route::get('calendar', 'CalendarController@index')->name('calendar');
        Route::get('calendar/fetch', 'CalendarController@fetch')->name('calendar-fetch');
        Route::resource('users', 'UserController');

        Route::get('schedule', 'ScheduleController@index')->name('schedule');
        Route::get('schedule/weekly', 'ScheduleController@weekSchedule');
        Route::post('schedule/{schedule}/update', 'ScheduleController@update');
        Route::delete('schedule/{schedule}', 'ScheduleController@deleteShift');
        Route::post('schedule/{doctor}/set-working', 'ScheduleController@setWorking');
        Route::post('schedule/week-copy', 'ScheduleController@weeklyCopySchedule');
        Route::post('schedule/{schedule}/update-status/{leave?}', 'ScheduleController@updateStatus');

        Route::post('appointments/{consultation}/approve', 'ConsultationController@approve')
            ->name('appointments.approve');
        Route::post('appointments/{consultation}/reschedule', 'ConsultationController@reschedule')
            ->name('appointments.reschedule');
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
        Route::get('appointments/edit/{consultation}', 'ConsultationController@edit')
            ->name('appointments.edit');
        Route::put('appointments/edit/{consultation}', 'ConsultationController@editSave')
            ->name('appointments.edit-save');
        Route::delete('appointments/{consultation}/media/{media}', 'ConsultationController@removeMedia')
            ->name('appointments.media.remove');
        Route::get('appointments/{consultation}', 'ConsultationController@show')->name('appointments.show');
        Route::get('appointments', 'ConsultationController@index')->name('appointments');

        Route::get('appointments/{consultation}/homevisit', [
            'as' => 'appointments.homevisit',
            'uses' => 'OrderHomeVisitController@create'
        ]);

        Route::post('search/by-specialization-and-location', [
            'as' => 'search.bySpecializationAndLocation',
            'uses' => 'OrderHomeVisitController@doctorSearchBySpecializationAndLocation'
        ]);

        Route::get('{doctorId}/appointments/doctor/schedules/date', [
            'as' => 'schedule.date',
            'uses' => 'OrderHomeVisitController@getDoctorScheduleDate'
        ]);

        Route::get('{doctorId}/appointments/doctor/schedule/date/{date}/time', [
            'as' => 'schedule.time',
            'uses' => 'OrderHomeVisitController@getDoctorScheduleTime'
        ]);

        Route::post('homevisit/store', [
            'as' => 'homevisit.store',
            'uses' => 'OrderHomeVisitController@store'
        ]);

        Route::get('package/{packageId}/view', [
            'as' => 'homevisit.package.view',
            'uses' => 'OrderHomeVisitController@viewPackage'
        ]);

    });

Route::post('terms-and-conditions/agree/doctor', [
    'as' => 'doctor.terms-and-conditions.agree',
    'uses' => 'DoctorController@agreeToTermsAndCondition'
]);
