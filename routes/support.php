<?php

// Support Routes
Route::middleware(['auth', 'auth.support-role'])->namespace('Support')
	->prefix('support')->name('support.')
	->group(function () {

    Route::get('/', 'HomeController@index')->name('index');

    Route::get('reports/transactions', 'ReportsController@transactions')->name('reports.transactions');
});
