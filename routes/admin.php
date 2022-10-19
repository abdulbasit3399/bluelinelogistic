<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/installation/step6', 'InstallController@step6')->name('installation.step6');

if(env('INSTALLATION', false) == true){
    if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
        Route::group(
            [
                'prefix' => LaravelLocalization::setLocale(),
                'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
            ], function(){

            Route::group(['prefix' => env('PREFIX_ADMIN', 'admin')], function () {

                // Route::get('/link-storage', function () {
                //     \Artisan::call('storage:link');
                // });

                // auth routes
                require __DIR__.'/auth.php';


                Route::middleware('auth')->namespace('Admin')->group(function () {
                    Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
                    Route::post('/dashboard', 'HomeController@store');
                    // Settings routes
                    Route::get('/settings/general', 'SettingsController@index')->name('admin.settings');
                    Route::put('/settings/general', 'SettingsController@update')->name('setting.update');
                    Route::get('/settings/notifications', 'NotificationsSettingsController@index')->name('admin.settings.notifications');
                    Route::put('/settings/notifications', 'NotificationsSettingsController@update')->name('notificationsetting.update');

                    Route::get('/settings/google', 'GoogleSettingsController@index')->name('admin.settings.google');
                    Route::put('/settings/google', 'GoogleSettingsController@update')->name('googlesetting.update');


                    Route::get('/settings/active-theme', 'ThemeSettingController@defaultTheme')->name('default-theme.edit');
                    Route::post('/settings/active-theme', 'ThemeSettingController@activeTheme')->name('active-theme.edit');

                    Route::get('/settings/theme/{place}', 'ThemeSettingController@edit')->name('theme-setting.edit');
                    Route::put('/settings/theme/{place}', 'ThemeSettingController@update')->name('theme-setting.update');


                    Route::get('/notifications', 'NotificationsSettingsController@notifications')->name('notifications');
                    Route::get('/notifications/{id}', 'NotificationsSettingsController@notification')->name('notification.view');

                    Route::get('/system-update', 'SystemController@getSystemUpdate')->name('system.update');
                    Route::post('/system-update', 'SystemController@postSystemUpdate')->name('post.system.update');

                    Route::post('/import-demo', 'ThemeSettingController@importDemo')->name('import.demo');
                    // Global routes
                });

                if(env('INSTALLATION', false) == true){
                    if(env('IMPORT_OLD_DATABASE', false) == true){
                        Route::namespace('Admin')->group(function () {

                            // Global routes
                            Route::get('database/step0', 'HomeController@step0');
                            Route::get('database/step1', 'HomeController@step1')->name('step1');
                            Route::get('database/step2', 'HomeController@step2')->name('step2');
                            Route::get('database/step3/{error?}', 'HomeController@step3')->name('step3');
                            Route::get('database/step4', 'HomeController@step4')->name('step4');
                            Route::get('database/step5', 'HomeController@step5')->name('step5');

                            Route::post('database/database_installation', 'HomeController@database_installation')->name('install.db');
                            Route::get('import_sql', 'HomeController@import_sql')->name('import_sql');
                            Route::post('system_settings', 'HomeController@system_settings')->name('system_settings');
                            Route::post('purchase_code', 'HomeController@purchase_code')->name('purchase.code');
                        });
                    }
                }
            });
        });
    }else{
        Route::group(['prefix' => env('PREFIX_ADMIN', 'admin')], function () {

            // Route::get('/link-storage', function () {
            //     \Artisan::call('storage:link');
            // });

            // auth routes
            require __DIR__.'/auth.php';


            Route::middleware('auth')->namespace('Admin')->group(function () {
                Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
                // Settings routes
                Route::get('/settings/general', 'SettingsController@index')->name('admin.settings');
                Route::put('/settings/general', 'SettingsController@update')->name('setting.update');
                Route::get('/settings/notifications', 'NotificationsSettingsController@index')->name('admin.settings.notifications');
                Route::put('/settings/notifications', 'NotificationsSettingsController@update')->name('notificationsetting.update');

                Route::get('/settings/active-theme', 'ThemeSettingController@defaultTheme')->name('default-theme.edit');
                Route::post('/settings/active-theme', 'ThemeSettingController@activeTheme')->name('active-theme.edit');

                Route::get('/settings/theme/{place}', 'ThemeSettingController@edit')->name('theme-setting.edit');
                Route::put('/settings/theme/{place}', 'ThemeSettingController@update')->name('theme-setting.update');


                Route::get('/notifications', 'NotificationsSettingsController@notifications')->name('notifications');
                Route::get('/notifications/{id}', 'NotificationsSettingsController@notification')->name('notification.view');

                Route::get('/system-update', 'SystemController@getSystemUpdate')->name('system.update');
                Route::post('/system-update', 'SystemController@postSystemUpdate')->name('post.system.update');

                Route::post('/import-demo', 'ThemeSettingController@importDemo')->name('import.demo');
                // Global routes
            });

        });

        if(env('INSTALLATION', false) == true){
            if(env('IMPORT_OLD_DATABASE', false) == true){
                Route::namespace('Admin')->group(function () {

                    // Global routes
                    Route::get('database/step0', 'HomeController@step0');
                    Route::get('database/step1', 'HomeController@step1')->name('step1');
                    Route::get('database/step2', 'HomeController@step2')->name('step2');
                    Route::get('database/step3/{error?}', 'HomeController@step3')->name('step3');
                    Route::get('database/step4', 'HomeController@step4')->name('step4');
                    Route::get('database/step5', 'HomeController@step5')->name('step5');

                    Route::post('database/database_installation', 'HomeController@database_installation')->name('install.db');
                    Route::get('import_sql', 'HomeController@import_sql')->name('import_sql');
                    Route::post('system_settings', 'HomeController@system_settings')->name('system_settings');
                    Route::post('purchase_code', 'HomeController@purchase_code')->name('purchase.code');
                });
            }
        }
    }
}
