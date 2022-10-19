<!--begin::Aside-->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="margin-bottom: 30px;">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto brand-link" id="kt_aside_logo">
        <!--begin::Logo-->
        @php
            $model = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
        @endphp
        <a href="{{ aurl('/') }}" style="display: flex;justify-content: center;">
            <img src="{{ $model->getFirstMediaUrl('system_logo') ? $model->getFirstMediaUrl('system_logo') : asset('assets/lte/bll.png') }}" alt="Logo" style="height: 38px;" class="logo" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->getFirstMediaUrl('avatar')? auth()->user()->getFirstMediaUrl('avatar'): asset('assets/lte/media/avatars/blank.png') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} |
                    <span
                        class="badge {{ auth()->user()->role == 1 ? 'badge-light-success' : 'badge-light-primary' }} fw-bolder fs-8 px-2 py-1 ms-2">
                        {{ auth()->user()->user_role }}
                    </span>
                </a>
            </div>
        </div>

        <!--begin::Aside menu-->
        <nav class="mt-2" style="padding-bottom: 30px !important;">
            <!--begin::Aside Menu-->
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!--begin::Menu-->
                <li class="nav-item">
                    <a href="{{ fr_route('admin.dashboard') }}"
                        class="nav-link {{ areActiveRoutes(['admin.dashboard']) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            @lang('view.dashboard')
                        </p>
                    </a>
                </li>

                {{--  <li class="nav-header">@lang('view.pages')</li>  --}}

                @if (auth()->user()->can('manage-shipments') || in_array($user_role, [$admin, $client, $branch]))
                <li
                    class="nav-item  ">
                    <a href="#"
                        class="nav-link ">
                        <i class="fas fa-user"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <!-- Shipment Menu -->
                        @if (auth()->user()->can('manage-users') || in_array($user_role, [$admin, $client, $branch]))

                            {{--  <!-- shipment calc -->
                            @if (Modules\Cargo\Entities\ShipmentSetting::getVal('is_shipping_calc_required') == 1)
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.calculator') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.calculator']) }}">
                                        <i class="fas fa-calculator fa-fw"></i>
                                        <p>{{ __('cargo::view.shipping_calculator') }}</p>
                                    </a>
                                </li>
                            @endif  --}}

                            <!-- all shipments -->
                            <li class="nav-item">
                                <a href="{{ fr_route('users.index') }}"
                                    class="nav-link {{ areActiveRoutes(['users.index']) }}">
                                    <i class="fas fa-list fa-fw nav-icon"></i>
                                    <p>{{ __('User list') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('manage-users') || in_array($user_role, [$admin, $client, $branch]))

                            {{--  <!-- shipment calc -->
                            @if (Modules\Cargo\Entities\ShipmentSetting::getVal('is_shipping_calc_required') == 1)
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.calculator') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.calculator']) }}">
                                        <i class="fas fa-calculator fa-fw"></i>
                                        <p>{{ __('cargo::view.shipping_calculator') }}</p>
                                    </a>
                                </li>
                            @endif  --}}

                            <!-- all shipments -->
                            <li class="nav-item">
                                <a href="{{ fr_route('users.create') }}"
                                    class="nav-link {{ areActiveRoutes(['users.create']) }}">
                                    <i class="fas fa-plus fa-fw nav-icon"></i>
                                    <p>{{ __('Create new user') }}</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                @endif
                {{--  customers  --}}
                @if (auth()->user()->can('manage-shipments') || in_array($user_role, [$admin, $client, $branch]))
                <li
                    class="nav-item   ">
                    <a href="#"
                        class="nav-link   ">
                        <i class="fas fa-user"></i>
                        <p>
                            {{ __('Customers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('manage-users') || in_array($user_role, [$admin, $client, $branch]))

                            <!-- all shipments -->
                            <li class="nav-item">
                                <a href="{{ url('admin/shipment-team/clients') }}"
                                    class="nav-link {{ areActiveRoutes(['admin.shipment-team.clients']) }}">
                                    <i class="fas fa-list fa-fw nav-icon"></i>
                                    <p>{{ __('Customer list') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('manage-users') || in_array($user_role, [$admin, $client, $branch]))

                            {{--  <!-- shipment calc -->
                            @if (Modules\Cargo\Entities\ShipmentSetting::getVal('is_shipping_calc_required') == 1)
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.calculator') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.calculator']) }}">
                                        <i class="fas fa-calculator fa-fw"></i>
                                        <p>{{ __('cargo::view.shipping_calculator') }}</p>
                                    </a>
                                </li>
                            @endif  --}}

                            <!-- all shipments -->
                            <li class="nav-item">
                                <a href="{{ url('admin/shipment-team/clients/create') }}"
                                    class="nav-link {{ areActiveRoutes(['users.create']) }}">
                                    <i class="fas fa-plus fa-fw nav-icon"></i>
                                    <p>{{ __('Create new customer') }}</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                @endif
                {{--  end of customers  --}}
                @if (auth()->user()->can('manage-shipments') || in_array($user_role, [$admin, $client, $branch]))
                <li
                    class="nav-item {{ areActiveRoutes(['shipments.vault.index'],'menu-is-opening menu-open active') }} @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item) {{ areActiveRoutes([$item['route_name']], 'menu-is-opening menu-open active') }} @endforeach ">
                    <a href="{{ route('shipments.vault.index') }}"
                        class="nav-link {{ areActiveRoutes(['shipments.vault.index'],'menu-is-opening menu-open active') }} @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item) {{ areActiveRoutes([$item['route_name']], 'menu-is-opening menu-open active') }} @endforeach  ">
                        <i class="fa-solid fa-vault"></i>
                        <p>
                            Vault
                            {{--  <i class="right fas fa-angle-left"></i>  --}}
                        </p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('manage-shipments') || in_array($user_role, [$admin, $client, $branch]))
                <li
                    class="nav-item {{ areActiveRoutes(['shipments','shipments.create','shipments.import','shipments.add.api','shipments.barcode.scanner','shipment-calc','shipments.index'],'menu-is-opening menu-open active') }} @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item) {{ areActiveRoutes([$item['route_name']], 'menu-is-opening menu-open active') }} @endforeach ">
                    <a href="#"
                        class="nav-link {{ areActiveRoutes(['shipments','shipments.create','shipments.import','shipments.add.api','shipments.barcode.scanner','shipment-calc','shipments.index'],'menu-is-opening menu-open active') }} @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item) {{ areActiveRoutes([$item['route_name']], 'menu-is-opening menu-open active') }} @endforeach  ">
                        <i class="fas fa-box-open"></i>
                        <p>
                            {{ __('cargo::view.shipments') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <!-- Shipment Menu -->
                        @if (auth()->user()->can('manage-shipments') || in_array($user_role, [$admin, $client, $branch]))

                            <!-- create shipment -->
                            {{--  @if (auth()->user()->can('create-shipments') || in_array($user_role, [$admin, $client, $branch]))
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.create') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.create']) }}">
                                        <i class="fas fa-plus fa-fw"></i>
                                        <p>{{ __('cargo::view.create_new_shipment') }}</p>
                                    </a>
                                </li>
                            @endif  --}}


                            {{--  @if ($user_role == $client)
                                <!-- import shipment -->
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.import') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.import']) }}">
                                        <i class="fas fa-file-import fa-fw"></i>
                                        <p>{{ __('cargo::view.import_shipments') }}</p>
                                    </a>
                                </li>

                                <!-- shipment api -->
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.add.api') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.add.api']) }}">
                                        <i class="fas fa-plus fa-fw"></i>
                                        <p>{{ __('cargo::view.shipment_apis') }}</p>
                                    </a>
                                </li>
                            @endif  --}}

                            {{--  <!-- shipment barcode scanner -->
                            @if (auth()->user()->can('shipments-barcode-scanner') || $user_role == $admin)
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.barcode.scanner') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.barcode.scanner']) }}">
                                        <i class="fas fa-qrcode fa-fw"></i>
                                        <p>{{ __('cargo::view.barcode_scanner') }}</p>
                                    </a>
                                </li>
                            @endif  --}}

                            <!-- shipment calc -->
                            @if (Modules\Cargo\Entities\ShipmentSetting::getVal('is_shipping_calc_required') == 1)
                                <li class="nav-item">
                                    <a href="{{ fr_route('shipments.calculator') }}"
                                        class="nav-link {{ areActiveRoutes(['shipments.calculator']) }}">
                                        <i class="fas fa-calculator fa-fw"></i>
                                        <p>{{ __('cargo::view.shipping_calculator') }}</p>
                                    </a>
                                </li>
                            @endif

                            <!-- all shipments -->
                            <li class="nav-item">
                                <a href="{{ fr_route('shipments.index') }}"
                                    class="nav-link {{ areActiveRoutes(['shipments.index']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('cargo::view.all_Shipments') }}</p>
                                </a>
                            </li>


                            {{--  @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item)
                                @if (in_array($user_role, [$admin, $client, $branch]) ||
                auth()->user()->hasAnyDirectPermission($item['permissions']))
                                    @if ($item['status'] == Modules\Cargo\Entities\Shipment::SAVED_STATUS)
                                        <li class="nav-item">
                                            <a href="{{ route($item['route_name'], ['status' => $item['status'], 'type' => Modules\Cargo\Entities\Shipment::PICKUP]) }}"
                                                class="nav-link {{ active_route($item['route_name'], ['status' => $item['status'],'type' => Modules\Cargo\Entities\Shipment::PICKUP]) }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('cargo::view.saved_pickup') }}</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route($item['route_name'], ['status' => $item['status'],'type' => Modules\Cargo\Entities\Shipment::DROPOFF]) }}"
                                                class="nav-link {{ active_route($item['route_name'], ['status' => $item['status'],'type' => Modules\Cargo\Entities\Shipment::DROPOFF]) }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('cargo::view.saved_dropoff') }}</p>
                                            </a>
                                        </li>
                                    @elseif($item['status'] == Modules\Cargo\Entities\Shipment::REQUESTED_STATUS)
                                        <li class="nav-item">
                                            <a href="{{ route($item['route_name'], ['status' => $item['status'], 'type' => Modules\Cargo\Entities\Shipment::PICKUP]) }}"
                                                class="nav-link {{ active_route($item['route_name'], ['status' => $item['status'],'type' => Modules\Cargo\Entities\Shipment::PICKUP]) }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('cargo::view.requested_pickup') }}</p>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route($item['route_name'], ['status' => $item['status']]) }}"
                                                class="nav-link {{ active_route($item['route_name'], ['status' => $item['status']]) }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ $item['text'] }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach  --}}

                        @endif
                    </ul>
                </li>
                @endif

                {{--  @if (app('hook')->get('aside_menu'))
                    @foreach (aasort(app('hook')->get('aside_menu'), 'order') as $componentView)
                        {!! $componentView !!}
                    @endforeach
                @endif  --}}


                {{--  <li
                    class="nav-item {{ areActiveRoutes(['shipments.report','missions.report','clients.report','drivers.report','branches.report','transactions.report'],'menu-is-opening menu-open active') }}">

                    <a href="#"
                        class="nav-link  {{ areActiveRoutes(['shipments.report','missions.report','clients.report','drivers.report','branches.report','transactions.report'],'menu-is-opening menu-open active') }}">
                        <i class="fas fa-book fa-fw"></i>
                        <p>
                            {{ __('view.reports') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        @if (app('hook')->get('aside_menu_reports'))
                            @foreach (app('hook')->get('aside_menu_reports') as $componentView)
                                {!! $componentView !!}
                            @endforeach
                        @endif
                    </ul>

                </li>  --}}


                <li
                    class="nav-item ">

                    <a href="#"
                        class="nav-link  ">
                        <i class="fas fa-cogs fa-fw"></i>
                        <p>
                            {{ __('view.setting') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        @can('manage-setting')
                            <li class="nav-item">
                                <a href="{{ fr_route('admin.settings') }}"
                                    class="nav-link {{ areActiveRoutes(['admin.settings']) }}">
                                    <i class="fas fa-cog fa-fw"></i>
                                    <p>@lang('view.general_setting')</p>
                                </a>
                            </li>
                        @endcan


                        @if (app('hook')->get('aside_menu_settings'))
                            @foreach (app('hook')->get('aside_menu_settings') as $componentView)
                                {!! $componentView !!}
                            @endforeach
                        @endif


                        @can('manage-notifications-setting')
                            <li class="nav-item">
                                <a href="{{ fr_route('admin.settings.notifications') }}"
                                    class="nav-link {{ areActiveRoutes(['admin.settings.notifications']) }}">
                                    <i class="fa fa-bell fa-fw"></i>
                                    <p>@lang('view.notifications_settings')</p>
                                </a>
                            </li>
                        @endcan

                        @can('manage-google-setting')
                            <li class="nav-item">
                                <a href="{{ fr_route('admin.settings.google') }}"
                                    class="nav-link {{ areActiveRoutes(['admin.settings.google']) }}">
                                    <i class="fas fa-cog fa-fw"></i>
                                    <p>@lang('view.google_settings')</p>
                                </a>
                            </li>
                        @endcan

                        <!-- @can('manage-theme')
                            <li class="nav-item">
                                <a href="{{ fr_route('default-theme.edit') }}"
                                    class="nav-link {{ active_route('default-theme.edit') }}  {{ areActiveRoutes(['default-theme.edit']) }}">
                                    <i class="fab fa-affiliatetheme fa-fw"></i>
                                    <p>@lang('view.themes')</p>
                                </a>
                            </li>
                        @endcan -->

                        @can('manage-theme-setting')
                            <li class="nav-item">
                                <a href="{{ fr_route('theme-setting.edit', ['place' => 'homepage']) }}"
                                    class="nav-link {{ active_route('theme-setting.edit', ['place' => 'homepage']) }}  {{ areActiveRoutes(['theme-setting.edit']) }}">
                                    <i class="fab fa-affiliatetheme fa-fw"></i>
                                    <p>@lang('view.theme_setting')</p>
                                </a>
                            </li>
                        @endcan
                    </ul>

                </li>

                {{--  @if(auth()->user()->role == 1)
                    <li class="nav-item">
                        <a href="{{ fr_route('system.update') }}"
                            class="nav-link {{ areActiveRoutes(['system.update']) }}">
                            <i class="fa-brands fa-ubuntu fa-fw"></i>
                            <p>
                                @lang('view.system_update')
                            </p>
                        </a>
                    </li>
                @endif  --}}
                <!--end::Menu-->
            </ul>
            <!--end::Aside Menu-->
        </nav>
        <!--end::Aside menu-->
    </div>
</aside>
<!--end::Aside-->
