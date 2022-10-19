@can('manage-blog-setting')
    <li class="nav-item">
        <a href="{{ fr_route('admin.blog_settings') }}" class="nav-link {{ areActiveRoutes(['admin.blog_settings']) }}">
            <i class="fab fa-blogger-b fa-fw"></i>
            <p>
                {{ __('blog::view.blog_settings') }}
            </p>
        </a>
    </li>
@endcan
