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

if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){

        Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
            Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');
            Route::resource('/users', 'UsersController')->parameters(['users' => 'id']);

            Route::delete('/users-multi-destroy', 'UsersController@multiDestroy')->name('users.multi-destroy');
            Route::get('/users/{id}/manage-access', 'UsersController@assignPermissionToUserView')->name('users.view-manage-access');
            Route::post('/users/{id}/manage-access', 'UsersController@assignPermissionToUser')->name('users.manage-access');
        });
    });
}else{
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
        Route::resource('/users', 'UsersController')->parameters(['users' => 'id']);
        Route::delete('/users-multi-destroy', 'UsersController@multiDestroy')->name('users.multi-destroy');
        Route::get('/users/{id}/manage-access', 'UsersController@assignPermissionToUserView')->name('users.view-manage-access');
        Route::post('/users/{id}/manage-access', 'UsersController@assignPermissionToUser')->name('users.manage-access');
    });
}
