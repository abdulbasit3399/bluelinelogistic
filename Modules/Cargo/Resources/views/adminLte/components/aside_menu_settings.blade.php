@php
$user_role = auth()->user()->role;
$admin = 1;
@endphp


@if (auth()->user()->can('add-covered-countries') || $user_role == $admin)
    <li class="nav-item  {{ areActiveRoutes(['countries.index'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('countries.index') }}"
            class="nav-link {{ areActiveRoutes(['countries.index'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-map-marked-alt fa-fw"></i>
            <p>{{ __('cargo::view.covered_places') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('manage-areas') || $user_role == $admin)
    <li class="nav-item {{ areActiveRoutes(['areas.index'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('areas.index') }}"
            class="nav-link {{ areActiveRoutes(['areas.index'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-directions fa-fw"></i>
            <p>{{ __('cargo::view.areas_management') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('manage-delivery-time') || $user_role == $admin)
    <li class="nav-item {{ areActiveRoutes(['deliveryTime.index'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('deliveryTime.index') }}"
            class="nav-link  {{ areActiveRoutes(['deliveryTime.index'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-clock fa-fw"></i>
            <p>{{ __('cargo::view.delivery_time') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('manage-packages') || $user_role == $admin)
    <li class="nav-item {{ areActiveRoutes(['packages.index'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('packages.index') }}"
            class="nav-link {{ areActiveRoutes(['packages.index'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-cubes fa-fw"></i>
            <p>{{ __('cargo::view.packages') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('shipping-rates') || $user_role == $admin)
    <li class="nav-item {{ areActiveRoutes(['shipments.settings.fees'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('shipments.settings.fees') }}"
            class="nav-link {{ areActiveRoutes(['shipments.settings.fees'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-dollar-sign fa-fw"></i>
            <p>{{ __('cargo::view.shipping_rates') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('shipping-settings') || $user_role == $admin)
    <li class="nav-item {{ areActiveRoutes(['shipments.settings'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('shipments.settings') }}"
            class="nav-link {{ areActiveRoutes(['shipments.settings'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-cog fa-fw"></i>
            <p>{{ __('cargo::view.shipping_settings') }}</p>
        </a>
    </li>
@endif
