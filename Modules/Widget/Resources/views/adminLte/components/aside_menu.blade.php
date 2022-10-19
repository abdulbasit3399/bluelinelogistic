@can('view-widgets')
    <li class="nav-item">
        <a href="{{ fr_route('widgets.index') }}" class="nav-link {{ areActiveRoutes(['widgets.index']) }}">
            <i class="fas fa-box fa-fw"></i>
            <p>
                {{ __('widget::view.widgets') }}
            </p>
        </a>
    </li>
@endcan
