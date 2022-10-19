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

            Route::prefix('acl')->group(function() {

                Route::resource('/roles', 'AclController')->parameters(['roles' => 'id']);
                Route::delete('/roles-multi-destroy', 'AclController@multiRoleDestroy')->name('roles.multi-destroy');
                // ....
            });

        });
    });
}else{
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

        Route::prefix('acl')->group(function() {

            Route::resource('/roles', 'AclController')->parameters(['roles' => 'id']);
            Route::delete('/roles-multi-destroy', 'AclController@multiRoleDestroy')->name('roles.multi-destroy');
            // ....
        });

    });
}
