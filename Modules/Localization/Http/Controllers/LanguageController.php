<?php

namespace Modules\Localization\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Localization\Events\LanguageCreatedEvent;
use Modules\Localization\Events\LanguageUpdatedEvent;
use Modules\Localization\Http\Requests\LanguageRequest;
use Modules\Localization\Entities\Language;
use Modules\Localization\Http\DataTables\LanguagesDataTable;

class LanguageController extends Controller
{


    public function __construct()
    {
        // check on permissions
        $this->middleware('can:view-languages')->only('index');
        $this->middleware('can:create-languages')->only('store');
        $this->middleware('can:edit-languages')->only('edit', 'update');
        $this->middleware('can:delete-languages')->only('delete', 'multiDestroy');
    }


    /**
     * Display a listing of the resource.
     * @return LanguagesDataTable
     */
    public function index(LanguagesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('localization::view.localization'),
            ],
            [
                'name' => __('localization::view.languages'),
            ],
        ]);
        $data_with = [];
        // echo public_path('storage');
        // echo '<hr>';
        // echo storage_path('app/public');
        // exit;
        $share_data = array_merge(get_class_vars(LanguagesDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('localization::'.$adminTheme.'.pages.languages.index', $share_data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LanguageRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $data = $request->only(['name', 'code', 'dir', 'script', 'native', 'regional']);
        
        $language = Language::create($data);
        $language->addFromMediaLibraryRequest($request->image)->toMediaCollection('icon');
        event(new LanguageCreatedEvent($language));
        return redirect()->route('languages.index')->with(['message_alert' => __('localization::messages.languages.created')]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        breadcrumb([
            [
                'name' => __('localization::view.localization'),
            ],
            [
                'name' => __('localization::view.languages'),
                'path' => fr_route('languages.index')
            ],
            [
                'name' => __('localization::view.edit_language')
            ]
        ]);
        $language = Language::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('localization::'.$adminTheme.'.pages.languages.edit')->with(['model' => $language]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(LanguageRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $language = Language::findOrFail($id);
        $data = $request->only(['name', 'code', 'dir', 'script', 'native', 'regional']);
        $language->update($data);
        event(new LanguageUpdatedEvent($language));
        $language->syncFromMediaLibraryRequest($request->image)->toMediaCollection('icon');
        return redirect()->route('languages.index')->with(['message_alert' => __('localization::messages.languages.saved')]);
    }

    /**
     * Remove one user from database.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        Language::find($id)->delete();
        return response()->json(['message' => __('localization::messages.languages.deleted')]);
    }




    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Response
     */
    public function multiDestroy(Request $request)
    {
        $ids = $request->ids;
        $languages = Language::whereIn('id', $ids)->get();
        foreach($languages as $language) {
            $language->delete();
        }
        return response()->json(['message' => __('localization::messages.languages.multi_deleted')]);
    }


    /**
     * switch default language.
     * @param Request $request
     * @return Response
     */
    public function switchDefault(Request $request, $id)
    {
        $language = Language::find($id);
        if (!$language) response()->json(['message' => __('localization::messages.languages.not_found')]);
        $language->is_default = true;
        $language->save();
        Language::where('id', '<>', $id)->update(['is_default' => false]);
        
        return response()->json(['message' => __('localization::messages.languages.default_success')]);
    }
    
    public function getLanguagesApi(Request $request)
    {
        $languages = get_langauges();
        return response()->json($languages);  
    }

    public function getSystemLanguageApi(Request $request)
    {
        $language = get_current_lang();
        return response()->json($language);  
    }

}
