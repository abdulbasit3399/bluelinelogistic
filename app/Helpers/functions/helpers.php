<?php

/**
 * Here Added global functions you want include in any place in system
 */

use Symfony\Component\HttpFoundation\File\File as FileFoundation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Qirolab\Theme\Theme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Localization\Entities\Language;
use Modules\Menu\Entities\Menus;
use App\Models\CustomSetting;
use App\Models\ThemeSettingContainer;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Currency\Entities\Currency;

/***********************************************************************************/
if (!function_exists('check_module')) {
    /**
     * Check on module is exists.
     * @return boolean.
     */
    function check_module($module_name) {
        $module_name = strtolower($module_name);
        $modules_file = json_decode(File::get(base_path('modules_statuses.json')), true);
        $modules = collect($modules_file)->mapWithKeys(function($value, $name) {
            return [strtolower($name) => $value];
        });
        return $modules->first(function ($value, $mn) use ($module_name) { return $mn == $module_name && $value === true; }) ? true : false;
    }
}

/***********************************************************************************/
if (!function_exists('get_module_settings')) {
    /**
     * Get settings.
     * @return Setting setting table.
     */
    function get_module_settings() {
        $module_settings = [];
        return $module_settings;
        $get_setting = Setting::select('id', 'parent', 'module_name', 'module_slug', 'permission_id')
            ->with('permission')
            ->whereNull('parent')
            ->orderBy('module_slug')
            ->limit(100)
            ->get();
        $general_settings = $get_setting->first(function ($setting) { return $setting->module_slug == 'general_settings'; });

        if ($general_settings) $module_settings[] = $general_settings;
        
        foreach ($get_setting as $setting) {
            if ($setting->module_slug != 'general_settings') {
                $module_settings[] = $setting;
            }
        }
        return $module_settings;
    }
}

/***********************************************************************************/
if (!function_exists('get_general_setting')) {
    /**
     * Get column of settings.
     * @return Setting column setting table.
     */
    function get_general_setting($key, $default = '') {

        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('settings'))
        {
            $settings = app(\App\Models\GeneralSettings::class);
            
            $value = null;
            $old_setting = config('cms.settings.general');
            $get_setting_fields = \App\Models\GeneralSettings::fields();
            if ($get_setting_fields) {
                if (isset($get_setting_fields[$key])) {
                    if ($get_setting_fields[$key]['type'] == 'image') {
                        $uri = \Config::get('DIRECTORY_IMAGE') . '/' . $get_setting_fields[$key]['value'];
                        $path = public_path('storage/'. $uri);
                        $value = is_file($path) && file_exists($path) ? Storage::url($uri) : null;
                    } else {
                        $value = (is_array($get_setting_fields[$key]['value'])) ? (isset($get_setting_fields[$key]['value'][LaravelLocalization::getCurrentLocale()]) ? $get_setting_fields[$key]['value'][LaravelLocalization::getCurrentLocale()] : $get_setting_fields[$key]['value']['en'] ) : $get_setting_fields[$key]['value'];
                    }
                }
                
                config()->set('cms.settings.general', collect($get_setting_fields)->toArray());
            }
            return $value ?? $default;
        }else{
            return false;
        }
    }
}

/***********************************************************************************/
if (!function_exists('theme_setting')) {
    /**
     * Get column of settings.
     * @return CustomSetting column setting table.
     */
    function theme_setting($key, $default = '') {
        $key_vars = explode('.', $key);
        $place = $key_vars[0];
        $section = count($key_vars) > 1 ? $key_vars[1] : false;
        $setting_key = count($key_vars) > 2 ? $key_vars[2] : false;
        $current_theme = strtolower(Theme::active());
        $value = null;
        $query_settings = CustomSetting::with('widget')->where('place', $place)->where('theme', $current_theme)->orderBy('sort');
        if ($section) {
            $get_settings = $query_settings->where('section', $section)->first();
            if ($get_settings) {
                $value = $get_settings->dataMaped;
                if ($setting_key) {
                    $value = array_key_exists($setting_key, $value) ? $value[$setting_key] : null;
                }
            }
        } else {
            $value = $query_settings->get(['data', 'section', 'place', 'sort', 'widget_id'])->toArray();
        }
        return $value ?? $default;
    }
}

/***********************************************************************************/
if (!function_exists('theme_setting_image')) {
    /**
     * Get media url of settings.
     * @return Media url from media table.
     */
    function theme_setting_image($id,$setting_key = null) {
        $query_settings = CustomSetting::where('id', $id)->orWhere('section',$id)->first();
        if($query_settings){
            return $query_settings->getFirstMediaUrl($setting_key) ?? $default;
        }else{

        }
    }
}

/***********************************************************************************/
if (!function_exists('theme_setting_container_image')) {
    /**
     * Get media url of settings.
     * @return Media url from media table.
     */
    function theme_setting_container_image($id,$setting_key = null) {
        $query_settings = ThemeSettingContainer::where('id', $id)->first();
        if($query_settings){
            return $query_settings->getFirstMediaUrl($setting_key) ?? $default;
        }else{

        }
    }
}


/***********************************************************************************/
if (!function_exists('theme_setting_containers')) {
    /**
     * Get column of settings.
     * @return CustomSetting column setting table.
     */
    function theme_setting_containers($place) {
        $current_theme = strtolower(Theme::active());
        $with = [
            'sections' => function ($q) {
                $q->orderBy('sort');
            },
            'sections.widget'
        ];
        $getContainers = ThemeSettingContainer::with($with)->where('place', $place)->where('theme', $current_theme)->orderBy('sort')->get();
        $getContainers = $getContainers->filter(function ($container) {
            return array_key_exists('display_container', $container->data) ? $container->data['display_container'] : false;
        });
        $getContainers->map(function ($container) {
            $container->sections->map(function ($section) {
                $section['widget_view'] = $section->widget ? $section->widget->view : null;
                return $section;
            });
            $container_width_class = 'full-width';
            if (array_key_exists('container_width', $container->data)) {
                if ($container->data['container_width'] == 'half_width') {
                    $container_width_class = 'vc_col-sm-6';
                }
                if ($container->data['container_width'] == 'one_third') {
                    $container_width_class = 'vc_col-sm-4';
                }
                if ($container->data['container_width'] == 'two_thirds') {
                    $container_width_class = 'vc_col-sm-8';
                }
            }
            $container['container_width_class'] = $container_width_class;
            return $container;
        });
        return $getContainers->values();
    }
}


/***********************************************************************************/
if (!function_exists('aasort')) {
    /**
     * Sort a Multi-dimensional Array by order value.
     * @return Array sorted Ascending.
     */
    function aasort ($array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;

        return $array;
    }
}



/***********************************************************************************/
if (!function_exists('breadcrumb')) {
    /**
     * set and get breadcrumb in view pages
     * save and get array breadcrumb in config cms file
     *
     * @param array||null  $breadcrumb 
     * [
            [
                'name' => Name previous page,
                'path' => fr_route path 
            ],
            [
                'name' => name current page
            ],
        ]
     * @param boolean  $merge
     * if true will be merge $breadcrumb array with array in config
     * @return array 
     * if @param $breadcrumb is null will be get config breadcrumb
     * if @param $breadcrumb is array will be set config breadcrumb
     * 
     * @example 
     *  breadcrumb([
            [
                'name' => 'Home',
            ],
            [
                'name' => __('users::view.users'),
                'path' => fr_route('users.index')
            ],
            [
                'name' => __('view.profile_details')
            ],
        ]);
     */
    function breadcrumb($breadcrumb = null, $merge = false) {
        if (is_null($breadcrumb)) {
            return config('cms.breadcrumb');
        } else {
            if ($merge === true) {
                config()->set('cms.breadcrumb', array_merge(config('cms.breadcrumb'), $breadcrumb));
            } else {
                config()->set('cms.breadcrumb', $breadcrumb);
            }
            return config('cms.breadcrumb');
        }
    }
}

/***********************************************************************************/
if (!function_exists('breadcrumb_html')) {
    /**
     * Get breadcrumb and echo this with format html in blade file
     * @see resources\views\admin\components\page-title.blade.php
     * @return string breadcrumb format html.
     */
    function breadcrumb_html() {
        $breadcrumb = breadcrumb();
        if (is_array($breadcrumb) && !empty($breadcrumb)) {
            $resultHTML = '';
            $lastPage = $breadcrumb[count($breadcrumb) - 1];
            
            $adminTheme = env('ADMIN_THEME', 'adminLte');
            if($adminTheme == 'admin'){
                $resultHTML .= ('<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">' . $lastPage['name'] . '</h1>');
                if (count($breadcrumb) > 1) {
                    $resultHTML .= ('<span class="h-20px border-gray-200 border-start mx-4"></span> <ol class="breadcrumb text-muted fs-6 fw-bold">');
                    foreach ($breadcrumb as $key => $page) {
                        if (isset($page['path'])) {
                            $path = str::startsWith($page['path'], 'http') ? $page['path'] : aurl($page['path']);
                            $resultHTML .= (
                                '<li class="breadcrumb-item pe-3">' . 
                                    '<a href="' . $path . '" class="pe-3">' . $page['name'] . '</a>' .
                                '</li>'
                            );
                        } else {
                            $resultHTML .= ( '<li class="breadcrumb-item pe-3 text-muted">' . $page['name'] . '</li>' );
                        }
                    }
                    $resultHTML .= ('</ol>');
                }
            }elseif($adminTheme == 'adminLte'){

                $resultHTML .= ('<div class="content-header"> <div class="container-fluid"> <div class="row mb-2">');
                $resultHTML .= ('<div class="col-sm-6"> <h1 class="m-0">' . $lastPage['name'] . '</h1> </div>');
                if (count($breadcrumb) > 1) {
                    $resultHTML .= ('<div class="col-sm-6"> <ol class="breadcrumb float-sm-right">');
                    foreach ($breadcrumb as $key => $page) {
                        if (isset($page['path'])) {
                            $path = str::startsWith($page['path'], 'http') ? $page['path'] : aurl($page['path']);
                            $resultHTML .= (
                                '<li class="breadcrumb-item">' . 
                                    '<a href="' . $path . '" class="pe-3">' . $page['name'] . '</a>' .
                                '</li>'
                            );
                        } else {
                            $resultHTML .= ( '<li class="breadcrumb-item">' . $page['name'] . '</li>' );
                        }
                    }
                    $resultHTML .= ('</ol> </div>');
                }
                $resultHTML .= ('</div> </div> </div>');
            }
            return $resultHTML;
        }
    }
}

/***********************************************************************************/
if (!function_exists('convert_base64_to_file')) {
    /**
     * convert base64 to file upload class.
     * @see App\Helpers\HelperTraits\FileHelper.
     * @param string $base64 -> file or image.
     * @return UploadedFile.
     */
    function convert_base64_to_file($base64) {
        // decode the base64 file
        $str_cut = ';base64,';
        $base64_string = substr($base64, strpos($base64, $str_cut) + strlen($str_cut));        
        $fileData = base64_decode($base64_string);
        // save it to temporary dir first.
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $fileData);
        // this just to help us get file info.
        $tmpFile = new FileFoundation($tmpFilePath);
        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );
        return $file;
    }
}

/***********************************************************************************/
if (!function_exists('uploader')) {
    /**
     * Alternative FileHelperClass.
     * @return FileHelperClass.
     */
    function uploader($request = null) {
        $file_helper_class = new App\Helpers\HelperClasses\FileHelperClass($request);
        return $file_helper_class;
    }
}

/***********************************************************************************/
if (!function_exists('check_every_array')) {
    /**
     * This function searches for each element in the small array if it exists in the large array or not.
     * @see Modules\Acl\Resources\views\pages\roles\form.blade.php.
     * @param array $small_array.
     * @param array $big_array.
     * @return boolean.
     * @example
     * $small_array = ['a', 'b', 'c', 'd'];
     * $big_array = ['b', 'c', 'a', 'e', 'f', 'd'];
     * check_every_array($small_array, $big_array) // ture
     * 
     * $small_array = ['a', 'b', 'z', 'd'];
     * $big_array = ['b', 'c', 'a', 'e', 'f', 'd'];
     * check_every_array($small_array, $big_array) // false
     */
    function check_every_array($small_array, $big_array) {
        return collect($small_array)->every(function ($value, $key) use ($big_array) {
            $big_array = is_array($big_array) ? $big_array : $big_array->toArray();
            return in_array($value, $big_array);
        });
   }
}

/***********************************************************************************/
if (!function_exists('get_current_lang')) {
    /**
     * Get currnet langauge name
     * @return string
     */
    function get_current_lang() {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {

            $lang = \Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first();

            $current = array('name' => $lang->name, 'code' => $lang->code, 'icon' => $lang->getFirstMediaUrl('icon'));
            return $current;
        }else{
            return false;
        }
    }
}

/***********************************************************************************/
if (!function_exists('get_current_lang_image')) {
    /**
     * Get currnet langauge name
     * @return string
     */
    function get_current_lang_image() {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
            return \Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first()->getFirstMediaUrl('icon');
        }else{
            return false;
        }
    }
}

/***********************************************************************************/

/***********************************************************************************/
if (!function_exists('get_langauges')) {
    /**
     * Get list of langauge
     * @return array
     */
    function get_langauges() {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
            return LaravelLocalization::getSupportedLocales();
        }else{
            return false;
        }
    }
}



/***********************************************************************************/
if (!function_exists('get_langauges_except_current')) {
    /**
     * Get list of langauge name excepted current langauge
     * @return string
     */
    function get_langauges_except_current() {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
            $languages = array();
            foreach(\Modules\Localization\Entities\Language::where('code', '!=', LaravelLocalization::getCurrentLocale())->get() as $lang){
                $languages[$lang->code] = array('name' => $lang->name, 'code' => $lang->code, 'icon' => $lang->getFirstMediaUrl('icon'));
            }
            return $languages;
        }else{
            return false;
        }
    }
}



/***********************************************************************************/
if (!function_exists('get_comment_author')) {
    /**
     * Get list of langauge name excepted current langauge
     * @return object|null
     */
    function get_comment_author() {
        return isset($_COOKIE['comment_cookies_author']) ? json_decode($_COOKIE['comment_cookies_author']) : null;
    }
}

/***********************************************************************************/

/***********************************************************************************/
/* Translation functions
**********************************************************************************/

if (!function_exists('languages')) {
    /**
     * Get list of langauge
     * @return array
     */
    function languages() {
        return Language::select('id', 'name', 'code', 'dir', 'is_default')->get();
    }
}

/***********************************************************************************/
if (!function_exists('get_locale')) {
    /**
     * Get current langauge
     * @return string|object
     */
    function get_locale($key = null) {
        $current = app('locale')->get('current_locale');
        if (!$current) return null;
        if (!is_null($key)) {
            $current = $current->$key;
        }
        return $current;
    }
}
// get_locale('code') -> en
// get_locale('dir') -> ltr
// get_locale('name') -> English
/***********************************************************************************/
if (!function_exists('default_lang')) {
    /**
     * Get default langauge
     * @return string|object
     */
    function default_lang($key = null) {
        $default = app('locale')->get('default_lang');
        if (!$default) return null;
        if (!is_null($key)) {
            $default = $default->$key;
        }
        return $default;
    }
}
// default_lang('code') -> en
/***********************************************************************************/

if (!function_exists('config_theme')) {
    /**
     * get config current theme active
     * @return array
     */
    function config_theme($key = null, $default = '') {
        $theme = Theme::active();
        return config("theme_{$theme}.{$key}") ?? $default;
    }
}

/***********************************************************************************/
if (!function_exists('get_menu_items')) {
    /**
     * get menu items object to show in frontend
     * @return object
     */
    function get_menu_items($place = '') {
        $child_count_words = '';
        for ($i = 0; $i < 15; $i++) {
            $child_count_words .= '.child';
        }
        $menu = Menus::with("items{$child_count_words}");
        if ($place != '') {
            $menu->where('place', $place);
        } else {
            $menu->whereNull('place');
        }
        $menu = $menu->first();
        return $menu ? $menu->items : collect([]);
    }
}
/***********************************************************************************/
if (!function_exists('get_menu_header')) {
    /**
     * get menu html to show in nav in frontend
     * @return string
     */
    function get_menu_header() {
        $items = get_menu_items('header');
        return get_list_of_header_menu($items);
    }
}
/***********************************************************************************/

if (!function_exists('get_list_of_header_menu')) {
    /**
     * get menu html to show in nav in frontend
     * @return string
     */

    function get_list_of_header_menu($items , $SubMenuClass = null, $SubMenuArrow = null) {
        if (check_module('Localization')) {
            $current_lang = Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first();
        }
        
        $menu_items_html = '';
        $header_setting = theme_setting('header.header');
        
        if(!$header_setting) $header_setting = array();
            $style = (array_key_exists('header_text_color', $header_setting) && $header_setting['header_text_color']) ? "color: ".$header_setting['header_text_color'] : "";
            $lang = $current_lang ? $current_lang->code : 'en';
            foreach ($items as $item) {
                $label = json_decode($item->label, true)[ $lang ] ?? '';
                $menu_items_html .= '

                <li id="menu-item-' . $item->id . '" class="nav-item '.($item->child->count() ? 'menu-item-has-children dropdown' : '').' menu-item menu-item-type-custom menu-item-object-custom menu-parent-item menu-item--parent bd_menu_item">
                    <a class="nav-link dropdown-item ' . ($item->child->count() ? 'dropdown-toggle' : '') . '" href="' . $item->url . '" style="'.$style.'" ' . ($item->child->count() ? 'data-toggle="dropdown' : '') . '">' . $label . ($item->child->count() ? $SubMenuArrow : ''). '</a>';
                if ($item->child->count()) {
                    $arrow = "<i data-feather='chevron-right'></i>";
                    if(isset($current_lang) && $current_lang->dir == 'rtl'){
                        $arrow = "<i data-feather='chevron-left'></i>";
                    }
                    $menu_items_html .= '<ul class="dropdown-menu '.$SubMenuClass.' ">';
                    $menu_items_html .= get_list_of_header_menu($item->child , 'submenu', $arrow);
                    $menu_items_html .= '</ul>';
                }
                $menu_items_html .= '</li>';
            }
        return $menu_items_html;
    }
}        
/***********************************************************************************/

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $setting = BusinessSetting::where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}

if (!function_exists('get_settings')) {
    function get_settings($key, $default = null)
    {
        $setting =  \app\Models\Settings::where('name',$key)->first();
        if($setting){
            return $setting->payload ?? $default;
        }

        return $default;
    }
}


/***********************************************************************************/
if (!function_exists('flatten')) {
    function flatten($array) {
        $result = array();
        foreach($array as $key=>$value) {
            if(is_array($value)) {
                $result = $result + flatten($value, $key . '.');
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

/***********************************************************************************/
if (!function_exists('get_admins')) {
    /**
     * get all admins (role = 1) as array [id => name]
     * @return array
     */
    function get_admins() {
        if(env('INSTALLATION') == true){
            if (\Illuminate\Support\Facades\Schema::hasTable('users') && check_module('users')) {
                $items = \App\Models\User::where('role', 1)->get(['id','name'])->toArray();
                $array = array();
                foreach($items as $item){
                    $array[] = array($item['id'] => $item['name']);
                }
                return flatten($array);
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
}


/***********************************************************************************/
if (!function_exists('get_staff')) {
    /**
     * get all users (role = 0) as array [id => name]
     * @return array
     */
    function get_staff() {
        if(env('INSTALLATION') == true){
            if (\Illuminate\Support\Facades\Schema::hasTable('users') && check_module('users')) {
                $items = \App\Models\User::where('role', 0)->get(['id','name'])->toArray();
                $array = array();
                foreach($items as $item){
                    $array[] = array($item['id'] => $item['name']);
                }
                return flatten($array);
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
}

/***********************************************************************************/
if (!function_exists('get_branches')) {
    /**
     * get all users (is_archived = 0) as array [user_id => name]
     * @return array
     */
    function get_branches() {
        if(env('INSTALLATION') == true){
            if (\Illuminate\Support\Facades\Schema::hasTable('branches') && check_module('cargo')) {
                $items = Modules\Cargo\Entities\Branch::where('is_archived', 0)->get(['user_id','name'])->toArray();
                $array = array();
                foreach($items as $item){
                    $array[] = array($item['user_id'] => $item['name']);
                }
                return flatten($array);
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
}


/***********************************************************************************/
if (!function_exists('get_roles')) {
    /**
     * get all rolesas array [id => name]
     * @return array
     */
    function get_roles() {
        if(env('INSTALLATION') == true){
            if (\Illuminate\Support\Facades\Schema::hasTable('roles') && check_module('acl')) {
                $items = \Spatie\Permission\Models\Role::get(['id','name'])->toArray();
                $array = array();
                foreach($items as $item){
                    $array[] = array($item['id'] => $item['name']);
                }
                return flatten($array);
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
}

/***********************************************************************************/
if (! function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if(request()->session()->get('currency_code')){
            $currency = Currency::where('code', request()->session()->get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }
        return $currency->symbol;
    }
}

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {
        if (BusinessSetting::where('type', 'decimal_separator')->first()->value == 1) {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value);
        }
        else {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value , ',' , ' ');
        }

        if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
            return currency_symbol().$fomated_price;
        }
        return $fomated_price.currency_symbol();
    }
}

/***********************************************************************************/
if (!function_exists('get_languages')) {
    /**
     * get all admins (role = 1) as array [id => name]
     * @return array
     */
    function get_languages() {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('languages') && check_module('Localization')) {
            $languages = array();
            foreach (Modules\Localization\Entities\Language::all() as $key => $language){
                $languages[$language->code] = ['name' => $language->name, 'script' => $language->script, 'native' => $language->native, 'regional' => $language->regional];
            }

            return $languages;
        }else{
            return array();
        }
    }
}

/***********************************************************************************/
if (!function_exists('get_notification_users')) {
    /**
     * get all admins (role = 1) as array [id => name]
     * @return array
     */
    function get_notification_users($name, $model = null) {
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $settings = app(\Modules\Cargo\Entities\CargoNotificationsSettings::class);
            $users    = array();

            if(isset(json_decode($settings->{$name}, true)[$name.'_system_administrators'])) {
                $users[]  = json_decode($settings->{$name}, true)[$name.'_system_administrators'];
            }
            if(isset(json_decode($settings->{$name}, true)[$name.'_users_roles'])) {
                $users[]  = json_decode($settings->{$name}, true)[$name.'_users_roles'];
            }
            if(isset(json_decode($settings->{$name}, true)[$name.'_users'])) {
                $users[]  = json_decode($settings->{$name}, true)[$name.'_users'];
            }
            if(isset(json_decode($settings->{$name}, true)[$name.'_branches'])) {
                $users[]  = json_decode($settings->{$name}, true)[$name.'_branches'];
            }
            
            $users = array_merge(...$users);

            if($model){
                if(isset(json_decode($settings->{$name}, true)[$name.'_sender']) && isset($model->client) ) {
                    $users[] = $model->client->user_id;
                };
                if(isset(json_decode($settings->{$name}, true)[$name.'_assigned']) && isset($model->captain) ) {
                    $users[] = $model->captain->user_id;
                };
            }
            $users = array_unique($users);
            return $users;
        }else{
            return array();
        }
    }
}

if (!function_exists('get_notification_gateways')) {
    /**
     * get all admins (role = 1) as array [id => name]
     * @return array
     */
    function get_notification_gateways() {
        $gateways = array();
        if (env('INSTALLATION') == 'true' && \Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $settings = app(App\Models\NotificationsSettings::class);
            
            if($settings->email){
                $gateways[] = 'mail';
            }
            if($settings->sms){
                $gateways[] = 'sms';
            }
            if($settings->fcm){
                $gateways[] = 'fcm';
            }
        }
        $gateways[] = 'database';
        return $gateways;
    }
}

if (!function_exists('send_notification')) {
    /**
     * get all admins (role = 1) as array [id => name]
     * @return array
     */
    function send_notification($user,$gateways,$type, $title = null, $content = null, $url = null, $model= null) {
        $available_gateways = $gateways;
        if($user){
            if(isset($user->phone) && $user->phone == null){
                if (($key = array_search('sms', $available_gateways)) !== false) {
                    unset($available_gateways[$key]);
                }
            }
            if(isset($user->email) && $user->email == null){
                if (($key = array_search('email', $available_gateways)) !== false) {
                    unset($available_gateways[$key]);
                }
            }
            $data = array(
                'sender'    =>  $user->id,
                'to'        =>  $user->device_token ?? " ",
                'phone'     =>  $user->phone ?? " ",
                'message'   =>  array(
                        'subject'   =>  ($title ?? " ").(' | #'.$model->code ?? " "),
                        'content'   =>  $content ?? " ",
                        'url'       =>  $url ?? " ",
                        'id'        =>  $model->id ?? " ",
                        'code'      =>  $model->code ?? " ",
                        'type'      =>  $type ?? " ",
                ),
                'icon'      =>  'fas fa-bell',
                'type'      =>  $type ?? " ",
            );
            
            $user->notify(new \App\Notifications\GlobalNotification($data, $available_gateways));
        }
    }
}

if (!function_exists('setEnvValue')) {
    /**
     * set in .env file
     * @return array
     */
    function setEnvValue(string $key, string $value)
    {
        $path = app()->environmentFilePath();
        $env = file_get_contents($path);

        $old_value = env($key);

        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }

        file_put_contents($path, $env);
    }
}


//highlights the selected navigation on admin panel
if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}

if (! function_exists('get_string_between')) {
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
