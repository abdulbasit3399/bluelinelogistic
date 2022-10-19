<?php

namespace App\Providers;

use App\Services\Locale\Singletons;
use App\Services\Hook\HookSingletons;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Qirolab\Theme\Theme;
use Barryvdh\Debugbar\Facade as Debugbar;
use Nwidart\Modules\Facades\Module;
use Modules\Localization\Entities\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ThemeServiceProvider::class);
        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Theme::set('html');
        // Theme::clear();


        // Debugbar::enable();
        if (env('APP_ENV') != 'local') {
            Debugbar::disable();
        }

        

        (new Singletons)->customSingleTons();
        (new HookSingletons)->customSingleTons();

        if(env('INSTALLATION', false) == true){
            if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
                if (Language::count()) {
                    $newLocales = array();
                    $locales = array();
                    foreach (Language::all() as $key => $language){
                        $locales[$language->code] = $language->name;
                        $newLocales[$language->code] = ['name' => $language->name, 'script' => $language->script, 'native' => $language->native, 'regional' => $language->regional];
                    }
                    \Illuminate\Support\Facades\Config::set('cms.langauges', $locales);
                    \Illuminate\Support\Facades\Config::set('laravellocalization.supportedLocales', $newLocales);
                }
            }

            \Config::set('langauges_except_current', get_langauges_except_current());
            \Config::set('current_lang', get_current_lang()); 
            \Config::set('current_lang_image', get_current_lang_image());
            \Config::set('DIRECTORY_IMAGE', 'public/setting_images');

            // create custom directive
            Blade::if('admin', function () {
                return auth()->user()->role == 1;
            });
            Blade::if('checkModule', function ($module_name) {
                return check_module($module_name);
            });
        }
    }
}