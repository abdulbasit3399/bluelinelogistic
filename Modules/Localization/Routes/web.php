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

use Illuminate\Support\Facades\Route;


if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
        
        Route::prefix('localization')->group(function() {
            // languages

            Route::resource('/languages', 'LanguageController')->parameters(['languages' => 'id'])->except('create', 'show');
            Route::delete('/languages-multi-destroy', 'LanguageController@multiDestroy')->name('languages.multi-destroy');
            Route::post('/languages/{id}/switch-default', 'LanguageController@switchDefault')->name('languages.switch-default');
            Route::get('/translations/{id}/edit', 'TranslationController@index')->name('translations.edit');
            Route::post('/translations/{lang_code}', 'TranslationController@update')->name('translations.update');
        });
    });
});
}else{
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
        
        Route::prefix('localization')->group(function() {
            // languages

            Route::resource('/languages', 'LanguageController')->parameters(['languages' => 'id'])->except('create', 'show');
            Route::delete('/languages-multi-destroy', 'LanguageController@multiDestroy')->name('languages.multi-destroy');
            Route::post('/languages/{id}/switch-default', 'LanguageController@switchDefault')->name('languages.switch-default');
            Route::get('/translations/{id}/edit', 'TranslationController@index')->name('translations.edit');
            Route::post('/translations/{lang_code}', 'TranslationController@update')->name('translations.update');
        });
    });
}