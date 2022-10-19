<?php

namespace Modules\Widget\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Widget\Entities\Widget;
use Qirolab\Theme\Theme;

class WidgetController extends Controller
{

    public function __construct()
    {
        // check on permissions
        $this->middleware('can:view-widgets')->only('index');
        // $this->middleware('can:create-widgets')->only('store');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        breadcrumb([
            [
                'name' => __('widget::view.widgets'),
            ],
        ]);
        $locale = app()->getLocale();
        $widget_view_trans = File::getRequire(module_path('widget', "Resources/lang/{$locale}/view.php"));
        $sidebar_list = sidebar_list();
        $widget_list = widget_class_list();
        $sidebar_widgets = Widget::where('theme', Theme::active())->get();
        $sidebar_widgets = $sidebar_widgets->sortBy('sort')->map(function($widget_map) {
            $widget_map['widget_class'] = new $widget_map['widget']();
            $widget_map['title'] = $widget_map['widget_class']->title;
            return $widget_map;
        })->groupBy('sidebar_id');
        
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('widget::'.$adminTheme.'.pages.widgets.index')->with([
            'sidebar_list' => $sidebar_list,
            'widget_list' => $widget_list,
            'sidebar_widgets' => $sidebar_widgets,
            'widget_view_trans' => json_encode($widget_view_trans),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $data                   = $request->data;
        $widget_list_removed    = $request->widget_list_removed;
        $error_bag              = [];
        $data_saving            = [];

        // remove widgets that have been removed
        if (count($widget_list_removed)) {
            Widget::whereIn('id', $widget_list_removed)->delete();
        }

        // handle validation and maping data from widget class
        foreach ($data as $widget_data) {
            $widget_class = new $widget_data['widget']();
            $form = $widget_data['form'];
            $id = isset($widget_data['id']) ? $widget_data['id'] : null;
            $data_after_maped = $widget_class->mapData($form, $id);
            $validation = method_exists($widget_class, 'validation') ? $widget_class->validation($data_after_maped, $id) : true;
            if ($validation === true) {
                $data_saving[] = [
                    'id'            => $widget_data['id'],
                    'data'          => $data_after_maped,
                    'widget'        => $widget_data['widget'],
                    'sidebar_id'    => $widget_data['sidebarId'],
                    'theme'         => $widget_data['sidebarTheme'],
                    'sort'          => intval($widget_data['index']) + 1,
                ];
            } else {
                $error_bag[] = [
                    'errors'        => $validation,
                    'index'         => $widget_data['index'],
                    'sidebarId'     => $widget_data['sidebarId']
                ];
            }
        }

        // return validation errors or success message
        if (count($error_bag)) {
            return response()->json([
                'message'   => __('view.msg_error_data'),
                'errors'    => $error_bag,
            ], 422);
        } else {
            foreach($data_saving as $index => $widget_update) {
                $widget_update_class = new $widget_update['widget']();
                if (array_key_exists('id', $widget_update)) {
                    $widget_object = Widget::find($widget_update['id']);
                    $widget_update['data'] = $widget_update_class->update($widget_object, $widget_update['data']);
                } else {
                    $widget_update['data'] = $widget_update_class->store($widget_update['data']);
                }
                $data_saving[$index] = $widget_update;
            }
            // save data
            foreach($data_saving as $widget) {
                Widget::updateOrCreate([
                    'id' => $widget['id']
                ], $widget);
            }
            return response()->json(['message' => __('widget::view.msg_widgets_updated')]);
        }
    }

}
