@can('manage-users')
    {{-- {{ areActiveRoutes(['users', ['class_name' => 'show']]) }} --}}
    <li class="nav-item {{ areActiveRoutes(['users.index', 'users.create'], 'menu-is-opening menu-open active') }}">
        <a href="#"
            class="nav-link {{ areActiveRoutes(['users.index', 'users.create'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-user"></i>
            <p>
                {{ __('users::view.users') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            <!-- Branch list -->
            @if (auth()->user()->can('view-users') || $user_role == $admin)
                <li class="nav-item">
                    <a href="{{ fr_route('users.index') }}" class="nav-link {{ areActiveRoutes(['users.index']) }}">
                        <i class="fas fa-list fa-fw"></i>
                        <p>{{ __('users::view.user_list') }}</p>
                    </a>
                </li>
            @endif

            <!-- Create new branch -->
            @if (auth()->user()->can('create-users') || $user_role == $admin)
                <li class="nav-item">
                    <a href="{{ fr_route('users.create') }}" class="nav-link {{ areActiveRoutes(['users.create']) }}">
                        <i class="fas fa-plus fa-fw"></i>
                        <p>{{ __('users::view.create_new_user') }}</p>
                    </a>
                </li>
            @endif

        </ul>
    </li>
@endcan
