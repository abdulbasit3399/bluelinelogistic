@php
$user_role = auth()->user()->role;
$admin = 1;
@endphp

@if (auth()->user()->can('payments-settings') || $user_role == $admin)
    <li class="nav-item">
        <a href="{{ fr_route('payments.index') }}" class="nav-link {{ areActiveRoutes(['payments.index']) }}">
            <i class="fas fa-bahai fa-fw"></i>
            <p>{{ __('cargo::view.payments_settings') }}</p>
        </a>
    </li>
@endif
