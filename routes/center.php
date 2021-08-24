<?php

Route::middleware(['auth', 'auth.center-admin'])->namespace('Center')
	->prefix('center')->name('center.')
	->group(function () {

    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/notifications', 'HomeController@notifications')->name('notifications');
    Route::put('/notification-mark', 'HomeController@markAsRead')->name('notification.mark');
    Route::get('/notification-mark-all', 'HomeController@markAllAsRead')->name('notification.mark-all');

    Route::get('bookings', 'BookingController@index')->name('bookings');
    Route::post('bookings/{booking}/center/{bCenter}/date-time', 'BookingController@changeDate')
        ->name('bookings.center.datetime');
    Route::get('bookings/{booking}', 'BookingController@show')->name('bookings.details');
    Route::post('bookings/{booking}/service/{bService}/approved', 'BookingController@approve')
    	->name('bookings.service.approve');
    Route::post('bookings/{booking}/service/{bService}/confirm', 'BookingController@confirm')
        ->name('bookings.service.confirm');
    Route::post('bookings/{booking}/service/{bService}/complete', 'BookingController@complete')
        ->name('bookings.service.complete');
    Route::post('bookings/{booking}/service/{bService}/cancel', 'BookingController@cancel')
    	->name('bookings.service.cancel');
    Route::post('bookings/{booking}/send-patient-documents', 'BookingController@sendPatientDocuments')
        ->name('bookings.send.documents');
    Route::delete('bookings/{booking}/media/{media}', 'BookingController@removeMedia')
    ->name('bookings.media.remove');

    Route::post('bookings/{booking}/resend-email', 'BookingController@resendPaymentEmail')
        ->name('bookings.resend_email');

    //SERVICES ROUTE
    Route::get('services', 'ServicesController@index')->name('servicePrices');

    Route::get('custom-form', 'CustomFieldsController@index')
        ->name('custom-fields');
    Route::get('cf-centers', 'CustomFieldsController@centerLists')->name('cf-centers');
    Route::post('custom-forms/{center}/save', 'CustomFieldsController@save')
        ->name('custom-fields.save');

    Route::get('reports/transactions', 'ReportsController@transactions')->name('reports.transactions');
    Route::get('reports/payments', 'ReportsController@payments')->name('reports.payments');
    Route::get('reports/audit-log', 'ReportsController@auditLogs')->name('reports.auditlog');

    Route::get('settings', 'SettingController@index')->name('settings');
    Route::put('settings/update-account', 'SettingController@updateAccount')
        ->name('settings.save-account');
    Route::put('settings/update', 'SettingController@update')
        ->name('settings.save');

});
