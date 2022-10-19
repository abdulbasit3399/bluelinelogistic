@extends('blog::adminLte.layouts.master')

@section('pageTitle')
    {{ __('blog::view.post_list') }}
@endsection

@section('content')
    
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

                    @can('export-table-posts')
                        <!-- ================== begin export buttons =============================== -->
                        @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                        <!-- ================== end export buttons =============================== -->
                    @endcan

                    <!--begin::Add post-->
                    @can('create-posts')
                        <a href="{{ fr_route('posts.create') }}" class="btn btn-primary m-1">{{ __('blog::view.add_post') }}</a>
                    @endcan
                    <!--end::Add post-->

                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    'permission' => 'delete-posts',
                    'url' => fr_route('posts.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('blog::view.selected_posts')
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