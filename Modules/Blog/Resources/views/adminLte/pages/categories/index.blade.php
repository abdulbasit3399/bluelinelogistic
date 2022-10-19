@extends('blog::adminLte.layouts.master')

@section('pageTitle')
    {{ __('blog::view.category_list') }}
@endsection

@section('content')

@php
    $classColTable = auth()->user()->can('create-categories') ? 'col-lg-8' : 'col-12';
@endphp

<div class="row">
    @can('create-categories')
        <div class="col-lg-4">
            <div class="side-form">
                <!--begin:: Form Card-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{ __('view.create_new') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div>
                        <!--begin::Form-->
                        <form class="form" action="{{ fr_route('categories.store') }}" method="post" enctype="multipart/form-data">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @include('blog::adminLte.pages.categories.form', ['typeForm' => 'create'])
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2">{{ __('view.reset') }}</button>
                                <button type="submit" class="btn btn-sm btn-primary">@lang('view.create')</button>
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
    @endcan

    <div class="{{ $classColTable }}">
        <div class="side-table">
            <!--begin:: Table Card-->
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

                                {{-- End Custom Filters --}}
        
                            </x-table-filter>
                            <!--end::Filter-->
        
                            @can('export-table-categories')
                                <!-- ================== begin export buttons =============================== -->
                                @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                                <!-- ================== end export buttons =============================== -->
                            @endcan
        
                        </div>
                        <!--end::Toolbar-->
        
                        <!--begin::Group actions-->
                        @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                            'table_id' => $table_id,
                            'permission' => 'delete-categories',
                            'url' => fr_route('categories.multi-destroy'),
                            'callback' => 'reload-table',
                            'model_name' => __('blog::view.selected_categories')
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
            <!--end:: Table Card-->
        </div>
    </div>
</div>
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