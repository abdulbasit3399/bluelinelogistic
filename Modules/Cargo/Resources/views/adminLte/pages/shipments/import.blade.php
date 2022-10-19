@php
    $user_role = auth()->user()->role;
    $date_now = \Carbon\Carbon::now()->format('d-m-Y');

    $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.import_shipments') }}
@endsection

@section('content')

<div class="mx-auto mb-5 col-lg-12">

        <div class="alert alert-danger" role="alert">
            {{ __('cargo::view.please_be_sure_shipments_have_right_branch') }}.
        </div>

        <div class="card mb-5">
            <div class="card-header" style="display: flex;align-items: center;">
                <h5 style="display: inline;">{{ __('cargo::view.shipment_CSV_Import') }}</h5>

                <a href="{{ asset('import_shipment.csv') }}" style="float: right;" class="btn btn-sm btn-primary">{{ __('cargo::view.download_CSV') }}</a>

            </div>
            <div class="card-body">
                <form class="form-horizontal" id="kt_form_1" action="{{ route('shipments.import_parse') }}" method="POST" enctype="multipart/form-data">
                	@csrf

                    <div class="form-group mb-5 d-none">
                        <label>{{ __('cargo::view.columns') }}:</label>
                        <select class="@error('columns') is-invalid @enderror form-control select-items selectpicker" name="columns[]" multiple required>
                            <option value="type" selected>type</option>
                            <option value="branch_id" selected>branch_id</option>
                            <option value="shipping_date" selected>shipping_date</option>
                            <option value="client_phone" selected>client_phone</option>
                            <option value="client_address" selected>client_address</option>
                            <option value="reciver_name" selected>reciver_name</option>
                            <option value="reciver_phone" selected>reciver_phone</option>
                            <option value="reciver_address" selected>reciver_address</option>
                            <option value="from_country_id" selected>from_country_id</option>
                            <option value="to_country_id" selected>to_country_id</option>
                            <option value="from_state_id" selected>from_state_id</option>
                            <option value="to_state_id" selected>to_state_id</option>
                            <option value="from_area_id" selected>from_area_id</option>
                            <option value="to_area_id" selected>to_area_id</option>
                            <option value="payment_type" selected>payment_type</option>
                            <option value="payment_method_id" selected>payment_method_id</option>
                            <option value="attachments_before_shipping" selected>attachments_before_shipping</option>
                            <option value="package_id" selected>package_id</option>

                            <option value="description" selected>description</option>
                            <option value="qty" selected>qty</option>
                            <option value="weight" selected>weight</option>
                            <option value="length" selected>length</option>
                            <option value="width" selected>width</option>
                            <option value="height" selected>height</option>

                            <option value="amount_to_be_collected" selected>amount_to_be_collected</option>
                            <option value="order_id" selected>order_id</option>
                            <option value="delivery_time" selected>delivery_time</option>
                            <option value="collection_time" selected>collection_time</option>
                        </select>
                        @error('columns') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group mb-5">
                        <label for="shipments_file" class="col-md-12 control-label">{{ __('cargo::view.CSV_file_to_import') }}</label>

                        <div class="col-md-12">
                            <input id="shipments_file" type="file" class="form-control @error('shipments_file') is-invalid @enderror" name="shipments_file" required>

                            @error('shipments_file') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-0 text-right form-group">
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('cargo::view.parse_CSV') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-4 col-lg-12 card table-responsive table-custom-container">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">{{ __('cargo::view.parameters') }}</th>
                        <th scope="col">{{ __('cargo::view.details') }}</th>
                        <th scope="col">{{ __('cargo::view.description') }}</th>
                        <th scope="col">{{ __('cargo::view.value') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>type</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>Pickup = 1 / Drop off = 2</td>
                        <td>1 / 2</td>
                    </tr>
                    <tr>
                        <td>branch_id</td>
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
                        <td>shipping_date</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>DD/MM/YYYY</td>
                        <td>{{$date_now}}</td>
                    </tr>
                    <tr>
                        <td>client_phone</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_your_phone') }}</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>client_address</td>
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
                        <td>reciver_name</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>reciver_phone</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>reciver_address</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>from_country_id</td>
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
                        <td>to_country_id</td>
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
                        <td>from_state_id</td>
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
                        <td>to_state_id</td>
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
                        <td>from_area_id</td>
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
                        <td>to_area_id</td>
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
                        <td>payment_type</td>
                        <td>
                            <span class="badge badge-danger">{{ __('cargo::view.required') }}</span>
                        </td>
                        <td>Postpaid = 1 / Prepaid = 2</td>
                        <td>1 / 2</td>
                    </tr>
                    <tr>
                        <td>payment_method_id</td>
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
                                                        <td colspan="2">{{ __('cargo::view.noting_found') }}</td>
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
                        <td>attachments_before_shipping</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>package_id</td>
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
                        <td>description</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>qty</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_1') }}</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>weight</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_1') }}</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>length</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_1') }}</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>width</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_1') }}</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>height</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_1') }}</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>amount_to_be_collected</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>{{ __('cargo::view.default_is_0') }}</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>order_id</td>
                        <td>
                            <span class="badge badge-info">{{ __('cargo::view.optional') }}</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>delivery_time</td>
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
                        <td>collection_time</td>
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

@endsection

{{-- Inject styles --}}
@section('styles')
    <style type="text/css">

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
        $('.select-items').select2({ placeholder: "{{ __('cargo::view.choose_country') }}" });
    </script>
@endsection