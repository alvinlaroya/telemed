<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'address',
    'namespace' => 'Api'
], function() {

    Route::get('regions', [
        'as' => 'address.regions',
        'uses' => 'RegionController@all'
    ]);

    Route::get('provinces', [
        'as' => 'address.provinces',
        'uses' => 'ProvinceController@all'
    ]);
    Route::get('provinces/json', [
        'as' => 'address.provinces.json',
        'uses' => 'ProvinceController@allJson'
    ]);

    Route::get('provinces/{regionId}', [
        'as' => 'address.provinces.byRegion',
        'uses' => 'ProvinceController@getByRegion'
    ]);

    Route::get('cities/{provinceId}', [
        'as' => 'address.cities.byProvince',
        'uses' => 'CityController@getByProvince'
    ]);

    Route::get('barangays/{cityId}', [
        'as' => 'address.barangays.byCity',
        'uses' => 'BarangayController@getByCity'
    ]);

});