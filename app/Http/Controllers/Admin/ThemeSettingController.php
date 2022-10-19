<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomSetting;
use App\Models\ThemeSettingContainer;
use Modules\Setting\Events\CustomSettingUpdatedEvent;
use Modules\Widget\Entities\Widget;
use Qirolab\Theme\Theme;
use DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Settings;
use Illuminate\Support\Facades\Config;

class ThemeSettingController extends Controller
{

    public function __construct()
    {
        // check on permissions
        $this->middleware(['can:manage-setting', 'can:manage-theme-setting']);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($place)
    {
        breadcrumb([
            [
                'name' => __('view.dashboard'),
            ],
            [
                'name' => __('view.general_settings'),
            ],
            [
                'name' => __('view.theme_setting'),
            ],
        ]);
        $current_theme = strtolower(Theme::active());
        $theme_settings = config("theme_{$current_theme}.theme_setting");
        if (!$theme_settings || ($theme_settings && !is_array($theme_settings))) return abort(403, __('setting::view.no_theme_setting'));
        $theme_settings = collect($theme_settings)->map(function ($setting, $keySetting) {
            $setting['sortable'] = isset($setting['sortable']) && $setting['sortable'] === true;
            $setting['setting_folder'] = $keySetting;
            return $setting;
        });
        $theme_setting_forms = collect($theme_settings)->first(function ($item, $key) use ($place) {
            return $key == $place;
        });
        if (!$theme_setting_forms) return abort(404);
        $is_sortable = isset($theme_setting_forms['sortable']) && $theme_setting_forms['sortable'] === true;
        $sections = [];
        foreach ($theme_setting_forms['sections'] as $section_key => $section) {
            $file_name = $section_key;
            $setting_folder = $theme_setting_forms['setting_folder'];
            $new_section = [
                'section' => $file_name,
                'name' => array_key_exists('name', $section) ? $section['name'] : $file_name,
                'image' => array_key_exists('image', $section) ? $section['image'] : null,
                'form' => view()->exists("theme_setting.{$setting_folder}.{$file_name}") ? view("theme_setting.{$setting_folder}.{$file_name}")->render() : null
            ];
            $sections[] = $new_section;
        }
        $theme_setting_forms['sections'] = $sections;

        $tabs = collect($theme_settings)->mapWithKeys(function ($item, $key) {
            return [$key => $item['name']];
        });
        $theme_setting_data = CustomSetting::with('widget')->where('place', $place)->where('theme', $current_theme)->orderBy('sort')->get();
        $theme_setting_data->map(function ($setting) use($sections) {
            $widget_form = null;
            $widget_name = null;
            $widget_namespace = null;
            if ($setting->widget) {
                $widget_class = new $setting->widget['widget']();
                $widget_form = $widget_class->form($setting->widget->data, $setting->widget_id)->render();
                $widget_name = $widget_class->title;
                $widget_namespace = $setting->widget->widget;
            }
            $section_match = collect($sections)->first(function ($section) use ($setting) {
                return $section['section'] == $setting->section;
            });
            $viewPath = "theme_setting.{$setting->place}.{$setting->section}";
            $setting['form'] = view()->exists($viewPath) ? view($viewPath)->with(['data' => $setting->dataMaped, 'id' => $setting->id, 'model' => $setting])->render() : $widget_form;
            $setting['widget_namespace'] = $widget_namespace;
            $setting['name'] = $section_match ? $section_match['name'] : $widget_name;
            return $setting;
        });

        if (!$is_sortable && !$theme_setting_data->count()) {
            $theme_setting_data = $sections;
        }
        $locale = app()->getLocale();
        $setting_view_trans = resource_path("Resources/lang/{$locale}/theme.php");
        $widget_list = widget_class_list();
        $containers = ThemeSettingContainer::where('place', $place)->where('theme', $current_theme)->orderBy('sort')->get();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.theme_setting.edit')->with([
            'place' => $place,
            'tabs' => $tabs,
            'theme_setting_forms' => $theme_setting_forms,
            'theme_setting_data' => $theme_setting_data,
            'setting_view_trans' => json_encode($setting_view_trans),
            'widget_list' => $widget_list,
            'containers' => $containers,
            'is_sortable' => $is_sortable,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $place)
    {
        if (env('DEMO_MODE') == 'On') {
            return response()->json(['error_message_alert' => __('setting::view.demo_mode')]);
        }

        $sections = $request->sections;
        $section_list_removed = $request->get('section_list_removed');
        $widgets = $request->widgets;
        $widget_list_removed = $request->get('widget_list_removed');
        $containers = $request->containers;
        $container_list_removed = $request->get('container_list_removed');
        $error_bag = [];
        $data_saving = [];
        $widgets_saving = [];
        $containers_saving = [];
        $container_ids = [];
        $current_theme = strtolower(Theme::active());
        $sections_place = config("theme_{$current_theme}.theme_setting.{$place}.sections");

        // remove sections that have been removed
        if (count($section_list_removed)) {
            CustomSetting::whereIn('id', $section_list_removed)->delete();
        }
        if (count($widget_list_removed)) {
            Widget::whereIn('id', $widget_list_removed)->delete();
        }
        if (count($container_list_removed)) {
            ThemeSettingContainer::whereIn('id', $container_list_removed)->delete();
            $custom_settings_delete = CustomSetting::whereIn('container_id', $container_list_removed)->get(['id', 'widget_id']);
            foreach ($custom_settings_delete as $custom_setting_delete) {
                if ($custom_setting_delete->widget_id) {
                    Widget::destroy($custom_setting_delete->widget_id);
                }
                $custom_setting_delete->delete();
            }
        }

        foreach ($sections as $section) {
            $id = isset($section['id']) ? $section['id'] : null;
            $section_key = $section['section'];
            $index = $section['index'];
            $container_id = $section['container_id'];
            $current_section = collect($sections_place)->first(function ($s, $key) use ($section_key) {
                return $section_key == $key;
            }) ?? [];

            foreach ($section['form'] as $secKey => $secVal) {
                if (is_array($secVal) && count($secVal) !== count($secVal, COUNT_RECURSIVE)) {

                    $settingsModel = CustomSetting::firstOrCreate(['id' => $id]);

                    $settingsModel->syncFromMediaLibraryRequest($secVal)->toMediaCollection($secKey);

                }
            }
            $form = array_key_exists('map_before_validation', $current_section) ? $current_section['map_before_validation']($section['form'], $id) : $section['form'];
            $result_validation = true;
            // run validation
            if ($current_section && array_key_exists('validation', $current_section) && is_array($current_section['validation'])) {
                $validation = $current_section['validation'];
                $rules_validation = array_key_exists('rules', $validation) ? (is_array($validation['rules']) ? $validation['rules'] : $validation['rules']($form, $id)) : false;
                if ($rules_validation) {
                    $messages_validation = array_key_exists('messages', $validation) ? $validation['messages'] : [];
                    $attr_validation = array_key_exists('attributes', $validation) ? $validation['attributes'] : [];
                    $make_validation = Validator::make($form, $rules_validation, $messages_validation, $attr_validation);
                    if ($make_validation->fails()) {
                        $result_validation = $make_validation->errors();
                    }
                }
            }

            if ($result_validation === true) {
                $form = array_key_exists('map_after_validation', $current_section) ? $current_section['map_after_validation']($form, $id) : $form;
                $data_saving[] = [
                    'id'            => $id,
                    'data'          => $form,
                    'section'       => $section_key,
                    'place'         => $place,
                    'theme'         => $current_theme,
                    'container_id'  => $container_id,
                    'sort'          => intval($index) + 1,
                ];
            } else {
                $error_bag[] = [
                    'errors'        => $result_validation,
                    'index'         => $index,
                    'container_id'  => $section['container_id']
                ];
            }
        }

        // handle validation and maping data from widget class
        foreach ($widgets as $widget_data) {
            $widget_class = new $widget_data['widget']();
            $form = $widget_data['form'];
            $container_id = $widget_data['container_id'];
            $id = isset($widget_data['widget_id']) ? $widget_data['widget_id'] : null;
            $data_after_maped = $widget_class->mapData($form, $id);
            $validation = method_exists($widget_class, 'validation') ? $widget_class->validation($data_after_maped, $id) : true;
            if ($validation === true) {
                $widgets_saving[] = [
                    'id'            => $id,
                    'data'          => $data_after_maped,
                    'widget'        => $widget_data['widget'],
                    'sidebar_id'    => 'theme_setting_' . $place,
                    'theme'         => $current_theme,
                    'container_id'  => $container_id,
                    'sort'          => intval($widget_data['index']) + 1,
                ];
            } else {
                $error_bag[] = [
                    'errors'        => $validation,
                    'index'         => $widget_data['index'],
                    'container_id'  => $widget_data['container_id']
                ];
            }
        }

        // handle containers
        foreach ($containers as $container) {
            $container['form']['display_container'] = array_key_exists('display_container', $container['form']) ? true : false;
            $container['form']['container_sticky'] = array_key_exists('container_sticky', $container['form']) ? true : false;
            $containers_saving[] = [
                'id' => $container['id'],
                'data' => $container['form'],
                'place' => $place,
                'theme' => $current_theme,
                'sort' => intval($container['index']) + 1,
            ];
        }

        // return validation errors or success message
        if (count($error_bag)) {
            return response()->json([
                'message'   => __('view.msg_error_data'),
                'errors'    => $error_bag,
            ], 422);
        } else {
            foreach($widgets_saving as $index => $widget_update) {
                $widget_update_class = new $widget_update['widget']();
                if (array_key_exists('id', $widget_update)) {
                    $widget_object = Widget::find($widget_update['id']);
                    $widget_update['data'] = $widget_update_class->update($widget_object, $widget_update['data']);
                } else {
                    $widget_update['data'] = $widget_update_class->store($widget_update['data']);
                }
                $widgets_saving[$index] = $widget_update;
            }

            // save containers
            foreach($containers_saving as $container) {
                if (strpos($container['id'], 'container_id') === 0) {
                    // new
                    $container_obj = ThemeSettingContainer::create($container);
                } else {
                    // update
                    $container_obj = ThemeSettingContainer::find($container['id']);
                    $container_obj->update($container);
                }
                $container_ids[$container['id']] = $container_obj->id;
            }

            // save sections
            foreach($data_saving as $setting) {
                $setting['container_id'] = count($container_ids) ? $container_ids[$setting['container_id']] : null;
                CustomSetting::updateOrCreate([
                    'id' => $setting['id']
                ], $setting);
            }

            // save widgets
            foreach($widgets_saving as $widget) {
                $widget_created = Widget::updateOrCreate([
                    'id' => $widget['id']
                ], $widget);

                $widget_setting = [
                    'widget_id' => $widget_created->id,
                    'sort' => $widget['sort'],
                    'place' => $place,
                    'theme' => $current_theme,
                    'container_id' => count($container_ids) ? $container_ids[$widget['container_id']] : null
                ];
                CustomSetting::updateOrCreate([
                    'widget_id' => $widget_setting['widget_id']
                ], $widget_setting);
            }
            return response()->json(['message' => __('setting::view.msg_theme_setting_updated')]);
        }
    }


    public function importDemo(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return response()->json(['error_message_alert' => __('setting::view.demo_mode')]);
        }

        $theme = $request->theme ?? 'easyship';

        $demo_theme_storage_path = base_path('demos/'.$theme.'/storage');
        $base_theme_storage_path = base_path('/storage');
        File::copyDirectory($demo_theme_storage_path, $base_theme_storage_path);

        try {
            // Import sql modifications
            ini_set('max_execution_time', 1000);

            $sql_path = base_path('demos/'.$theme.'/database/demo.sql');
            if (file_exists($sql_path)) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    DB::table('media')->truncate();
                    CustomSetting::where('theme' , $theme )->delete();
                    ThemeSettingContainer::where('theme' , $theme )->delete();

                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                DB::unprepared(file_get_contents($sql_path));
            }

            if(check_module('blog')){
                $sql_blog_path = base_path('demos/'.$theme.'/database/blog.sql');
                if (file_exists($sql_blog_path)) {
                    $tablesToTruncate = ['categories','posts','taggables','tags','post_category'];
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    foreach ($tablesToTruncate as $name) {
                        DB::table($name)->truncate();
                    }
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    DB::unprepared(file_get_contents($sql_blog_path));
                }
            }

            if(check_module('menu')){
                $sql_menu_path = base_path('demos/'.$theme.'/database/menu.sql');
                if (file_exists($sql_menu_path)) {
                    $tablesToTruncate = ['menus','menu_items'];
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    foreach ($tablesToTruncate as $name) {
                        DB::table($name)->truncate();
                    }
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    DB::unprepared(file_get_contents($sql_menu_path));
                }
            }

            if(check_module('pages')){
                $sql_pages_path = base_path('demos/'.$theme.'/database/pages.sql');
                if (file_exists($sql_pages_path)) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    DB::table('pages')->truncate();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    DB::unprepared(file_get_contents($sql_pages_path));
                }
            }

            if(check_module('widget')){
                $sql_widget_path = base_path('demos/'.$theme.'/database/widget.sql');
                if (file_exists($sql_widget_path)) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    DB::table('widgets')->where('theme' , $theme )->delete();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    DB::unprepared(file_get_contents($sql_widget_path));
                }
            }
            DB::commit();

            // Refresh cache
            Artisan::call('refresh:cache');

            return response()->json(['message' => __('theme_easyship::view.demo_imported_successfully') , 'result' => true] );
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => $e , 'result' => false] );
            // something went wrong
        }
    }

    public function defaultTheme()
    {
        breadcrumb([
            [
                'name' => __('view.dashboard'),
            ],
            [
                'name' => __('view.general_settings'),
            ],
            [
                'name' => __('view.themes'),
            ],
        ]);

        $active_theme = preg_replace('/[^A-Za-z0-9\-]/', '', get_general_setting('active_theme')); // Removes special chars.
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.theme_setting.default_theme')->with([
            'active_theme' => $active_theme ?? 'easyship',
        ]);
    }

    public function activeTheme(Request $request)
    {
        $request->validate([
            'active_theme' => 'required',
        ]);
        $active_theme_setting = Settings::where('group', 'general')->where('name', 'active_theme')->first();
        if($active_theme_setting)
        {
            $active_theme_setting->payload = json_encode($request->active_theme) ?? json_encode('easyship');
            $active_theme_setting->save();
        }

        return back()->with(['message_alert' => __('view.active_successfully')]);
    }
    
}