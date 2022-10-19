<?php

namespace Modules\Localization\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Localization\Events\TranslationUpdatedEvent;

use Modules\Localization\Entities\Language;
use Modules\Localization\Entities\Translation;

class TranslationController extends Controller
{


    public function __construct()
    {
        // check on permissions
        $this->middleware('can:edit-translations')->only('index', 'update');
    }


    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index($id)
    {
        breadcrumb([
            [
                'name' => __('localization::view.localization'),
            ],
            [
                'name' => __('localization::view.translations'),
            ],
        ]);

        $languages = languages();
        $current_language = $languages->first(function ($lang) use ($id) {
            return $lang->id == $id; 
        });
        $translations = Translation::all();
        $with = [
            'translations' => $translations,
            'languages' => $languages,
            'current_language' => $current_language,
            'lang_code' => $current_language->code,
        ];
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('localization::'.$adminTheme.'.pages.translations.index')->with($with);
    }



    /**
     * Update all translations for one language
     * 
     * @param Request $request
     * @param string $lang_code // example: en
     * @return Renderable
     */
    public function update(Request $request, $lang_code)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $request->validate([
            'phrases' => 'required|array',
            'phrases.*' => 'nullable|string',
        ]);
        $data = $request->get('phrases');
        $default_lang = default_lang('code');
        $translations = Translation::all();
        foreach ($translations as $translation) {
            $default_phrase = $translation->translate('phrase', $default_lang);
            if(isset($data[$translation->key]) && $new_phrase = $data[$translation->key]){
                if ($default_phrase != $new_phrase) {
                    $translation->setTranslation('phrase', $lang_code, $new_phrase);
                    $translation->save();
                }
            }
        }
        // dd(array_slice($translations->toArray(), 0, 100));
        return redirect()->back()->with(['message_alert' => __('localization::messages.translations.saved')]);
    }

}