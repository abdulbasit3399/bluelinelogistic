@extends('cargo::adminLte.layouts.master')

@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
@endphp


@section('pageTitle')
    {{ __('users::view.manage_address') }} - {{ $model->name }}
@endsection


@section('content')
    <div class="col-lg-12">
        <div class="side-form">
            <!--begin:: Form Card-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h5 class="fw-bolder m-0">{{ __('cargo::view.set_default_addresses') }}</h5>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div>
                    <!--begin::Form-->
                    <form class="form" id="kt_account_profile_details_form" class="form" action="{{ fr_route('clients.manageAddressUpdata') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <select class="form-control aiz-selectpicker" data-control="select2" data-allow-clear="true" name="address_id" >
                                @foreach ($client_addresses as $item)

                                    <option value="{{$item->id}}" @if ($item->is_default == 1 ) selected @endif>
                                        {{ $item->address }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" value="{{ $item->client_id }}" name="client_id" >
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-success" id="kt_account_profile_details_submit">@lang('view.update')</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end:: Form Card-->
        </div>
    </div>

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
                            @include('cargo::adminLte.pages.clients.table.country', ['table_id'=>$table_id, 'filters' => $filters])
                            <!-- ================== end Role filter =============================== -->
                            {{-- End Custom Filters --}}
                    </x-table-filter>
                    <!--end::Filter-->


                        <!-- ================== begin export buttons =============================== -->
                        @include('adminLte.components.modules.datatable.export', ['table_id'=>$table_id, 'btn_exports' => $btn_exports])
                        <!-- ================== end export buttons =============================== -->


                    <!--begin::Add user-->
                        {{-- <a href="{{ fr_route('clients.create') }}" class="btn btn-primary m-1">{{ __('cargo::view.add_client') }}</a> --}}
                        <a href="{{ route('new_address') }}" class="btn btn-primary m-1">{{ __('cargo::view.add_address') }}</a>

                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                {{-- <!--begin::Group actions--> --}}
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [ 'table_id'=>$table_id, 'permission' => 'delete-customers', 'url' => fr_route('clients.multi-destroy'), 'callback' => 'reload-table', 'model_name' => __('cargo::view.selected_clients') ])
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
