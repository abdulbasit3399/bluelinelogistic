@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.transactions_report') }}
@endsection

@section('content')

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">


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
                    <x-table-filter :table_id="$table_id" :filters="$filters" >
                        {{-- Start Custom Filters --}}
                                <!-- ================== begin State filter =============================== -->
                                @include('cargo::adminLte.pages.table.filters.branch', ['table_id' => $table_id, 'filters' => $filters])
                                @include('cargo::adminLte.pages.table.filters.client', ['table_id' => $table_id, 'filters' => $filters])
                                @include('cargo::adminLte.pages.table.filters.driver', ['table_id' => $table_id, 'filters' => $filters])

                                @if (auth()->user()->can('manage-transactions') || in_array($user_role, [$admin, $branch]) )
                                    @include('cargo::adminLte.pages.transactions.table.transaction_owner', ['table_id' => $table_id, 'filters' => $filters])
                                @endif
                                <!-- ================== end State filter =============================== -->
                        {{-- End Custom Filters --}}
                    </x-table-filter>
                    <!--end::Filter-->

                    <!-- ================== begin export buttons =============================== -->
                    @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                    <!-- ================== end export buttons =============================== -->

                </div>
                <!--end::Toolbar-->

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
