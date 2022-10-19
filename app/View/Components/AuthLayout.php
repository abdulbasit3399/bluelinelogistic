<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.auth.layout');
    }
}
