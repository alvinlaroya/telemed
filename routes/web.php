<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.index');
    } else if (auth()->user()->isDoctor()) {
        return redirect()->route('doctor.index');
    } else if (auth()->user()->isCenterAdmin()) {
        return redirect()->route('center.index');
    } else if (auth()->user()->isMedicalServices()) {
        return redirect()->route('medical.index');
    } else if(auth()->user()->isSupport()) {
        return redirect()->route('support.index');
    } else if(auth()->user()->isPatient()) {
        return redirect()->route('patient.index');
    } else {
        session()->flush();
        return redirect()->route('login')
                    ->withError('Unauthorized user!');
    }
})->middleware('auth');

require base_path('routes/front.php');

require base_path('routes/web2.php');

require base_path('routes/jrs.php');

// Patient Appointment Screening Routes
Route::get('/patient-screening/{patient}/booking/{booking}', 'PatientScreeningController@reScreeening')->name('re-screening');
Route::post('/patient-screening/{patient}/booking/{booking}', 'PatientScreeningController@reScreeeningSubmit')->name('re-screening-submit');
Route::post('/patient-screening-failed', 'PatientScreeningController@reScreeeningFailed')->name('re-screening-failed');
Route::get('/patient-screening/thank-you', 'PatientScreeningController@thankYou')->name('screening-thankyou');
Route::post('/save-patient-screening-update', 'PatientScreeningController@saveScreeningUpdate')->name('save-patient-screening-update');
Route::post('/save-patient-screening', 'PatientScreeningController@saveScreening')->name('save-patient-screening');
Route::get('patient/{patient}/screening/pdf/{screening}', 'PatientScreeningController@getScreeningPdf')->name('view-patient-screening');
Route::get('patient/{patient}/screening/pdf-2/{screening}', 'PatientScreeningController@getScreeningPdf2')->name('view-patient-screening-2');

// Center Panel Routes
require base_path('routes/center.php');

// Doctor Panel Routes
require base_path('routes/doctor.php');

// Routes for Medical Services
require base_path('routes/medical.php');

// Support Panel Routes
require base_path('routes/support.php');

// Patient Panel Routes
require base_path('routes/patient.php');

Route::post('/wyswyg-upload-image', 'WyswygController@upload')->name('wyswyg.upload-image');

// Admin Routes
Route::middleware(['auth', 'auth.admin'])
    ->namespace('Admin')
	->prefix('admin')
    ->name('admin.')
	->group(function () {

    Route::get('/', 'HomeController@index')->name('index');
    Route::get('diagnostic', 'HomeController@diagnostic')->name('diagnostic');
    Route::get('consultations', 'HomeController@consultations')->name('consultations');
    Route::get('/notifications', 'HomeController@notifications')->name('notifications');
    Route::put('/notification-mark', 'HomeController@markAsRead')->name('notification.mark');

    Route::resource('users', 'UserController');
    Route::resource('doctors', 'DoctorController');
    Route::resource('doctors.secretaries', 'SecretaryController');
    Route::resource('service-categories', 'ServiceCategoryController');
    Route::resource('service-categories.users', 'CenterUserController');
    Route::resource('services', 'ServiceController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('hmo-accreditations', 'HmoAccreditationsController');
    Route::get('settings', 'SettingController@edit')->name('settings');
    Route::put('settings', 'SettingController@update')->name('update-settings');

    Route::get('patients', 'PatientController@index')->name('patients.index');
    Route::get('search', 'PatientController@search')->name('search.patient');

    Route::get('services-booking', 'BookingController@index')->name('servicesBooking');
    Route::get('services-booking/{booking}', 'BookingController@show')->name('servicesBooking.show');

    Route::post('bookings/{booking}/service/{bService}/approved', 'BookingController@serviceApprove')
        ->name('bookings.service.approve');
    Route::post('bookings/{booking}/center/{bCenter}/date-time', 'BookingController@changeDate')
        ->name('bookings.center.datetime');
    Route::post('bookings/{booking}/service/{bService}/complete', 'BookingController@serviceBookingComplete')
        ->name('bookings.service.complete');
    Route::post('bookings/{booking}/service/{bService}/cancel', 'BookingController@serviceBookingCancel')
        ->name('bookings.service.cancel');
    //Route::get('consultations', 'BookingController@consultations')->name('consultations');

    Route::post('services-booking-update/{booking}', 'BookingController@update')->name('servicesBooking.update');
    Route::post('services-booking/approve', 'BookingController@approve')
        ->name('servicesBooking.approve');
    Route::get('services-booking/cancel/{booking}', 'BookingController@cancel')
        ->name('servicesBooking.cancel');
    Route::post('services-booking/{booking}/confirm', 'BookingController@confirm')
        ->name('servicesBooking.confirm');
    Route::post('services-booking/{booking}/complete', 'BookingController@complete')
        ->name('servicesBooking.complete');
    // Route::resource('services-booking', 'BookingsController');

    Route::get('reports/transactions', 'ReportsController@transactions')->name('reports.transactions');
    Route::get('reports/payments', 'ReportsController@payments')->name('reports.payments');
    Route::get('reports/patient-transactions', 'ReportsController@patientTransactions')->name('reports.patientTransactions');
    Route::get('reports/patient-transactions/{patient}', 'ReportsController@patientTransactionDetails')->name('reports.patientTransactionDetails');
    Route::get('reports/center-transactions', 'ReportsController@centerTransactions')->name('reports.centerTransactions');

});

Route::get('admin/doctors/bulk-upload/data', [
    'middleware' => ['auth', 'auth.admin'],
    'as' => 'admin.doctors.bulk-upload.data',
    'uses' => 'Admin\DoctorUploadController@create'
]);

Route::post('admin/doctors/bulk-data/import', [
    'middleware' => ['auth', 'auth.admin'],
    'as' => 'admin.doctors.bulk-data.import',
    'uses' => 'Admin\DoctorUploadController@import'
]);
    
