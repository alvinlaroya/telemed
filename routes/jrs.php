<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| JR Routes for Backend and Frontend
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->namespace('Admin')
	->prefix('admin')->name('admin.')
	->group(function () {

    Route::get('form/service', 'DynamicForm@service')->name('form.service');
    Route::get('form/doctors', 'DynamicForm@doctors')->name('form.doctors');
    Route::post('form/add-question', 'DynamicForm@saveQuestion')->name('form.add-question');
    
    Route::get('service-categories/{center}/forms', 'CenterCustomFieldsController@index')
    	->name('center.custom-fields');
    Route::post('service-categories/{center}/forms', 'CenterCustomFieldsController@save')
    	->name('center.custom-fields.save');

    Route::get('sms-notifications', 'SmsNotificationsController@smsSettings')->name('sms-notifications');
    Route::post('sms-notifications', 'SmsNotificationsController@smsSettingsUpdate')->name('sms-notifications.save');
});

Route::get('service-form', 'AppointmentController@serviceForm')->name('serviceFormDynamic');
Route::post('service-form', 'AppointmentController@serviceFormSave')->name('serviceFormDynamic.save');
Route::get('doctors-form', 'AppointmentController@doctorsForm')->name('doctorsFormDynamic');
Route::post('doctors-form', 'AppointmentController@doctorsFormSave')->name('doctorsFormDynamic.save');
