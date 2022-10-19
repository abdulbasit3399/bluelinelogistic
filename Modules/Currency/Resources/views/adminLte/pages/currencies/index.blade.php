@extends('currency::adminLte.layouts.master')

@section('pageTitle')
    {{ __('currency::view.currencies') }}
@endsection

@section('content')

@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
    $classColTable = ($user_role == 1 || auth()->user()->can('create-currencies')) ? 'col-lg-12' : 'col-12';
@endphp

<div class="row">
    @if(auth()->user()->can('set-default-currency') || $user_role == $admin )
        <div class="col-lg-12">
            <div class="side-form">
                <!--begin:: Form Card-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{ __('currency::view.systemd_default_currency') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div>
                        <!--begin::Form-->
                        <form class="form" action="{{ fr_route('currency.update_default_currency') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">

                                <select class="form-control aiz-selectpicker" 
                                    data-control="select2"
                                    data-allow-clear="true"
                                    name="system_default_currency"
                                >
                                    @foreach ($active_currencies as $key => $currency)
                                        <option value="{{ $currency->id }}" @if( $currency->default == 1)  selected @endif >{{ $currency->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-sm btn-primary">@lang('view.save')</button>
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
    @endif
    @if(auth()->user()->can('create-currencies') || $user_role == $admin )
        <div class="col-lg-12">
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
                        <form class="form" action="{{ fr_route('currencies.store') }}" method="post" enctype="multipart/form-data">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @include('currency::adminLte.pages.currencies.form', ['typeForm' => 'create'])
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
    @endif

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
        
                            @if(auth()->user()->can('export-table-currencies') || $user_role == $admin )
                                <!-- ================== begin export buttons =============================== -->
                                @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                                <!-- ================== end export buttons =============================== -->
                            @endif
        
                        </div>
                        <!--end::Toolbar-->
        
                        <!--begin::Group actions-->
                        @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                            'table_id' => $table_id,
                            'permission' => 'delete-currencies',
                            'url' => fr_route('currencies.multi-destroy'),
                            'callback' => 'reload-table',
                            'model_name' => __('currency::view.selected_currencies')
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

    <script>
        function update_currency_status(el){
            var id = $(el).data('row-id');
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('{{ route('currency.update_status') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                if(data == 1){
                    Swal.fire("{{ __('currency::messages.saved') }}", "", "");
                }
                else{
                    Swal.fire("{{ __('currency::messages.something_wrong') }}", "", "");
                }
            });
        }
    </script>
@endsection