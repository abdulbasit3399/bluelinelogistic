{{--  dd('ali');  --}}
@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
    $client = 4;
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.shipment_list') }}
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
                @include('adminLte.components.modules.datatable.search', ['table_id' => $table_id ])
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
                            @include('cargo::adminLte.pages.shipments.table.filters.paid', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.table.filters.branch', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.table.filters.client', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.shipments.table.filters.payment_method', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.table.filters.type', ['table_id' => $table_id, 'filters' => $filters])
                            @include('cargo::adminLte.pages.shipments.table.filters.status', ['table_id' => $table_id, 'filters' => $filters])
                            <!-- ================== end Role filter =============================== -->
                            {{-- End Custom Filters --}}

                    </x-table-filter>
                    <!--end::Filter-->


                    @if(auth()->user()->can('export-table-shipments') || $user_role == $admin || $user_role == $branch || $user_role == $client)
                        <!-- ================== begin export buttons =============================== -->
                        @include('adminLte.components.modules.datatable.export', ['table_id' => $table_id, 'btn_exports' => $btn_exports])
                        <!-- ================== end export buttons =============================== -->
                    @endif

                    <!--begin::Add user-->
                    @if(auth()->user()->can('create-shipments') || $user_role == $admin || $user_role == $branch || $user_role == $client)
                        <a href="{{ fr_route('shipments.create') }}" class="btn btn-primary m-1">{{ __('cargo::view.add_shipment') }}</a>
                    @endif
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                @if(count($actions) > 0)

                    <!--begin::More actions -->
                    @section('more-actions')
                        @foreach($actions as $action)
                            @if(in_array(auth()->user()->role ,$action['user_role']) || auth()->user()->hasAnyDirectPermission($action['permissions']))
                                @if($action['index'] == true)
                                    <button
                                        type="button"
                                        data-url="{{ $action['url'] }}"
                                        data-action="approve"
                                        data-method="{{ $action['method'] }}"
                                        data-callback="reload-table"
                                        data-table-id="{{ isset($table_id) ? $table_id : '' }}"
                                        data-model-name="{{__('cargo::view.selected_shipments')}}"
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
                    @include('cargo::adminLte.pages.shipments.columns.checkbox-actions', [
                        'table_id' => $table_id,
                        'actions' => $actions,
                        'permission' => 'delete-shipments',
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


    <form id="tableFormDeliveryMission">
        @csrf()

    </form>
    <!-- Create Mission Modal -->
    <form id="tableForm">
        @csrf()
        <div id="assign-to-captain-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    @if(isset($status))
                    <input type="hidden" name="checked_ids" class="checked_ids" />
                        @if($status == Modules\Cargo\Entities\Shipment::SAVED_STATUS || $status == Modules\Cargo\Entities\Shipment::REQUESTED_STATUS)
                            <div class="modal-header">
                                <h4 class="modal-title h6">{{ __('cargo::view.create_pickup_mission') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="Mission[to_branch_id]" class="form-control branch_hidden" />
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.client_sender') }}:</label>
                                            <input type="hidden" name="Mission[client_id]" value="" id="pick_up_client_id_hidden">
                                            <select class="form-control" id="pick_up_client_id" disabled>
                                                @foreach( Modules\Cargo\Entities\Client::all() as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.pickup_address') }}:</label>
                                            <input type="text" name="Mission[address]" class="form-control" id="pick_up_address" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.type') }}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.pickup') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.status') }}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.requested') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @elseif($status == Modules\Cargo\Entities\Shipment::DELIVERED_STATUS)
                            <div class="modal-header">
                                <h4 class="modal-title h6">{{__('cargo::view.create_supply_mission') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="Mission[to_branch_id]" class="form-control branch_hidden" />
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.client_sender') }}:</label>
                                            <input type="hidden" name="Mission[client_id]" value="" id="pick_up_client_id_hidden">
                                            <select name="Mission[client_id]" class="form-control" id="pick_up_client_id" disabled>
                                                @foreach(Modules\Cargo\Entities\Client::all() as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.supply_address') }}:</label>
                                            <input type="text" name="Mission[address]" class="form-control" id="supply_address" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.type')}}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.supply') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{ __('cargo::view.status')}}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.requested') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @elseif($status == Modules\Cargo\Entities\Shipment::RETURNED_STOCK || $status == Modules\Cargo\Entities\Shipment::APPROVED_STATUS)
                            <div class="modal-header">
                                <h4 class="modal-title h6">{{__('cargo::view.create_return_mission') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.client_sender') }}:</label>
                                            <input type="hidden" name="Mission[client_id]" value="" id="pick_up_client_id_hidden">
                                            <select name="Mission[client_id]" class="form-control" id="pick_up_client_id" disabled>
                                                @foreach(Modules\Cargo\Entities\Client::all() as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.address') }}:</label>
                                            <input type="text" id="return_address" name="Mission[address]" class="form-control" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.type')}}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.return') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label>{{__('cargo::view.status')}}:</label>
                                            <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.requested') }}" disabled="disabled" readonly />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cargo::view.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('cargo::view.create_mission') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- Create Delivery Mission Modal -->
        <div id="create-delivery-mission-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" name="checked_ids" class="checked_ids" />
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{__('cargo::view.create_delivery_mission') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{__('cargo::view.type') }}:</label>
                                    <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.delivery') }}" disabled="disabled" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{__('cargo::view.status') }}:</label>
                                    <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{__('cargo::view.requested') }}" disabled="disabled" readonly />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cargo::view.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('cargo::view.create_mission') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- Transfer To Branch Modal -->
        <div id="transfer-to-branch-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title h6">{{__('cargo::view.create_transfer_mission') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('cargo::view.from_branch') }}:</label>
                                    <input style="background:#f3f6f9;color:#3f4254;" id="from_branch_transfer" type="text" class="form-control mb-4 disabled" value="{{__('cargo::view.transfer') }}" disabled="disabled" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('cargo::view.to_branch') }}:</label>

                                    <select name="Mission[to_branch_id]" id="to_branch_id" class="form-control mb-4 change-branch kt-select2">
                                        @foreach(Modules\Cargo\Entities\Branch::where('is_archived', 0)->get() as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cargo::view.type') }}:</label>
                                    <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control mb-4 disabled" value="{{__('cargo::view.transfer') }}" disabled="disabled" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cargo::view.status') }}:</label>
                                    <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control mb-4 disabled" value="{{__('cargo::view.requested') }}" disabled="disabled" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cargo::view.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('cargo::view.create_mission') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <script>
        $('.change-branch').select2({
            placeholder: "{{__('cargo::view.select_branch')}}",
        });
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
                timeAlert = (_self$data = self.data('time-alert')) !== null && _self$data !== void 0 ? _self$data : _timerAlert;

            if(modalId){
                swal.close();
                var checkBoxSeleced = table.find('.checkbox-row:checked'),
                    idsSelected = [],
                    clientsIdsSelected = [],
                    paymentMethodsSelected = [],
                    clientAddressNamesSelected = [],
                    reciverAddressesSelected = [],
                    branchesIdsSelected = [],
                    branchesNamesSelected = [],
                    missionsSelected = [];


                // get all Data selected
                checkBoxSeleced.each(function(e, ele) {
                    var id = $(ele).data('row-id')
                    var client_id = $(ele).data('row-client-id')
                    var client_address_name = $(ele).data('row-client-address-name')
                    var payment_method = $(ele).data('row-payment-method')
                    var reciver_address = $(ele).data('row-reciver-address')
                    var branch_id = $(ele).data('row-branch-id')
                    var branch_name = $(ele).data('row-branch-name')
                    var mission_id = $(ele).data('row-mission-id')

                    idsSelected.push(id)
                    clientsIdsSelected.push(client_id)
                    clientAddressNamesSelected.push(client_address_name)
                    paymentMethodsSelected.push(payment_method)
                    reciverAddressesSelected.push(reciver_address)
                    branchesIdsSelected.push(branch_id)
                    branchesNamesSelected.push(branch_name)
                    missionsSelected.push(mission_id)
                })

                var count_payment_method = 0 ;
                var count_branches = 0 ;
                if (clientsIdsSelected.length != 0)
                {
                    if(modalTitle != "{{__('cargo::view.print_barcodes')}}")
                    {
                        if(missionsSelected[0] == ""){

                            var sum = clientsIdsSelected.reduce(function(acc, val) { return acc + val; },0);
                            var check_sum = clientsIdsSelected[0] * clientsIdsSelected.length;

                            if (clientsIdsSelected.length == 1 || sum == check_sum || modalTitle == "{{__('cargo::view.create_delivery_mission')}}" || modalTitle == "{{__('cargo::view.transfer_to_branch')}}" ) {
                                paymentMethodsSelected.forEach((element, index) => {
                                    if(paymentMethodsSelected[0] == paymentMethodsSelected[index]){
                                        count_payment_method++;
                                    }
                                });
                                if(paymentMethodsSelected.length == count_payment_method || modalTitle == "{{__('cargo::view.transfer_to_branch')}}")
                                {

                                    if(modalTitle == "{{__('cargo::view.create_delivery_mission')}}"){
                                        $('#create-delivery-mission-modal').modal('toggle');
                                    }else if(modalTitle == "{{__('cargo::view.transfer_to_branch')}}"){
                                        branchesIdsSelected.forEach((element, index) => {
                                            if(branchesIdsSelected[0] == branchesIdsSelected[index]){
                                                count_branches++;
                                            }
                                        });

                                        if(branchesIdsSelected.length == count_branches){
                                            document.getElementById("from_branch_transfer").value = branchesNamesSelected[0];
                                            $("#to_branch_id option[value="+ branchesIdsSelected[0] +"]").each(function() {
                                                $(this).remove();
                                            });
                                            $('#transfer-to-branch-modal').modal('toggle');
                                        }else{
                                            Swal.fire("{{__('cargo::view.select_shipments_of_the_same_branch_to_transfer')}}", "", "error");
                                        }

                                    }else{
                                        $('#assign-to-captain-modal').modal('toggle');
                                    }

                                    $('#tableForm').attr('action', url);
                                    $('#tableForm').attr('method', method);
                                    $('#pick_up_address').val(clientAddressNamesSelected[0]);
                                    $('#supply_address').val(clientAddressNamesSelected[0]);
                                    $('#return_address').val(clientAddressNamesSelected[0]);
                                    $('#pick_up_client_id').val(clientsIdsSelected[0]);
                                    $('#pick_up_client_id_hidden').val(clientsIdsSelected[0]);
                                    $('.branch_hidden').val(branchesIdsSelected[0]);
                                    $('.checked_ids').val(JSON.stringify(idsSelected))
                                }else{
                                    Swal.fire("{{__('cargo::view.select_shipments_of_the_same_payment_method')}}", "", "error");
                                }
                            } else if (clientsIdsSelected.length == 0) {
                                Swal.fire("{{__('cargo::view.please_select_shipments')}}", "", "error");
                            }else{
                                Swal.fire("{{__('cargo::view.select_shipments_of_the_same_client_to_assign')}}", "", "error");
                            }

                        }else{
                            Swal.fire("{{__('cargo::view.this_shipment_already_in_mission')}}", "", "error");
                        }
                    }else{
                        $('#tableForm').attr('action', url);
                        $('#tableForm').attr('method', method);
                        $('.checked_ids').val(JSON.stringify(idsSelected));
                        $("#tableForm").submit();
                    }

                }else{
                    Swal.fire("{{ __('cargo::view.please_select_shipments') }}", "", "error");
                }
            }
        });
    </script>
    <script src="{{ asset('assets/js/notify.js') }}"></script>

@endsection
