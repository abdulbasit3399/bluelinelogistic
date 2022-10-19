<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/***********************************************************************************/
if (!function_exists('fr_route')) {
    /**
     * fr_route alternative route laravel
     * use to check on route if exists or no
     *
     * @param string $name
     * @param array $params
     * @return string.
     */
    function fr_route($name, $params = [], $absolute = true) {
        if (Route::has($name)) {
            return route($name, $params, $absolute);
        } else {
            return url('/');
        }
    }
}

/***********************************************************************************/
if (!function_exists('aurl')) {
    /**
     * aurl alternative url
     * use this in routes has prefix admin only
     *
     * @param string  $url -> route url.
     * @return string url has http.
     */
    function aurl($url = '/') {
        $url = $url == '/' ? '' : $url;
        $url = Str::start($url, '/');
        return url(env('PREFIX_ADMIN', 'admin') . $url);
    }
}


/***********************************************************************************/
if (!function_exists('active_url')) {
    /**
     * echo class active when match current url with url param.
     * @param string $url -> the url in an element you want an active.
     * @param string $class_name | Optional -> class active using in your style.
     * @return string class name when match url.
     * @example
     * <a class="menu-link {{ active_url(url('/home')) }}" href="{{ url('/home') }}"></a>
     */
    function active_url($url, $class_name = 'active') {
        if ($url == request()->url()) {
            return $class_name;
        }
        return '';
    }
}
/***********************************************************************************/

if (!function_exists('active_route')) {
    /**
     * echo class active when match current route url with route name param.
     * @param string $route_name -> the route name in an element you want an active.
     * @param array $params | Optional -> route params.
     * @param string $class_name | Optional -> class active using in your style.
     * @return string class name when match url.
     * @example
     * <a class="menu-link {{ active_route('home') }}" href="{{ route('home') }}"></a>
     */
    function active_route($route_name, $params = [], $class_name = 'active') {
        if (fr_route($route_name, $params) == request()->url()) {
            return $class_name;
        }
        return '';
    }
}

/***********************************************************************************/
if (!function_exists('active_uri')) {
    /**
     * echo class active when match current url with uri in param.
     * This for admin only
     * @param string $uri -> the uri in an element you want an active.
     * @param array $options {
     *     Optional. An array of arguments.
     *  @item $class_name class active using in your style.
     *  @item $recursive make this true if you want apply this on this uri or below.
     * }
     * @return string class name when match url.
     * @example
     * <a class="menu-link {{ active_uri('home') }}" href="{{ url('/home') }}"></a>
     */
    function active_uri($uri, $options = []) {
        $myOptions = [
            'recursive' => true,
            'index' => 2,
            'class_name' => 'active'
        ];
        if (!empty($options)) {
            $options = array_merge($myOptions, $options);
        } else {
            $options = $myOptions;
        }
        if ($options['recursive'] === true) {
            if ($uri === request()->segment($options['index'])) {
                return $options['class_name'];
            }
        } else if ($options['recursive'] === false) {
            if (aurl($uri) === request()->url()) {
                return $options['class_name'];
            }
        }
        return '';
    }
}
/***********************************************************************************/
if (!function_exists('active_uri_front')) {
    /**
     * echo class active when match current url with uri in param.
     * * This for frontend only
     * @param string $uri -> the uri in an element you want an active.
     * @param array $options {
     *     Optional. An array of arguments.
     *  @item $class_name class active using in your style.
     *  @item $recursive make this true if you want apply this on this uri or below.
     * }
     * @return string class name when match url.
     * @example
     * <a class="menu-link {{ active_uri('home') }}" href="{{ url('/home') }}"></a>
     */
    function active_uri_front($uri, $recursive = true, $indexSegment = 1, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === request()->segment($indexSegment)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === request()->url()) {
                return $class_name;
            }
        }
        return '';
    }
}