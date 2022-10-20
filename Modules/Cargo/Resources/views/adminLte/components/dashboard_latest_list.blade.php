@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $staff  = 0;
    $auth_branch = 3;
    $auth_client = 4;
    $auth_driver = 5;

    $count = (Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') ? Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') : 10 );
    if($user_role == $admin || $user_role == $staff){
        if($user_role == $admin || auth()->user()->can('manage-shipments')){
            $shipments = Modules\Cargo\Entities\Shipment::where('type','!=',3)->limit($count)->orderBy('id','desc')->get();
        }
        if($user_role == $admin || auth()->user()->can('manage-drivers')){
            $captains  = Modules\Cargo\Entities\Driver::withCount(['transaction AS wallet' => function ($query) { $query->select(DB::raw("SUM(value)")); }])->get();
        }
    }elseif($user_role == $auth_branch){
        $branch_id = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
        $shipments = Modules\Cargo\Entities\Shipment::where([['branch_id', $branch_id],['type','!=',3]])->limit($count)->orderBy('id','desc')->get();
        $captains  = Modules\Cargo\Entities\Driver::where('branch_id', $branch_id)->withCount(['transaction AS wallet' => function ($query) { $query->select(DB::raw("SUM(value)")); }])->get();
    }elseif($user_role == $auth_client){
        $client_id = Modules\Cargo\Entities\Client::where('user_id',auth()->user()->id)->pluck('id')->first();
        $shipments = Modules\Cargo\Entities\Shipment::limit($count)->orderBy('id','desc')->where([['client_id',$client_id],['type','!=',3]])->get();
    }elseif($user_role == $auth_driver){
        $driver_id = Modules\Cargo\Entities\Driver::where('user_id',auth()->user()->id)->pluck('id')->first();
    }
@endphp

@if(in_array($user_role ,[$admin,$auth_branch,$auth_client]) || auth()->user()->can('manage-shipments') )
    <div class="col-md-12">
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('cargo::view.latest_shipments') }}</h3>
                </div>
            </div>
            <div class="card-body">

                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>{{ __('cargo::view.table.code') }}</th>
                            <th>{{ __('cargo::view.status') }}</th>
                            <th>{{ __('cargo::view.table.type') }}</th>
                            <th>{{ __('cargo::view.client') }}</th>

                            @if($user_role != $auth_branch)
                                <th>{{ __('cargo::view.table.branch') }}</th>
                            @endif

                            <th>{{ __('cargo::view.shipping_cost') }}</th>
                            <th>{{ __('cargo::view.payment_method') }}</th>
                            <th>{{ __('cargo::view.shipping_date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shipments as $key=>$shipment)
                        <tr>

                            <td width="5%"><a href="{{route('shipments.show',$shipment->id)}}">{{$shipment->code}}</a></td>
                            <td>{{$shipment->getStatus()}}</td>
                            <td>{{$shipment->type}}</td>
                            <td>
                                {{--  @if(in_array($user_role ,[$admin,$auth_branch]) || auth()->user()->can('manage-customers') )
                                    <a href="{{route('clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a>
                                @else
                                    {{$shipment->client->name}}
                                @endif  --}}
                            </td>
                            {{--  @if($user_role != $auth_branch)
                                @if( in_array($user_role ,[$admin]) || auth()->user()->can('manage-branches') )
                                    <td><a href="{{route('branches.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>
                                @else
                                    <td>{{$shipment->branch->name}}</td>
                                @endif
                            @endif  --}}

                            <td>{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}</td>
                            <td>{{$shipment->payment_method_id}}</td>
                            <td>{{$shipment->shipping_date}}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!--end::Card-->
    </div>
@endif

{{--  @if(in_array($user_role ,[$admin,$auth_branch]) || auth()->user()->can('manage-drivers') )
    <div class="col-md-12">
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('cargo::view.drivers_wallet') }}</h3>
                </div>
            </div>
            <div class="card-body">

                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>{{ __('cargo::view.table.code') }}</th>
                            <th>{{ __('cargo::view.table.name') }}</th>
                            <th>{{ __('cargo::view.wallet') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($captains as $key=>$captain)

                            @php
                                $captain->wallet = abs($captain->wallet);
                            @endphp

                            @if($captain->wallet > 0 ?? 0)
                                <tr>
                                    <td><a href="{{route('drivers.show',$captain->id)}}">{{$captain->code}}</a></td>
                                    <td>{{$captain->name}}</td>
                                    <td>{{format_price($captain->wallet)}}</td>
                                </tr>
                            @endif

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!--end::Card-->

    </div>
    <div class="col-md-12">
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('cargo::view.drivers_custody') }}</h3>
                </div>
            </div>
            <div class="card-body">


                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>{{ __('cargo::view.table.code') }}</th>
                            <th>{{ __('cargo::view.status') }}</th>
                            <th>{{ __('cargo::view.table.type') }}</th>
                            <th>{{ __('cargo::view.client') }}</th>

                            @if($user_role != $auth_branch)
                                <th>{{ __('cargo::view.table.branch') }}</th>
                            @endif

                            <th>{{ __('cargo::view.shipping_cost') }}</th>
                            <th>{{ __('cargo::view.payment_method') }}</th>
                            <th>{{ __('cargo::view.shipping_date') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($captains as $key=>$captain)
                            @php
                                $count      = (Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') ? Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                                $shipments  = Modules\Cargo\Entities\Shipment::where([['captain_id', $captain->id],['type','!=',3]])->limit($count)->orderBy('id','desc')->get();
                            @endphp
                            @foreach($shipments as $key=>$shipment)
                                <tr>
                                    <td width="5%"><a href="{{route('shipments.show',$shipment->id)}}">{{$shipment->code}}</a></td>
                                    <td>{{$shipment->getStatus()}}</td>
                                    <td>{{$shipment->type}}</td>
                                    <td>
                                        @if(in_array($user_role ,[$admin,$auth_branch]) || auth()->user()->can('manage-customers') )
                                            <a href="{{route('clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a>
                                        @else
                                            {{$shipment->client->name}}
                                        @endif
                                    </td>
                                    @if($user_role != $auth_branch)
                                        @if( in_array($user_role ,[$admin]) || auth()->user()->can('manage-branches') )
                                            <td><a href="{{route('branches.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>
                                        @else
                                            <td>{{$shipment->branch->name}}</td>
                                        @endif
                                    @endif

                                    <td>{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}</td>
                                    <td>{{$shipment->payment_method_id}}</td>
                                    <td>{{$shipment->shipping_date}}</td>

                                </tr>
                            @endforeach
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!--end::Card-->

    </div>
@endif  --}}

@if($user_role == $auth_driver)
    <div class="col-md-12">
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('cargo::view.current_manifest') }}</h3>
                </div>
            </div>
            <div class="card-body">

                @php
                    $missions  = Modules\Cargo\Entities\Mission::where('captain_id',$driver_id)->whereNotIn('status_id', [\Modules\Cargo\Entities\Mission::DONE_STATUS, \Modules\Cargo\Entities\Mission::CLOSED_STATUS])->where('due_date',Carbon\Carbon::today()->format('Y-m-d'))->get();
                @endphp

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="3%"></th>
                                <th>{{ __('cargo::view.table.code') }}</th>
                                <th>{{ __('cargo::view.table.type') }}</th>
                                <th>{{ __('cargo::view.amount') }}</th>
                                <th>{{ __('cargo::view.table.address') }}</th>
                                <th>{{ __('cargo::view.arrived') }}</th>


                            </tr>
                        </thead>
                        <tbody id="profile_manifest">

                            @foreach($missions as $key=>$mission)

                            <tr style="background-color:tomatom">
                                <td></td>
                                <td width="5%">{{$mission->code}}</td>
                                <td>{{$mission->type}}</td>
                                @php
                                    $helper = new Modules\Cargo\Http\Helpers\TransactionHelper();
                                    $mission_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);
                                @endphp
                                <td>{{format_price($mission_cost)}}</td>
                                <td>{{$mission->address}}</td>
                                <td>
                                    <div style="width: 55%;height: 30px;border: 1px solid;border-radius: 3px;"></div>
                                </td>


                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--end::Card-->
    </div>

    <div class="col-md-12">
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('cargo::view.active_missions') }}</h3>
                </div>
            </div>
            <div class="card-body">

                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>{{ __('cargo::view.table.code') }}</th>
                            <th>{{ __('cargo::view.status') }}</th>
                            <th>{{ __('cargo::view.table.type') }}</th>
                            <th>{{ __('cargo::view.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $count      = (Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') ? Modules\Cargo\Entities\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                            $missions = Modules\Cargo\Entities\Mission::limit($count)->orderBy('id','desc')->where('captain_id',$driver_id)->whereNotIn('status_id', [\Modules\Cargo\Entities\Mission::DONE_STATUS, \Modules\Cargo\Entities\Mission::CLOSED_STATUS])->where('due_date', \Carbon\Carbon::today()->format('Y-m-d'))->get();
                        @endphp
                        @foreach($missions as $key=>$mission)

                        <tr>
                            <td width="5%"><a href="{{route('missions.show',$mission->id)}}">{{$mission->code}}</a></td>
                            <td>{{$mission->getStatus()}}</td>
                            <td>{{$mission->type}}</td>
                            @php
                                $helper = new Modules\Cargo\Http\Helpers\TransactionHelper();
                                $mission_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);
                            @endphp
                            <td>{{format_price($mission_cost)}}</td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!--end::Card-->
    </div>
@endif
