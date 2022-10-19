<?php

namespace App\Services\Locale;

use Modules\Localization\Entities\Translation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;
use App\Helpers\HelperClasses\LocalizationHelper;
use Illuminate\Support\Facades\Schema;

class TranslationLoader extends FileLoader
{
    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        // if ($namespace !== null && $namespace !== '*') {
        //     return $this->loadNamespaced($locale, $group, $namespace);
        // }

        if ($group === '*' && $namespace === '*') {
            return Cache::remember("locale.translations.{$locale}.{$group}", 60, function () use ($locale) {
                $helper = new LocalizationHelper();
                $original_translations = $helper->getTranslationsFromFiles($locale);
                $database_translations = Schema::hasTable('translations') ? Translation::all() : false;
                $translations_merged = [];
                if (!$database_translations) {
                    return $original_translations;
                }
                foreach ($database_translations as $trans) {
                    $phrase_translations = $trans->getTranslations('phrase');
                    $key = $trans->key;
                    $overide_phrase = null;
                    if (array_key_exists($locale, $phrase_translations)) {
                        $overide_phrase = $phrase_translations[$locale];
                    } else {
                        if (isset($original_translations[$key])) {
                            $overide_phrase = $original_translations[$key];
                        } else {
                            $overide_phrase = $trans->phrase;
                        }
                    }
                    if ($overide_phrase) {
                        $translations_merged[$key] = $overide_phrase;
                    }
                }
                $diff_translations = collect($original_translations)->diffKeys($translations_merged)->toArray();
                $translations_merged = array_merge($translations_merged, $diff_translations);
                return $translations_merged;
            });
        }
        return $this->loadPath($this->path, $locale, $group);
    }
}