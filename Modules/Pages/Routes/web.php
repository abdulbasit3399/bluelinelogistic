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
            
        Route::group(['namespace' => 'Front'], function () {
            // pages
            Route::get('/page/{slug}', 'PageController@show')->name('page-page');
        });

        Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

                // pages
                Route::resource('/pages', 'PageController')->parameters(['pages' => 'id']);
                Route::delete('/pages-multi-destroy', 'PageController@multiDestroy')->name('pages.multi-destroy');
                Route::get('/pages-search', 'PageController@searchPages')->name('pages.search');
                Route::get('/static-pages-search', 'PageController@searchStaticPages')->name('static_pages.search');

        });
    });
}else{
    Route::group(['namespace' => 'Front'], function () {
        // pages
        Route::get('/page/{slug}', 'PageController@show')->name('page-page');
    });

    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

            // pages
            Route::resource('/pages', 'PageController')->parameters(['pages' => 'id']);
            Route::delete('/pages-multi-destroy', 'PageController@multiDestroy')->name('pages.multi-destroy');
            Route::get('/pages-search', 'PageController@searchPages')->name('pages.search');
            Route::get('/static-pages-search', 'PageController@searchStaticPages')->name('static_pages.search');

    });
}