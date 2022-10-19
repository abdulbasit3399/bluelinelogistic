@can('view-pages')
    <li class="nav-item">
        <a href="{{ fr_route('pages.index') }}" class="nav-link  {{ areActiveRoutes(['pages.index']) }}">
            <i class="fas fa-pager fa-fw"></i>
            <p>{{ __('pages::view.pages') }}</p>
        </a>
    </li>
@endcan
