@php
$user_role = auth()->user()->role;
$admin = 1;
@endphp

@if (auth()->user()->can('manage-currencies') || $user_role == $admin)
    <li class="nav-item">
        <a href="{{ fr_route('currencies.index') }}" class="nav-link {{ areActiveRoutes(['currencies.index']) }}">
            <i class="fas fa-money-bill-alt fa-fw"></i>
            <p>{{ __('cargo::view.currencies') }}</p>
        </a>
    </li>
@endif
