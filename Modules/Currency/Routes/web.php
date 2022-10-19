<?php

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

if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){
            
        Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
            // Currency Routes
            Route::post('/currency/update_default_currency', 'CurrencyController@update_default_currency')->name('currency.update_default_currency');
            Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');
            Route::delete('/currencies-multi-destroy', 'CurrencyController@multiDestroy')->name('currencies.multi-destroy');
            Route::resource('currencies','CurrencyController')->parameters(['currencies' => 'id'])->except('create', 'show');
        });
    });
}else{
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
        // Currency Routes
        Route::post('/currency/update_default_currency', 'CurrencyController@update_default_currency')->name('currency.update_default_currency');
        Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');
        Route::delete('/currencies-multi-destroy', 'CurrencyController@multiDestroy')->name('currencies.multi-destroy');
        Route::resource('currencies','CurrencyController')->parameters(['currencies' => 'id'])->except('create', 'show');
    });
}