@php
    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();
    $user_role = auth()->user()->role;
    $admin  = 1;
    $driver = 5;
    $code = filter_var($mission->code, FILTER_SANITIZE_NUMBER_INT);

    $mission_shipments = Modules\Cargo\Entities\ShipmentMission::where('mission_id',$mission->id)->get();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.mission').'-'. $mission->code }}
@endsection

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!-- begin::Card-->
        <div class="overflow-hidden card card-custom">
            <div class="p-0 card-body">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="px-8 py-8 row justify-content-center py-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="pb-10 d-flex justify-content-between pb-md-20 flex-column flex-md-row">
                            <h1 class="mb-10 display-4 font-weight-boldest">
                                @php 
                                    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
                                @endphp
                                <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                                {{ __('cargo::view.MISSION_DETAILS') }}
                            </h1>
                            <div class="px-0 d-flex flex-column align-items-md-end">
                                <!--begin::Logo-->
                                <a href="#">
                                    @if($code != null)
                                        @php
                                            echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($code, "C128") . '" alt="barcode"   />';
                                        @endphp
                                    @endif
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <br />
                                    <span><span class="font-weight-bolder">{{__('cargo::view.CREATED_DATE')}}:</span> {{$mission->created_at->format('Y-m-d')}}</span>
                                    <span><span class="font-weight-bolder">{{__('cargo::view.CODE')}}:</span> {{$mission->code}}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="pt-6 d-flex justify-content-between">
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.MISSION_TYPE')}}<span>
                                <span class="opacity-70 d-block">{{$mission->type}}</span>
                            </div>
                            @if($mission->type == Modules\Cargo\Entities\Mission::getType(Modules\Cargo\Entities\Mission::TRANSFER_TYPE) )
                                <div class="d-flex flex-column flex-root">
                                    <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.TRANSFER_TO_BRANCH')}}<span>
                                    <span class="opacity-70 d-block">{{$mission->to_branch->name}}</span>
                                </div>
                            @else
                                <div class="d-flex flex-column flex-root">
                                    <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.MISSION_ADDRESS')}}<span>
                                    <span class="opacity-70 d-block">{{$mission->address}}</span>
                                </div>
                            @endif
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.MISSION_STATUS')}}<span>
                                <span class="opacity-70 d-block text-{{Modules\Cargo\Entities\Mission::getStatusColor($mission->status_id)}}">{{$mission->getStatus()}}</span>
                            </div>
                            @if($mission->captain_id)
                                <div class="d-flex flex-column flex-root">
                                    <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.MISSION_Driver')}}<span>
                                    <span class="opacity-70 d-block">{{$mission->captain->name}}</span>
                                </div>
                            @endif
                            @if($due_date)
                                <div class="d-flex flex-column flex-root">
                                    <span class="mb-2 font-weight-bolder d-block">{{__('cargo::view.DUE_DATE')}}<span>
                                    <span class="opacity-70 d-block">{{$due_date ?? ""}}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                
                <div class="row justify-content-center py-md-10 px-md-0" style="padding: 4.25rem!important;">
                    <div class="col-12 row">
                        <div class="col-12">
                            <h1 class="mb-10 display-4 font-weight-boldest">{{__('cargo::view.mission_shipments').' ' }}({{count($mission_shipments)}})</h1>
                        </div>
                        @if(isset($reschedule))
                            <div class="text-right col-6">
                                <!-- Button trigger modal -->
                                <button type="button" class="mb-5 btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="modal_open">
                                    {{__('cargo::view.reschedule')}}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{__('cargo::view.reschedule')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('missions.reschedule') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$mission->id}}">
                                                <div class="text-left modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>{{__('cargo::view.reason')}}:</label>
                                                                
                                                                <select name="reason" class="form-control mb-4 captain_id kt-select2">
                                                                    @foreach ($reasons as $reason)
                                                                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>{{__('cargo::view.due_date')}}:</label>
                                                                <input type="text" id="kt_datepicker_3" autocomplete="off" class="form-control"  name="due_date"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cargo::view.close')}}</button>
                                                    <button type="submit" class="btn btn-primary">{{__('cargo::view.save')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{__('cargo::view.table.code')}}</th>
                                        <th class=" font-weight-bold text-muted text-uppercase">{{__('cargo::view.status')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{__('cargo::view.type')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{__('cargo::view.table.branch')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{__('cargo::view.client')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{__('cargo::view.payment_type')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">
                                            @if($mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                                {{__('cargo::view.COD_AMOUNT')}}
                                            @else
                                                {{__('cargo::view.TOTAL_COST')}}
                                            @endif
                                        </th>
                                        <th class="text-center font-weight-bold text-muted text-uppercase no-print">{{__('cargo::view.actions')}}</th>
                                        <th class="text-center font-weight-bold text-muted text-uppercase print-only">{{__('cargo::view.check')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($mission_shipments as $key=> $shipment_mission)
                                    <tr class="font-weight-boldest @if(in_array($shipment_mission->shipment->status_id ,[Modules\Cargo\Entities\Shipment::RETURNED_STATUS,Modules\Cargo\Entities\Shipment::RETURNED_STOCK,Modules\Cargo\Entities\Shipment::RETURNED_CLIENT_GIVEN])) table-danger @endif">
                                        <td  class="pl-5 pt-7" width="3%">{{ ($key+1) }}</td>
                                        @if(in_array($user_role ,[$admin,$driver]) || auth()->user()->can('view-shipments') )
                                            <td class="pl-5 pt-7"><a href="{{route('shipments.show', ['shipment'=>$shipment_mission->shipment->id])}}">{{$shipment_mission->shipment->code}}</a></td>
                                        @else
                                            <td class="pl-5 pt-7">{{$shipment_mission->shipment->code}}</td>
                                        @endif
                                        <td class="pl-5 pt-7">{{$shipment_mission->shipment->getStatus()}}</td>
                                        <td class="text-right pt-7">{{$shipment_mission->shipment->getType($shipment_mission->shipment->type)}}</td>
                                        <td class="text-right pt-7">{{$shipment_mission->shipment->branch->name}}</td>
                                        <td class="text-right  pt-7">{{$shipment_mission->shipment->client->name}}</td>
                                        <td class="text-right  pt-7">{{$shipment_mission->shipment->payment_method_id}} ({{$shipment_mission->shipment->getPaymentType()}})</td>

                                        @if($shipment_mission->shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID)
                                            <td class="text-right  pt-7">{{format_price($shipment_mission->shipment->amount_to_be_collected + $shipment_mission->shipment->tax + $shipment_mission->shipment->shipping_cost + $shipment_mission->shipment->insurance) }}</td>
                                        @elseif($shipment_mission->shipment->payment_type == Modules\Cargo\Entities\Shipment::PREPAID)

                                            @if($mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                                <td class="text-right  pt-7">{{format_price($shipment_mission->shipment->amount_to_be_collected) }}</td>
                                            @else
                                                <td class="text-right  pt-7">{{format_price($shipment_mission->shipment->tax + $shipment_mission->shipment->shipping_cost + $shipment_mission->shipment->insurance) }}</td>
                                            @endif

                                        @endif
                                        
                                        <td class="pr-5 text-right text-danger pt-7 no-print">
                                            @if(in_array($shipment_mission->mission->status_id , [Modules\Cargo\Entities\Mission::APPROVED_STATUS,Modules\Cargo\Entities\Mission::REQUESTED_STATUS,Modules\Cargo\Entities\Mission::RECIVED_STATUS]) && $shipment_mission->shipment->mission_id != null)
                                                <!-- Button trigger modal -->
                                                @if($mission->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)
                                                    @if($shipment_mission->mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                                    <a class="btn btn-success btn-sm mb-1" data-url="{{route('admin.missions.action.confirm_amount', ['mission_id' => $mission->id , 'shipment_id' => $shipment_mission->shipment->id ])}}" data-action="POST" onclick="openAjexedModel(this,event)" href="{{route('missions.show', $mission->id)}}" title="{{__('cargo::view.show')}}">
                                                        <i class="fa fa-check"></i> {{__('cargo::view.confirm_done')}}
                                                    </a>
                                                    @endif
                                                @endif

                                                <button type="button" class="px-3 mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter2" id="modal_open_delete_shipment" onclick="set_shipment_id({{$shipment_mission->shipment->id}})">
                                                    @if($shipment_mission->mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                                        {{__('cargo::view.return')}}
                                                    @else
                                                        {{__('cargo::view.remove_from')}} {{$mission->code}}
                                                    @endif
                                                </button>
                                                
                                            @else
                                                {{__('cargo::view.no_actions')}}
                                            @endif
                                        </td>
                                        <td class="text-center print-only"><input type="checkbox" class="form-control" /></td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="ajaxed-model" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">



                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    @if($mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                        {{__('cargo::view.return_shipment')}}
                                    @else
                                        {{__('cargo::view.remove_from')}} {{$mission->code}}
                                    @endif
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('shipments.delete-shipment-from-mission') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mission_id" value="{{$mission->id}}">
                                <input type="hidden" name="shipment_id" id="delete_shipment_id" value="">
                                <div class="text-left modal-body">
                                    @isset($reasons)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('cargo::view.reason')}}:</label>
                                                
                                                <select name="reason" class="form-control captain_id kt-select2" required>
                                                    @foreach ($reasons as $reason)
                                                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endisset
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cargo::view.close')}}</button>
                                    <button type="submit" class="btn btn-danger">
                                    @if($mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                        {{__('cargo::view.return')}}
                                    @else
                                        {{__('cargo::view.remove')}}
                                    @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- end: Invoice body-->
                @if($mission->type != Modules\Cargo\Entities\Mission::getType(Modules\Cargo\Entities\Mission::TRANSFER_TYPE)  )
                    <!-- begin: Invoice footer-->
                    <div class="px-8 py-8 bg-gray-100 row justify-content-center py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if($mission->status_id == Modules\Cargo\Entities\Mission::REQUESTED_STATUS || $mission->status_id == Modules\Cargo\Entities\Mission::APPROVED_STATUS || $mission->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)
                                                @if($mission->type == Modules\Cargo\Entities\Mission::getType(Modules\Cargo\Entities\Mission::SUPPLY_TYPE))
                                                    <th class="text-right font-weight-bold text-muted text-uppercase ">{{__('cargo::view.RETURN_AMOUNT')}}</th>
                                                @endif
                                            @endif

                                            @if($mission->type == Modules\Cargo\Entities\Mission::getType(Modules\Cargo\Entities\Mission::DELIVERY_TYPE))
                                                <th class="text-right font-weight-bold text-muted text-uppercase ">{{__('cargo::view.TOTAL_COD_AMOUNT')}}</th>
                                            @else
                                                <th class="text-right font-weight-bold text-muted text-uppercase ">{{__('cargo::view.TOTAL_COST')}}</th>
                                            @endif

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="font-weight-bolder">
                                            @if($mission->status_id == Modules\Cargo\Entities\Mission::REQUESTED_STATUS || $mission->status_id == Modules\Cargo\Entities\Mission::APPROVED_STATUS || $mission->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)
                                                @if($mission->type == Modules\Cargo\Entities\Mission::getType(Modules\Cargo\Entities\Mission::SUPPLY_TYPE))
                                                    <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($cod)}}</td>
                                                @endif
                                            @endif

                                            @if($mission->status_id == Modules\Cargo\Entities\Mission::DONE_STATUS && $mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                                <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($mission->amount)}}</td>
                                            @else
                                                <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($shipment_cost)}}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                @endif
                <!-- begin: Invoice action-->
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0 no-print">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{__('cargo::view.Print_Mission')}}</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
        <!-- end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

{{-- Inject styles --}}
@section('styles')
    <style media="print">
        .print-only{
            display: block;
        }
        .no-print, div#kt_header_mobile, div#kt_header, div#kt_footer{
            display: none;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
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

        function set_shipment_id(shipment_id){
            document.getElementById('delete_shipment_id').value = shipment_id;
        }
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
        $('#ajaxed-model').on('hidden.bs.modal', function () {
            $('#ajaxed-model .modal-content').empty();
        });
    </script>
@endsection