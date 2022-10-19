<?php

namespace Modules\Localization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Localization\Entities\Translation;
use App\Helpers\HelperClasses\LocalizationHelper;
use Illuminate\Support\Str;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $default_lang = default_lang('code') ? default_lang('code') : config('app.locale');
        $helper = new LocalizationHelper();
        $all_translations = $helper->getTranslationsFromFiles($default_lang);
        // sync translation words
        $all_translations_to_seed = [];
        // handle array to seed
        foreach($all_translations as $word_key => $word_phrase) {
            $all_translations_to_seed[] = [
                'key' => $word_key,
                'phrase' => [$default_lang => $word_phrase],
            ];
        }
        // check on removed from translations file
        $old_translations = Translation::select('key')->pluck('key');
        $diff_translations = $old_translations->diff(array_keys($all_translations));
        // delete translations was removed from file translations
        Translation::whereIn('key', $diff_translations->toArray())->delete();

        // craete new translation if not exists in database
        foreach ($all_translations_to_seed as $translation) {
            Translation::firstOrCreate(
                [ 'key' => $translation['key'] ],
                $translation
            );
        }
    }
}
