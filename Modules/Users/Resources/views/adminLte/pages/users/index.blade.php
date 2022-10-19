{{--  @extends('users::adminLte.layouts.master')  --}}
@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('users::view.user_list') }}
@endsection

@section('content')
<div class="container mt-4">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">

                <!--begin::Search-->
                {{-- search table --}}
                @include('adminLte.components.modules.datatable.search', ['table_id' => $table_id])
                <!--end::Search-->

            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap align-items-center" id="{{ $table_id }}_custom_filter">
                    {{-- data table length --}}
                    @include('adminLte.components.modules.datatable.datatable_length', ['table_id' => $table_id])
                    {{-- btn reload table --}}
                    @include('adminLte.components.modules.datatable.reload', ['table_id' => $table_id])

                    <!--begin::Filter-->
                    <x-table-filter :table_id="$table_id" :filters="$filters">
                        {{-- Start Custom Filters --}}
                        <!-- ================== begin Role filter =============================== -->
                                    @include('users::adminLte.pages.users.table.filters.role', ['table_id' => $table_id, 'filters' => $filters])
                                    @include('users::adminLte.pages.users.table.filters.name', ['table_id' => $table_id, 'filters' => $filters])
                        <!-- ================== end Role filter =============================== -->
                        {{-- End Custom Filters --}}
                        </x-table-filter>
                    <!--end::Filter-->

                    @can('export-table-users')
                        <!-- ================== begin export buttons =============================== -->
                        @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                        <!-- ================== end export buttons =============================== -->
                    @endcan

                    <!--begin::Add user-->
                    @can('create-users')
                        <a href="{{ fr_route('users.create') }}" class="btn btn-primary m-1">{{ __('users::view.add_user') }}</a>
                    @endcan
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    'permission' => 'delete-users',
                    'url' => fr_route('users.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('users::view.selected_users')
                ])
                <!--end::Group actions-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->


        <!--begin::Card body-->
        <div class="card-body pt-6">

            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->


        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
@endsection


@section('toolbar-btn')
    <!--begin::Button-->
    {{-- <a href="{{ fr_route('users.create') }}" class="btn btn-sm btn-primary">Create <i class="ms-2 fas fa-plus"></i> </a> --}}
    <!--end::Button-->
@endsection


{{-- Inject styles --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{ $dataTable->scripts() }}
@endsection
