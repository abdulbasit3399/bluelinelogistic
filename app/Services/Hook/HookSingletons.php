<?php
namespace App\Services\Hook;

use App\Hook\GlobalHook;

class HookSingletons {


    /**
     * How to use global hook?
     * 
     * Global hook support to type: object, array.
     * type object is default
     * 
     * Type array Example:
     * This example to add component from blog module to menu module:
     * Type this code in: Modules\Blog\Providers\BlogServiceProvider @boot
     
        $select_category_menu_components = view('blog::components.select_category_to_menu');
        $select_post_menu_components = view('blog::components.select_post_to_menu');
        app('hook')->set('menu_addables', $select_category_menu_components, 'array');
        app('hook')->set('menu_addables', $select_post_menu_components, 'array');

     * Use hook in menu module: 
     
        @if (app('hook')->get('menu_addables'))
            @foreach(app('hook')->get('menu_addables') as $componentView)
                {!! $componentView !!}
            @endforeach
        @endif


     * Type object Example:
     * Add this code in provider

        $select_branch_component = view(), html, text, json,... or any data
        app('hook')->set('select_branch', $select_branch_component);

     * Use hook to any module in views, controller or any place in code
     
        echo app('hook')->get('select_branch')
     */

    public function customSingleTons()
    {
        app()->singleton('hook', function () {
            $menuHook = new GlobalHook();
            return $menuHook;
        });

    }
}