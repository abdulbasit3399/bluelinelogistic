@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $auth_branch = 3;
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.all_missions') }}
@endsection

@section('content')

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
                            @include('cargo::adminLte.pages.missions.table.filters.type', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.missions.table.filters.status', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.table.filters.driver', ['table_id' => $table_id, 'filters' => $filters])
                            <!-- ================== end Role filter =============================== -->
                        {{-- End Custom Filters --}}
                    </x-table-filter>
                    <!--end::Filter-->
                    <!-- ================== begin export buttons =============================== -->
                    @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                    <!-- ================== end export buttons =============================== -->
                </div>
                <!--end::Toolbar-->

                @if(count($actions) > 0)

                    <!--begin::More actions -->
                    @section('more-actions')
                        @foreach($actions as $action)

                            @if(in_array(auth()->user()->role ,$action['user_role']) || auth()->user()->hasAnyDirectPermission($action['permission']))
                                @if($action['index'] == true)
                                    <button
                                        type="button"
                                        data-url="{{ $action['url'] }}"
                                        data-action="approve"
                                        data-method="{{ $action['method'] }}"
                                        data-callback="reload-table"
                                        data-table-id="{{ isset($table_id) ? $table_id : '' }}"
                                        data-model-name="{{__('cargo::view.selected_missions')}}"
                                        data-modal-action="{{__('cargo::view.send')}}"
                                        data-modal-message="{{__('cargo::view.modal_message_sure')}}"
                                        data-modal-title="{{$action['title']}}"
                                        data-time-alert="2000"
                                        data-multi-rows="true"
                                        class="btn-single-action btn btn-success me-2 @if(!isset($action['js_function_caller'])) action-caller @endif"
                                        @if(isset($action['js_function_caller'])) data-modal-id="true" onclick="swal.close()" @endif
                                    >
                                        {{$action['title']}}
                                    </button>
                                @endif
                            @endif
                        @endforeach
                    @endsection
                    <!--end::More actions-->

                    <!--begin::Group actions-->
                    @include('cargo::adminLte.pages.missions.columns.checkbox-actions', [
                        'table_id' => $table_id,
                        'actions' => $actions,
                        'permission' => 'delete-missions',
                        'url' => fr_route('shipments.multi-destroy'),
                        'callback' => 'reload-table',
                        'model_name' => __('cargo::view.selected_shipments')
                    ])
                    <!--end::Group actions-->
                @endif

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

    <form id="tableForm">
        @csrf()
        <!-- Mission Modal -->
        <div id="assign-to-captain-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                @if(isset($status))
                    <input type="hidden" name="checked_ids" class="form-control checked_ids" />
                    @if( $status == Modules\Cargo\Entities\Mission::REQUESTED_STATUS)
                        <div class="modal-header">
                            <h4 class="modal-title h6">{{__('cargo::view.assign_to_driver')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                @if($user_role !=  $auth_branch)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="display: block;">{{__('cargo::view.table.branch')}}:</label>
                                            <select id="change-branch" class="form-control mb-4 kt-select2">
                                                <option></option>
                                                @foreach(Modules\Cargo\Entities\Branch::where('is_archived', 0)->get() as $branch)
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="display: block;">{{__('cargo::view.driver')}}:</label>
                                            <select name="Mission[captain_id]" class="form-control mb-4 captain_id kt-select2">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>

                                @endif

                                @if($user_role == $auth_branch)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="display: block;">{{__('cargo::view.driver')}}:</label>

                                            <select name="Mission[captain_id]" class="form-control mb-4 captain_id kt-select2">
                                                @foreach(Modules\Cargo\Entities\Driver::where('is_archived', 0)->get() as $captain)
                                                <option value="{{$captain->id}}">{{$captain->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('cargo::view.due_date')}}:</label>
                                        <input type="text" id="kt_datepicker_3" autocomplete="off" class="form-control mb-4"  name="Mission[due_date]" value="{{ date('Y-m-d') }}"/>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cargo::view.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('cargo::view.send')}}</button>
                    </div>
                @endif
                </div>
            </div>
        </div><!-- /.modal -->
    </form>

    <!-- Ajaxed Models -->
    <div id="ajaxed-model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">



            </div>
        </div>
    </div><!-- /.modal -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{ $dataTable->scripts() }}

    <script>
        $('#change-branch').change(function() {

            var id = $(this).val();
            $.get("{{route('get-drivers-ajax')}}?branch_id=" + id, function(data) {
                $('select[name ="Mission[captain_id]"]').empty();
                $('select[name ="Mission[captain_id]"]').append('<option value=""></option>');
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    $('select[name ="Mission[captain_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                }
            });
            $('.captain_id').select2({
                placeholder: "{{__('cargo::view.select_driver')}}",
            })
        });
        $('#change-branch').select2({
            placeholder: "{{__('cargo::view.select_branch')}}",
        });
        $('.captain_id').select2({
            placeholder: "{{__('cargo::view.please_select_branch_first')}}",
        })
        function openAjexedModel(element,event)
        {
            event.preventDefault();
            show_ajax_loder_in_button(element);
            $.ajax({
                url: $(element).data('url'),
                type: 'get',
                success: function(response){
                // Add response in Modal body
                $('#ajaxed-model .modal-content').html(response);
                // Display Modal
                $('#ajaxed-model').modal('toggle');
                }
            });
        }
        function show_ajax_loder_in_button(element){
            $(element).bind('ajaxStart', function(){
                $(this).addClass('spinner spinner-darker-success spinner-left mr-3');
                $(this).attr('disabled','disabled');
            }).bind('ajaxStop', function(){
                $(this).removeClass('spinner spinner-darker-success spinner-left mr-3');
                $(this).removeAttr('disabled');
            });
        }

        var inputDate = $(`#kt_datepicker_3`);

        // Trigger date picker for Shipping Date
        inputDate.daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            autoUpdateInput: false,
            autoclose: true,
            minYear: parseInt(moment().format('YYYY')) - 10,
            maxYear: parseInt(moment().format('YYYY')) + 10,
            todayHighlight: true,
            startDate: new Date(),
            todayBtn: true,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "{{ __('view.cancel') }}",
                applyLabel: "{{ __('view.apply') }}",
                "fromLabel": "{{ __('view.from') }}",
                "toLabel": "{{ __('view.to') }}",
                "customRangeLabel": "{{ __('datepicker.custom_range') }}",
                "weekLabel": "{{ __('datepicker.week_label') }}",
                "daysOfWeek": [
                    "{{ __('datepicker.days_of_week.sunday') }}",
                    "{{ __('datepicker.days_of_week.monday') }}",
                    "{{ __('datepicker.days_of_week.tuesday') }}",
                    "{{ __('datepicker.days_of_week.wednesday') }}",
                    "{{ __('datepicker.days_of_week.thursday') }}",
                    "{{ __('datepicker.days_of_week.friday') }}",
                    "{{ __('datepicker.days_of_week.saturday') }}",
                ],
                "monthNames": [
                    "{{ __('datepicker.month_names.january') }}",
                    "{{ __('datepicker.month_names.february') }}",
                    "{{ __('datepicker.month_names.march') }}",
                    "{{ __('datepicker.month_names.april') }}",
                    "{{ __('datepicker.month_names.may') }}",
                    "{{ __('datepicker.month_names.june') }}",
                    "{{ __('datepicker.month_names.july') }}",
                    "{{ __('datepicker.month_names.august') }}",
                    "{{ __('datepicker.month_names.september') }}",
                    "{{ __('datepicker.month_names.october') }}",
                    "{{ __('datepicker.month_names.november') }}",
                    "{{ __('datepicker.month_names.december') }}",
                ],
            }
        }, cb);

        // call back after choose date
        function cb(start) {
            var apiDate = start ? start.format("YYYY-MM-DD H:m") : '';
            var inputShowDate = start ? (start.format("YYYY-MM-DD")) : '';
            if (start) {
                inputDate.val(inputShowDate);
            }
        }

        $('body').on('click', '.btn-single-action', function (e) {
            var _self$data;

            e.preventDefault();
            var self = $(this),
                url = self.data('url'),
                method = self.data('method'),
                action = self.data('action'),
                callback = self.data('callback'),
                modelName = self.data('model-name'),
                modalMessage = self.data('modal-message'),
                modalAction = self.data('modal-action'),
                modalTitle = self.data('modal-title'),
                modalId = self.data('modal-id'),
                tableId = self.data('table-id'),
                requestDataParent = $("#".concat(tableId, "_selected_component")).attr('data-request-data'),
                requestDataSelf = self.attr('data-request-data'),
                multiRows = self.data('multi-rows'),
                timeAlert = (_self$data = self.data('time-alert')) !== null && _self$data !== void 0 ? _self$data : _timerAlert,
                idsSelected = [];

            if(modalId){
                swal.close();

                // get all Data selected
                checkBoxSeleced.each(function(e, ele) {
                    var id = $(ele).data('row-id')
                    idsSelected.push(id)
                })

                console.log(idsSelected);
                $('#tableForm').attr('action', url);
                $('#tableForm').attr('method', method);
                $('.checked_ids').val(JSON.stringify(idsSelected))
                $('#assign-to-captain-modal').modal('toggle');
            }

        });
    </script>
@endsection
