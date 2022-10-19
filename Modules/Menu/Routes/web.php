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

            Route::get('/menus', 'MenuController@index')->name('menus.index');
            Route::post('/create-new-menu', 'MenuController@createNewMenu')->name('menus.create');
            Route::post('/create-new-menu-item', 'MenuController@addMenuItem')->name('menu_items.create');
            Route::post('/update-item', 'MenuController@generatemenucontrol')->name('menu_items.updae');
            
        });
    });
}else{
    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

        Route::get('/menus', 'MenuController@index')->name('menus.index');
        Route::post('/create-new-menu', 'MenuController@createNewMenu')->name('menus.create');
        Route::post('/create-new-menu-item', 'MenuController@addMenuItem')->name('menu_items.create');
        Route::post('/update-item', 'MenuController@generatemenucontrol')->name('menu_items.updae');
        
    });
}
