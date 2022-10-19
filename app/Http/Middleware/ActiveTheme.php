<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Qirolab\Theme\Theme;
use Session;

class ActiveTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $active_theme = preg_replace('/[^A-Za-z0-9\-]/', '', get_general_setting('active_theme')); // Removes special chars.
        if(env('DEMO_MODE') == 'On'){
            $demo_theme = Session::get('demo_theme');
            if($demo_theme && $demo_theme != null){
                $active_theme = $demo_theme;
            }
        }
        Theme::set($active_theme);
        return $next($request);
    }
}
