@php
    $user_role = auth()->user()->role;
    $admin = 1;
    $staff = 0;
    $branch = 3;
    $client = 4;
    $driver = 5;
@endphp

@if (auth()->user()->can('shipments-report') || in_array($user_role, [$admin, $client, $branch]) )
    <li class="nav-item  {{ areActiveRoutes(['shipments.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('shipments.report') }}"
            class="nav-link {{ areActiveRoutes(['shipments.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-box-open fa-fw"></i>
            <p>{{ __('cargo::view.shipments_report') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('missions-report') || in_array($user_role, [$admin, $branch]) )
    <li class="nav-item  {{ areActiveRoutes(['missions.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('missions.report') }}"
            class="nav-link {{ areActiveRoutes(['missions.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-shipping-fast fa-fw"></i>
            <p>{{ __('cargo::view.missions_report') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('transactions-report') || in_array($user_role, [$admin, $branch, $client, $driver]) )
    <li class="nav-item  {{ areActiveRoutes(['transactions.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('transactions.report') }}"
            class="nav-link {{ areActiveRoutes(['transactions.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-money-check-alt fa-fw"></i>
            <p>{{ __('cargo::view.transactions_report') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('branches-report') || in_array($user_role, [$admin]) )
    <li class="nav-item  {{ areActiveRoutes(['branches.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('branches.report') }}"
            class="nav-link {{ areActiveRoutes(['branches.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-map-marked-alt fa-fw"></i>
            <p>{{ __('cargo::view.branches_report') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('clients-report') || in_array($user_role, [$admin, $branch]) )
    <li class="nav-item  {{ areActiveRoutes(['clients.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('clients.report') }}"
            class="nav-link {{ areActiveRoutes(['clients.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-user-friends fa-fw"></i>
            <p>{{ __('cargo::view.clients_report') }}</p>
        </a>
    </li>
@endif

@if (auth()->user()->can('drivers-report') || in_array($user_role, [$admin, $branch]) )
    <li class="nav-item  {{ areActiveRoutes(['drivers.report'], 'menu-is-opening menu-open active') }}">
        <a href="{{ fr_route('drivers.report') }}"
            class="nav-link {{ areActiveRoutes(['drivers.report'], 'menu-is-opening menu-open active') }}">
            <i class="fas fa-list fa-fw"></i>
            <p>{{ __('cargo::view.drivers_report') }}</p>
        </a>
    </li>
@endif