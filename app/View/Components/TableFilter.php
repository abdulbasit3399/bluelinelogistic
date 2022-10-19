<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableFilter extends Component
{

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */ 
    public function render()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.components.modules.datatable.filters.menu-filter-layout');
    }
}
