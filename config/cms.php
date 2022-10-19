<?php
use App\Providers\RouteServiceProvider;

    return [


        // user roles
        'user_roles' => [
            '0' => 'User',
            '1' => 'Admin'
        ],

        'datatable_length' => [
            [ 10, 25, 50, 75, 100, 250, 500, -1 ],
            [ 10, 25, 50, 75, 100, 250, 500, 'All' ]
        ],
        

        'breadcrumb' => [],

        // 'breadcrumb-dashboard' => [
        //     'name' => 'Home',
        //     // 'path' => RouteServiceProvider::HOME,
        // ],


        // this key to caching only, Don't delete it and don't put any value in it. 
        'settings' => [],

        
    ];