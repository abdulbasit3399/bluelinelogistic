@php
    $user_role  = auth()->user()->role;
    $date_now = \Carbon\Carbon::now()->format('d-m-Y');
    $userClient = Modules\Cargo\Entities\Client::where('user_id',auth()->user()->id)->first();

    $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.shipment_apis') }}
@endsection

@section('content')
    <div id="get-shipments">
        <div class="card">
            <div class="card-header bg-gray-50 p-2" id="heading2">
                <h5 class="mb-0" style="display: flex;align-items: center;padding-left: 2%;">
                    <button style="font-weight: 600;" class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        {{ __('cargo::view.get_all_shipments') }}
                    </button>
                </h5>
            </div>

            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#get-shipments">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label>{{ __('cargo::view.Endpoint') }}</label>
                        <div class="card gray border-0">
                            <div class="card-body gray border-0">
                                <span class="badge badge-info mr-3">Get</span>
                                <span id="base_url_get_shipments" class="text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-custom-container mb-4">
                        <table class="table table-hover ">
                            <thead style="background-color: #f7f7f7;">
                                <tr>
                                    <th scope="col">{{ __('cargo::view.parameters') }}</th>
                                    <th scope="col">{{ __('cargo::view.details') }}</th>
                                    <th scope="col">{{ __('cargo::view.description') }}</th>
                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>token</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <b>{{ __('cargo::view.NOTE') }}:</b> Send it in the header
                                        <p>    
                                            <u><b onClick="generate_token()">{{ __('cargo::view.click_to_reGenerate_token') }}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        <div style="width:270px" title="{{ __('cargo::view.copy') }}">
                                            <p style="display: inline; padding-right:3px" onClick="copy()" class="auth_token">{{auth()->user()->remember_token}}</p><b style="cursor: pointer;" onClick="copy()" id="copy">{{ __('cargo::view.copy') }}</b>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card">
            <div class="card-header bg-gray-50 p-2" id="headingOne">
                <h5 class="mb-0" style="display: flex;align-items: center;padding-left: 2%;">
                    <button style="font-weight: 600;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ __('cargo::view.add_shipment') }}
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label>{{ __('cargo::view.Endpoint') }}</label>
                        <div class="card gray border-0">
                            <div class="card-body gray border-0">
                                <span class="badge badge-info mr-3">Post</span>
                                <span id="base_url_create_shipment" class="text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-custom-container mb-4">
                        <table class="table table-hover ">
                            <thead style="background-color: #f7f7f7;">
                                <tr>
                                    <th scope="col">{{ __('cargo::view.parameters') }}</th>
                                    <th scope="col">{{ __('cargo::view.details') }}</th>
                                    <th scope="col">{{ __('cargo::view.description') }}</th>
                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>token</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <b>{{ __('cargo::view.NOTE') }}:</b> Send it in the header
                                        <p>    
                                            <u><b onClick="generate_token()">{{ __('cargo::view.click_to_reGenerate_token') }}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        <div style="width:270px" title="{{ __('cargo::view.copy') }}">
                                            <p style="display: inline; padding-right:3px" onClick="copy()" class="auth_token" id="auth-token">{{auth()->user()->remember_token}}</p><b style="cursor: pointer;" onClick="copy()" id="copy">{{ __('cargo::view.copy') }}</b>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Shipment[type]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>Pickup = 1 / Drop off = 2</td>
                                    <td>1 / 2</td>
                                </tr>
                                <tr>
                                    <td>Shipment[branch_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#branchs">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="branchs">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.branches') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($branches as $branch)
                                                                <tr>
                                                                    <td>{{$branch->name}}</td>
                                                                    <td>{{$branch->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($branches as $branch)
                                            {{$branch->id}} /
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[shipping_date]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>DD/MM/YYYY</td>
                                    <td>{{$date_now}}</td>
                                </tr>
                                <tr>
                                    <td>Shipment[client_phone]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_your_phone') }}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[client_address]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#addressess">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="addressess">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.your_addresses') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($addresses as $address)
                                                                <tr>
                                                                    <td>{{$address->address}}</td>
                                                                    <td>{{$address->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($addresses as $address)
                                            {{$address->id}} /
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[reciver_name]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[reciver_phone]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[reciver_address]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[from_country_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#countries">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="countries">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.countries') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($countries as $countrie)
                                                                <tr>
                                                                    <td>{{$countrie->name}}</td>
                                                                    <td>{{$countrie->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[to_country_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#countries">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[from_state_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#states">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="states">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.regions') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($states as $state)
                                                                <tr>
                                                                    <td>{{$state->name}}</td>
                                                                    <td>{{$state->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[to_state_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#states">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[from_area_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#areas">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="areas">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.areas') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.region_name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.area_name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.area_id') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($areas as $area)
                                                                <tr>
                                                                    <td>{{$area->state->name}}</td>
                                                                    <td>{{json_decode($area->name, true)[app()->getLocale()]}}</td>
                                                                    <td>{{$area->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[to_area_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#areas">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                    {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[payment_type]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>Postpaid = 1 / Prepaid = 2</td>
                                    <td>1 / 2</td>
                                </tr>
                                <tr>
                                    <td>Shipment[payment_method_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#payments">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="payments">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.payment_method') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($paymentSettings as $key => $gateway)
                                                                    @if($gateway)
                                                                        <tr>
                                                                            <td>{{$key}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipment[attachments_before_shipping]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][package_id]</td>
                                    <td>
                                        <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#packages">
                                            <u><b>{{ __('cargo::view.click_to_get_iD') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="packages">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.packages') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($packages as $package)
                                                                <tr>
                                                                    <td>{{json_decode($package->name, true)[app()->getLocale()]}}</td>
                                                                    <td>{{$package->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ __('cargo::view.table.id') }} ({{ __('cargo::view.example') }}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][description]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][qty]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_1') }}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][weight]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_1') }}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][length]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_1') }}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][width]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_1') }}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Package[package_index][height]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_1') }}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Shipment[amount_to_be_collected]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>{{ __('cargo::view.default_is_0') }}</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Shipment[order_id]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[delivery_time]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#deliveryTimes">
                                            <u><b>{{ __('cargo::view.click_to_get_value') }}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="deliveryTimes">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('cargo::view.delivery_times') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{ __('cargo::view.table.name') }}</th>
                                                                    <th scope="col">{{ __('cargo::view.value') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($deliveryTimes as $deliveryTime)
                                                                <tr>
                                                                    <td>{{json_decode($deliveryTime->name, true)[app()->getLocale()]}}</td>
                                                                    <td>{{$deliveryTime->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{ __('cargo::view.noting_found') }}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Shipment[collection_time]</td>
                                    <td>
                                        <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                                    </td>
                                    <td>-</td>
                                    <td>01:12:22 AM</td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Inject styles --}}
@section('styles')
    <style type="text/css">
        .card-header {
            background-color: #fcfcfc !important;
            padding:0px !important;
        }

        .btn-link {
            color: #2b2b2b !important;
        }
        .card-body{
            padding: 1.25rem !important;
        }

        label {
            display: inline-block !important;
            margin-bottom: .5rem !important;
        }

        .gray{
            background-color: #f7f7f7 !important;
        }

        .badge-info {
            color: hsla(188, 60%, 30%, 1) !important;
            background-color: #bbeff7 !important;
        }
        .badge-danger {
            color: hsla(354, 70%, 35%, 1) !important;
            background-color: hsla(354, 70%, 85%, 1) !important;
        }

        table {
            border: 2px solid #f2f2f2 !important;
        }

        th{
            font-size: 1.2rem !important;
            padding: 1.6rem !important;
        }

        td{
            font-size: 78% !important;
            padding: 1.6rem !important;
        }

        tr:hover td {
            background-color: #f7f7f7 !important ;    
        }
        p{
            cursor: pointer;
        }

    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
        var base_url = window.location.origin;
        document.getElementById("base_url_create_shipment").textContent = base_url + '/api/shipments/create' ;
        document.getElementById("base_url_get_shipments").textContent = base_url + '/api/shipments/get' ;

        function generate_token()
        {
            $('.auth_token').text("{{ __('cargo::view.generating') }}");
            $.get("{{route('shipments.generate-token')}}", function(data) {
                $('.auth_token').text(data);
                copy();
            });   
        }

        function copy() {
            document.getElementById("copy").textContent = "{{ __('cargo::view.copied') }}";
            var r = document.createRange();
            r.selectNode(document.getElementById("auth-token"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(r);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();  
            setTimeout(function(){
                document.getElementById("copy").textContent = "{{ __('cargo::view.copy') }}";
            }, 800);
        }

    </script>
@endsection