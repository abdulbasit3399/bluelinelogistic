<?php

use Qirolab\Theme\Theme;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Modules\Widget\Entities\Widget;

/***********************************************************************************/
if (!function_exists('register_sidebar')) {
    /**
     * Register new sidebar
     * @param array $sidebar
     */
    function register_sidebar($sidebar) { // add this function only in register provider
        $old_sidebars = config('wedgets.sidebars_registered');
        $old_sidebars[] = $sidebar;
        Config::set('wedgets.sidebars_registered', $old_sidebars);
    }
    /**
     * Example: 
        register_sidebar([
            'id' => 'sidebar_id',
            'name' => 'sidebar name',
            'theme' => 'html',
            'description' => 'sidebar description',
            'before_sidebar' => '<aside id="sidebar_id" class="sidebar-class">',
            'after_sidebar'  => '</aside>',
            'before_widget' => '<section id="weg-%wedgit_slug%" class="widget %wedgit_slug%">',
            'after_widget'  => '</section>'
        ])
     */
}
/***********************************************************************************/

if (!function_exists('unregister_sidebar')) {
    /**
     * Unregister new sidebar
     * @param string $sidebar_id
     * @param string $theme
     */
    function unregister_sidebar($sidebar_id, $theme = '') { // add this function only in boot provider
        $old_sidebars = config('wedgets.sidebars_unregistered');
        $old_sidebars[] = [
            'id'        => $sidebar_id,
            'theme'     => $theme,
        ];
        Config::set('wedgets.sidebars_unregistered', $old_sidebars);
    }
}
/***********************************************************************************/

if (!function_exists('sidebar_list')) {
    /**
     * Get sidebar list
     * @param string $theme
     * @return array
     */
    function sidebar_list($theme = '') {
        $theme = $theme == '' ? Theme::active() : $theme;
        $sidebars_registered = config('wedgets.sidebars_registered');
        // $sidebars_unregistered = config('wedgets.sidebars_unregistered');
        // $sidebar_list = collect($sidebars_registered)->filter(function ($sidebar) use ($sidebars_unregistered, $theme) {
        //     $find_sidebar_unregistered = collect($sidebars_unregistered)->first(function ($s) use ($sidebar) {
        //         return $s['id'] == $sidebar['id'] && $s['theme'] == $sidebar['theme'];
        //     });
        //     return !$find_sidebar_unregistered && $sidebar['theme'] == $theme;
        // })->values()->toArray();
        return $sidebars_registered;
    }
}
/***********************************************************************************/

if (!function_exists('get_sidebar')) {
    /**
     * Get sidebar in frontend
     * @param string $sidebar_id
     * @param string $theme
     * @return View
     */
    function get_sidebar($sidebar_id, $theme = '') {
        $sidebar_list = sidebar_list();
        $theme = $theme == '' ? Theme::active() : $theme;
        $sidebar_config = collect($sidebar_list)->first(function ($sidebar) use ($sidebar_id, $theme) {
            // return $sidebar['id'] == $sidebar_id && $sidebar['theme'] == $theme;

            if ($sidebar['id'] == $sidebar_id) {
                $sisebar_with_widgets = $sidebar['before_sidebar'];
                $widgets = Widget::where('theme', $theme)->where('sidebar_id', $sidebar_id)->orderBy('sort')->get();
                foreach ($widgets as $widget) {
                    $widget_class = new $widget['widget']();
                    $sisebar_with_widgets .= $sidebar['before_widget'];
                    $sisebar_with_widgets .= $widget_class->view($widget['id'], $widget['data']);
                    $sisebar_with_widgets .= $sidebar['after_widget'];
                }
                $sisebar_with_widgets .= $sidebar['after_sidebar'];
                echo $sisebar_with_widgets;
            }
        });

        return null;
    }
}
/***********************************************************************************/

if (!function_exists('widget_class_list')) {
    /**
     * Get widget list to show in admin page
     * 
     * @param bool $grouped
     * @return array
     */
    function widget_class_list($grouped = true) {
        $widget_list = [];
        if (File::isDirectory(app_path('Widgets'))) {
            $global_widgets_files = array_map('basename', File::files(app_path('Widgets')) );
            foreach ($global_widgets_files as $global_widgets_file) {
                $path = app_path("Widgets/{$global_widgets_file}");
                $file_name = File::name($path);
                $class_name = "App\Widgets\\{$file_name}";
                $class_instance = new $class_name();
                $class_instance->namespace = $class_name;
                // $class_instance->title = is_array($class_instance->name) ? (array_key_exists(config('app.locale'), $class_instance->name) ? $class_instance->name[config('app.locale')] : (array_key_exists(config('app.fallback_locale'), $class_instance->name) ? $class_instance->name[config('app.fallback_locale')] : $class_instance->type)) : $class_instance->name;
                $widget_list[] = $class_instance;
            }
        }
        
        $all_modules = array_map('basename', File::directories(base_path('Modules')) );
        foreach ($all_modules as $module_name) {
            $dir_path = module_path($module_name, 'Widgets');
            if (File::isDirectory($dir_path)) {
                $module_widgets_files = array_map('basename', File::files($dir_path));
                foreach ($module_widgets_files as $module_widgets_file) {
                    $module_path = module_path($module_name, "Widgets/{$module_widgets_file}");
                    $module_file_name = File::name($module_path);
                    $module_class_name = "Modules\\{$module_name}\Widgets\\{$module_file_name}";
                    $module_class_instance = new $module_class_name();
                    $module_class_instance->namespace = $module_class_name;
                    // $module_class_instance->title = is_array($module_class_instance->name) ? (array_key_exists(config('app.locale'), $module_class_instance->name) ? $module_class_instance->name[config('app.locale')] : (array_key_exists(config('app.fallback_locale'), $module_class_instance->name) ? $module_class_instance->name[config('app.fallback_locale')] : $module_class_instance->type)) : $module_class_instance->name;
                    $widget_list[] = $module_class_instance;
                }
            }
        }

        foreach ($widget_list as $widget_instance) {
            // $class = new \ReflectionClass('A\\B\\Foo');
            $widget_instance->group = $widget_instance->group == '' ? 'other' : $widget_instance->group;
            $widget_instance->icon = $widget_instance->icon == '' ? 'square' : $widget_instance->icon;
            $widget_instance->icon = 'fas fa-fw fa-' . $widget_instance->icon;
        }

        $widget_list = collect($widget_list)->filter(function($widget_class) {
            return $widget_class->publish;
        });

        if (!$grouped) return $widget_list->toArray();

        return $widget_list->groupBy('group')->toArray();
    }
}
/***********************************************************************************/