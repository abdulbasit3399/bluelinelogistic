<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| This route is responsible for handling the intallation process
|
|
|
*/


Route::get('/', 'InstallController@step0')->name('installation');
Route::get('/installation/step1', 'InstallController@step1')->name('installation.step1');
Route::get('/installation/step2', 'InstallController@step2')->name('installation.step2');
Route::get('/installation/step3/{error?}', 'InstallController@step3')->name('installation.step3');
Route::get('/installation/step4', 'InstallController@step4')->name('installation.step4');
Route::get('/installation/step5', 'InstallController@step5')->name('installation.step5');

Route::post('/installation/database_installation', 'InstallController@database_installation')->name('installation.install.db');
Route::get('/installation/import_sql', 'InstallController@import_sql')->name('installation.import_sql');
Route::post('/installation/system_settings', 'InstallController@system_settings')->name('installation.system_settings');
Route::post('/installation/purchase_code', 'InstallController@purchase_code')->name('installation.purchase.code');