<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.layout.base');
    }
}
