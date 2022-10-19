<x-base-layout>

    <x-slot name="pageTitle">
        {{ __('acl::view.role_list') }}
    </x-slot>

    {{-- Content --}}

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
                                <!-- Create Filters -->
                        <!-- ================== end Role filter =============================== -->

                        {{-- End Custom Filters --}}

                    </x-table-filter>
                    <!--end::Filter-->


                    <!--begin::Add role-->
                        <a href="{{ route('roles.create') }}" class="btn btn-primary m-1">{{ __('acl::view.add_role') }}</a>
                    <!--end::Add role-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    'url' => route('roles.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('acl::view.selected_roles')
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


{{-- Inject styles --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{ $dataTable->scripts() }}
@endsection



</x-base-layout>

