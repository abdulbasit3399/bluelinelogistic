<?php

namespace Modules\Localization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Localization\Entities\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $languages = config('localization.languages');
        foreach($languages as $code => $lang) {
            Language::updateOrCreate(
                ['code' => $code],
                [
                    'name'          => $lang['name'],
                    'dir'           => isset($lang['dir']) ? $lang['dir'] : 'ltr',
                    'is_default'    => isset($lang['is_default']) && $lang['is_default'] === true
                ]
            );
        }
    }
}
