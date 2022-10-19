<?php
namespace App\Helpers\HelperClasses;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class LocalizationHelper {
    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     *
     * @return array
     */
    public function getTranslationsFromFiles($locale)
    {
        $general_translation_path = resource_path("/lang/" . $locale);
        $general_translations_dir = File::isDirectory($general_translation_path) ? $general_translation_path : null;
        $all_translations = [];
        $general_translations = [];
        if ($general_translations_dir) {
            $general_translation_files = array_map('basename', File::files($general_translations_dir));
            foreach ($general_translation_files as $file) {
                $file_path = $general_translations_dir . '/' . $file;
                $file_name = explode('.php', $file)[0];
                $general_translations[$file_name] = File::getRequire($file_path);
            }
            $all_translations = Arr::dot($general_translations);
        }

        // lang modules
        $all_modules = array_map('basename', File::directories(base_path('Modules')) );
        foreach ($all_modules as $module_name) {
            $module_name_lower = strtolower($module_name);
            $module_translations_path = module_path($module_name, 'Resources/lang/' . $locale);
            $module_translations_dir = File::isDirectory($module_translations_path) ? $module_translations_path : null;
            if ($module_translations_dir) {
                $module_translation_files = array_map('basename', File::files($module_translations_dir));
                $module_translations = [];
                foreach ($module_translation_files as $module_file) {
                    $module_file_path = $module_translations_dir . '/' . $module_file;
                    $module_file_name = explode('.php', $module_file)[0];
                    $module_file_prefix = $module_name_lower . '::' . $module_file_name;
                    $module_translations[$module_file_prefix] = File::getRequire($module_file_path);
                }
                $all_translations = array_merge($all_translations, Arr::dot($module_translations));
            }
        }

        // lang themes
        $themes = array_map('basename', File::directories(base_path('themes')) );
        foreach ($themes as $theme_name) {
            $theme_name_lower = strtolower($theme_name);
            $theme_translations_path = base_path("themes/{$theme_name}/lang/{$locale}");
            $theme_translations_dir = File::isDirectory($theme_translations_path) ? $theme_translations_path : null;
            if ($theme_translations_dir) {
                $theme_translation_files = array_map('basename', File::files($theme_translations_dir));
                $theme_translations = [];
                foreach ($theme_translation_files as $theme_file) {
                    $theme_file_path = $theme_translations_dir . '/' . $theme_file;
                    $theme_file_name = explode('.php', $theme_file)[0];
                    $theme_file_prefix = 'theme_' . $theme_name_lower . '::' . $theme_file_name;
                    $theme_translations[$theme_file_prefix] = File::getRequire($theme_file_path);
                }
                $all_translations = array_merge($all_translations, Arr::dot($theme_translations));
            }
        }

        $all_translations = collect($all_translations)->filter(function ($phrase, $key) {
            return is_string($phrase);
        })->toArray();
        return $all_translations;
    }
}