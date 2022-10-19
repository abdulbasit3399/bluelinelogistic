<?php

use Illuminate\Http\Request;
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

// Admin routes
require __DIR__.'/admin.php';

if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){
            
        // home
        Route::get('/', 'HomeController@index')->name('home');

        if(env('DEMO_MODE') == 'On'){
            Route::get('/theme', 'HomeController@index')->name('theme.demo.home');
        }

        Route::get('/link-storage', function () {
            Artisan::call('storage:link');
        });
    });
    Route::mediaLibrary();
}else{
    // home
    Route::get('/', 'HomeController@index')->name('home');

    if(env('DEMO_MODE') == 'On'){
        Route::get('/theme', 'HomeController@index')->name('theme.demo.home');
    }

    Route::get('/link-storage', function () {
        Artisan::call('storage:link');
    });
    Route::mediaLibrary();
}
