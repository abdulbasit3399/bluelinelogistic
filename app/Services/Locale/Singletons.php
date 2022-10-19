<?php
namespace App\Services\Locale;

use Illuminate\Support\Facades\Blade;
use Modules\Localization\Entities\Translation;

class Singletons {


    public function customSingleTons()
    {
         // translations
         app()->singleton('locale', function () {
            $translationLocaleService = new TranslationService();
            $languages = languages();
            $default_lang = $languages->first(function($lang) { return $lang->is_default; });
            $current_locale = $languages->first(function($lang) { return $lang->code == (app()->getLocale() ? app()->getLocale() : 'en'); });
            $translationLocaleService->share('languages', $languages);
            $translationLocaleService->share('default_lang', $default_lang);
            $translationLocaleService->share('current_locale', $current_locale);
            return $translationLocaleService;
        });

        app()->singleton('translation', function () {
            $translationWordsService = new TranslationService();
            $current_lang = app('locale')->get('current_locale');
            $default_lang = app('locale')->get('default_lang');
            $all_translations = Translation::all();
            $current_translations = $all_translations->filter(function ($trans) use ($current_lang) {
                return $trans->lang_code == $current_lang->code;
            });
            $default_translations = $all_translations->filter(function ($trans) use ($default_lang) {
                return $trans->lang_code == $default_lang->code;
            });
            $translationWordsService->share('all', $all_translations->toArray());
            $translationWordsService->share('current', $current_translations->toArray());
            $translationWordsService->share('default', $default_translations->toArray());
            return $translationWordsService;
        });


        // get translation words
        Blade::directive('locale', function () {
            return get_locale('code');
        });
        Blade::directive('dir', function () {
            return get_locale('dir');
        });
        Blade::directive('localeName', function () {
            return get_locale('name');
        });



        // setting
        Blade::directive('setting', function($key) {
            return get_settings($key);
        });

    }
}