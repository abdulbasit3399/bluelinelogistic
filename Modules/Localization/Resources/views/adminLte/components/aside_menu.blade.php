@can('view-languages')
    <li class="nav-item">
        <a href="{{ fr_route('languages.index') }}" class="nav-link {{ areActiveRoutes(['languages.index']) }}">
            <i class="fas fa-language fa-fw"></i>
            <p>{{ __('localization::view.localization') }}</p>
        </a>
    </li>
@endcan
