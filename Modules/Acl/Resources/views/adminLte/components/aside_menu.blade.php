@admin
<li class="nav-item {{ areActiveRoutes(['roles.index' , 'roles.create'],'menu-is-opening menu-open active') }}">  
    <a href="#" class="nav-link  {{ areActiveRoutes(['roles.index' , 'roles.create'],'menu-is-opening menu-open active') }}">
        <i class="fas fa-universal-access fa-fw"></i>
        <p>
            {{ __('acl::view.access_control_level') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        {{-- role-lsit --}}
        <li class="nav-item">
            <a href="{{ fr_route('roles.index') }}" class="nav-link  {{ areActiveRoutes(['roles.index']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('acl::view.role_list') }}</p>
            </a>
        </li>

        {{-- role-create --}}
        <li class="nav-item">
            <a href="{{ fr_route('roles.create') }}" class="nav-link  {{ areActiveRoutes(['roles.create']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('acl::view.create_new_role') }}</p>
            </a>
        </li>
    </ul>
</li>
@endadmin
