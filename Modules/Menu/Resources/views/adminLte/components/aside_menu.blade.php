@can('view-menus')
    <li class="nav-item">
        <a href="{{ fr_route('menus.index') }}" class="nav-link   {{ areActiveRoutes(['menus.index']) }}">
            <i class="fas fa-list fa-fw"></i>
            <p>{{ __('menu::view.menus') }}</p>
        </a>
    </li>
@endcan
 