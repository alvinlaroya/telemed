<?php

// use App\BookingLog;
// use App\BookingService;
// use App\BookingCenter;
// use App\Booking;
// use App\PatientScreening;
// use App\Patient;
// use App\CorporateAccount;
// use Illuminate\Support\Facades\DB;
// use App\Service;
// use App\ServiceCategory;


// Route::get('/ss', function () {
    // $truncate = Model::truncate();
    // $count = Patient::get()->count();
    // dd($count);
    // $test2 = BookingCenter::where('booking_id', 52)->get();
    // $test = Booking::where('booking_reference_no', 4898465)->get();
    // $corpData = array(
    //         ['name' => 'Philippine Airlines'],
    //         ['name' => 'Singapore Airlines'],
    //         ['name' => 'CIGNA'],
    //         ['name' => 'ADB'],
    //         ['name' => 'DBP'],
    //         ['name' => 'PLDT'],
    //         ['name' => 'SGV'],
    //         ['name' => 'MERALCO'],
    //         ['name' => 'SSS'],
    //         ['name' => 'PCSO'],
    //         ['name' => 'Salesian Society of St. John Bosco'],
    //         ['name' => 'OSMAK']);

    // foreach($corpData as $cData) {
    //     $corp = new CorporateAccount;
    //     $corp->name = $cData['name'];
    //     $corp->save();
    // }

    // $media = DB::table('media')->where('model_type', 'App\Booking')->get();

    // dd($media);

    // $servCat = ServiceCategory::where('name', 'LABORATORY')->get();
    // $services = Service::whereDate('updated_at', '2020-12-01')
    //                     ->whereNotIn('category_id', [24, 37, 40, 39, 38, 25, 20, 19, 23])
    //                     ->get();
    // $services2 = Service::where('category_id', 1)->get();
    // foreach($services as $key => $serv) {
        // echo $serv->category->name . ' ******* ' . $serv->name . ' ******* ' . $serv->price . '</br>';
        // echo $serv->category->name . '</br>';
    // }
    // dd($services->count());
    // dd($servCat);

    // return view('homepage');
// });

Route::get('/', function () {
    return view('homepage');
});

Route::get('/covid-home', function () {
    return view('covid-home');
})->name('covid-home');

Route::get('/doctor-home', function () {
    return view('doctor-home');
})->name('doctor-home');

Route::get('/voucher', function () {
    return view('pdf.booking-voucher');
});

Route::get('terms-of-use', function () {
    return view('terms-of-use');
})->name('termsOfUse');

Route::get('privacy-policy', function () {
    return view('privacy-policy');
})->name('privacyPolicy');

Route::get('book-a-service/centers', 'BookingsController@getCenters')->name('getCenters');
Route::get('book-a-service/centers/services', 'BookingsController@getServices')->name('getServices');
Route::get('book-a-service/cities', 'BookingsController@getCities')->name('getCities');
Route::get('book-a-service/provinces', 'BookingsController@getProvinces')->name('getProvinces');

// Route::get('book-a-service', 'BookingsController@bookingServiceView')->name('bookingService');
Route::match(['get', 'post'], 'book-a-service', 'BookingsController@basicInfo')->name('booking-service-patient');
Route::match(['get', 'post'], 'book-a-service/screening', 'BookingsController@screening')->name('booking-service-screening');
Route::match(['get', 'post'], 'book-a-service/fallrisk', 'BookingsController@fallrisk')->name('booking-fallrisk-screening');
Route::match(['get', 'post'], 'book-a-service/services', 'BookingsController@bookingServiceView')->name('bookingService');
Route::match(['get', 'post'], 'book-a-service/step-2', 'BookingsController@centerForms')->name('centerForms');
Route::match(['get', 'post'], 'book-a-service/step-3', 'BookingsController@reviewBooking')->name('reviewBooking');
Route::post('book-a-service/customfields', 'BookingsController@customFields')->name('customFields');

Route::match(['get', 'post'], 'book-a-service/submit', 'BookingsController@store')->name('saveBookingService');
Route::get('book-a-service/payment/{referenceNo}', 'BookingsController@show')->name('bookingService.payment');
Route::get('book-a-service/cancel/{booking}', 'BookingsController@cancel')
->name('servicesBooking.cancel');
Route::get('book-a-service/success', 'BookingsController@paymentSuccess')->name('bookingService.success');
Route::get('book-a-service/failed', 'BookingsController@paymentFailed')->name('bookingService.fail');
Route::get('book-a-service/cancelled', 'BookingsController@paymentCancelled')->name('bookingService.cancel');
// Route::post('asiapay-returned', 'BookingsController@asiapayReturned');
Route::match(['get', 'post'], 'asiapay-returned', 'BookingsController@asiapayReturned');

Route::get('service-screening-form', 'ScreeningFormController@index')->name('service-screening-form');
Route::post('save-service-screening-form', 'ScreeningFormController@saveServiceScreening')->name('save-service-screening-form');
Route::get('fallrisk-screening-form', 'ScreeningFormController@fallrisk')->name('fallrisk-screening-form');
Route::post('save-fallrisk-screening-form', 'ScreeningFormController@saveFallriskScreening')->name('save-fallrisk-screening-form');

Route::get('book-a-service/payment-details', function () {
    return view('booking-payment-return');
})->name('bookingServiceReturn');

Route::get('emergency-notice', function () {
    return view('emergency-page');
})->name('emergencyNotice');

Route::get('teleconsult', function () {
    return view('teleconsult-page');
})->name('teleConsult');

Route::get('thank-you', function () {
    return view('booking-thankyou');
})->name('bookingThankyou');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
