@can('manage-blog')

    {{--  <li
        class="nav-item  {{ areActiveRoutes(['posts.index', 'posts.create', 'categories.index', 'tags.index', 'comments.index'],'menu-is-opening menu-open active') }}">
        <a href="#"
            class="nav-link  {{ areActiveRoutes(['posts.index', 'posts.create', 'categories.index', 'tags.index', 'comments.index'],'menu-is-opening menu-open active') }}   ">
            <i class="fas fa-blog fa-fw"></i>
            <p>
                {{ __('blog::view.blog') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <!-- create posts -->
            @can('view-posts')
                <li class="nav-item">
                    <a href="{{ fr_route('posts.index') }}" class="nav-link {{ areActiveRoutes(['posts.index']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('blog::view.posts') }}</p>
                    </a>
                </li>
            @endcan

            <!-- create post -->
            @can('create-posts')
                <li class="nav-item">
                    <a href="{{ fr_route('posts.create') }}" class="nav-link {{ areActiveRoutes(['posts.create']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('blog::view.create_new_post') }}</p>
                    </a>
                </li>
            @endcan

            <!-- categories -->
            @can('view-categories')
                <li class="nav-item">
                    <a href="{{ fr_route('categories.index') }}"
                        class="nav-link {{ areActiveRoutes(['categories.index']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('blog::view.categories') }}</p>
                    </a>
                </li>
            @endcan

            <!-- tags -->
            @can('view-tags')
                <li class="nav-item">
                    <a href="{{ fr_route('tags.index') }}" class="nav-link {{ areActiveRoutes(['tags.index']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('blog::view.tags') }}</p>
                    </a>
                </li>
            @endcan

            <!-- comments -->
            @can('view-comments')
                <li class="nav-item">
                    <a href="{{ fr_route('comments.index') }}" class="nav-link {{ areActiveRoutes(['comments.index']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('blog::view.comments') }}</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>  --}}
@endcan
