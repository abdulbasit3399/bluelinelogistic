@php
    $user_role = auth()->user()->role;
    $admin  = 1;

    $otp_activation = false;
    if( get_setting('nexmo') == 1 || get_setting('ebernate') == 1 || get_setting('twillo') == 1  || get_setting('ssl_wireless') == 1   || get_setting('fast2sms') == 1 || get_setting('mimo') == 1){
        $otp_activation = true;
    }
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.shipping_rates') }}
@endsection

@section('content')

    <!--begin::Card-->
    <div class="mx-auto col-lg-12">
        <div class="mb-10 card">
            <div class="card-body">
                <div class="alert alert-info">
                    - Calculation equation = Default Costs or Custom Covered Area Cost + Extra fees for Kg + Extra Fees for Package Types
                    <br />

                </div>
            </div>
        </div>
        <form class="form-horizontal" action="{{ route('shipments.settings.fees.store') }}" id="kt_form_2" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <label class=" col-form-label">{{ __('cargo::view.default_shippment_cost_by_miles_or_fees') }}</label>
                </div>
                <div class="card-body">
                    <div class="radio-inline">
                        <label class="mr-5 checkbox">
                            <input type="radio" class="is_def_mile_or_fees" name="Setting[is_def_mile_or_fees]" @if(Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees')=='1') checked @endif value="1" />
                            <span class="mr-3"></span>
                            {{ __('cargo::view.miles') }}
                        </label>

                        <label class="checkbox">
                            <input type="radio" class="is_def_mile_or_fees" name="Setting[is_def_mile_or_fees]" @if(Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees')=='2' ) checked @endif value="2" />
                            <span class="mr-3"></span>
                            {{ __('cargo::view.fees') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-5 card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ __('cargo::view.default_missions_costs') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('cargo::view.default_pickup_mission_cost') }}:</label>
                                    <input type="text" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.default_pickup_mission_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_pickup_cost')}}" name="Setting[def_pickup_cost]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('cargo::view.default_supply_mission_cost') }}:</label>
                                    <input type="text" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.default_supply_mission_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_supply_cost')}}" name="Setting[def_supply_cost]" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mt-5 card">
                <div class="card-header">
                    <h5 class="mb-0 h6">
                            {{ __('cargo::view.default_costs_for_the_first_kg') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{ __('cargo::view.default_mile_cost') }}:</label>
                                    <input type="text" min="0" class="form-control" placeholder="{{ __('cargo::view.default_mile_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_mile_cost')}}" name="Setting[def_mile_cost]" required>
                                </div>

                                <div class="def_shiping_costs form-group col-md-4">
                                    <label>{{ __('cargo::view.default_shipping_cost') }}:</label>
                                    <input type="text" min="0" class="form-control" placeholder="{{ __('cargo::view.default_shipping_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost')}}" name="Setting[def_shipping_cost]" required>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>{{ __('cargo::view.default_tax') }}%:</label>
                                    <input type="text" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.default_tax') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_tax')}}" name="Setting[def_tax]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('cargo::view.default_insurance') }}:</label>
                                    <input type="text" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.default_insurance') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_insurance')}}" name="Setting[def_insurance]" required>
                                </div>

                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{ __('cargo::view.default_returned_mile_cost') }}:</label>
                                    <input type="text" min="0" class="form-control" placeholder="{{ __('cargo::view.default_returned_mile_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_mile_cost')}}" name="Setting[def_return_mile_cost]" required>
                                </div>

                                <div class="def_shiping_costs form-group col-md-4">
                                    <label>{{ __('cargo::view.default_returned_shipment_cost') }}:</label>
                                    <input type="text" min="0" class="form-control" placeholder="{{ __('cargo::view.default_returned_shipment_cost') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_cost')}}" name="Setting[def_return_cost]" required>
                                </div>
                            </div>
                            <hr>


                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ __('cargo::view.extra_costs_for_kg') }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="def_shiping_costs form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_shipping_cost_Kg') }}:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_shipping_cost_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost_gram')}}" name="Setting[def_shipping_cost_gram]" required>
                        </div>
                        <div class="def_mile_costs form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_mile_cost_Kg') }}:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_mile_cost_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_mile_cost_gram')}}" name="Setting[def_mile_cost_gram]" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_tax_Kg') }}%:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_tax_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_tax_gram')}}" name="Setting[def_tax_gram]">
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_insurance_Kg') }}:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_insurance_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_insurance_gram')}}" name="Setting[def_insurance_gram]" required>
                        </div>

                        <div class="def_shiping_costs form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_returned_shipment_cost_Kg') }}:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_returned_shipment_cost_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_cost_gram')}}" name="Setting[def_return_cost_gram]" required>
                        </div>
                        <div class="def_mile_costs form-group col-md-4">
                            <label>{{ __('cargo::view.fixed_returned_mile_cost_Kg') }}:</label>
                            <input type="text" min="0"  class="form-control" placeholder="{{ __('cargo::view.fixed_returned_mile_cost_Kg') }}" value="{{Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_mile_cost_gram')}}" name="Setting[def_return_mile_cost_gram]" required>
                        </div>

                    </div>

                </div>
            </div>
            <div class="mb-0 text-right form-group">
                <button type="submit" class="mt-2 btn btn-lg btn-success">{{ __('cargo::view.save') }}</button>
            </div>
        </form>

        <form class="form-horizontal" action="{{ route('countries.config.costs') }}" id="kt_form_1" method="GET" enctype="multipart/form-data">
            <div class="mt-5 card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ __('cargo::view.custom_costs_for_covered_areas') }}</h5>
                </div>

                <div class="card-body">
                    @if(count($covered_countries = Modules\Cargo\Entities\Country::where('covered',1)->get()))
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>{{ __('cargo::view.from_country') }}:</label>
                                <select name="from_country" class="form-control select-country" required>
                                    <option value=""></option>

                                    @foreach($covered_countries as $covered)
                                    <option value="{{$covered->id}}">{{$covered->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ __('cargo::view.to_country') }}:</label>
                                <select name="to_country" class="form-control select-country" required>
                                    <option value=""></option>
                                    @foreach($covered_countries as $covered)
                                    <option value="{{$covered->id}}">{{$covered->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ __('cargo::view.configure_costs') }}:</label>
                                <button class="btn btn-primary form-control">{{ __('cargo::view.configure_selected_countries_costs') }}</button>
                            </div>


                        </div>
                    @else
                        <div class="row">
                            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                                {{ __('cargo::view.please_configure_your_covered_countries_and_cities') }},
                                @if(auth()->user()->can('add-covered-countries') || $user_role == $admin)
                                    <a class="alert-link" href="{{ route('countries.index') }}">{{ __('cargo::view.configure_now') }}</a>
                                @else
                                    {{ __('cargo::view.configure_now') }}
                                @endif
                            </div>
                        </div>
                    @endif





                </div>
            </div>
        </form>

        <form class="form-horizontal" action="{{ route('post.config.package.costs') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-5 mb-10 card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ __('cargo::view.extra_fees_for_package_types') }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        @if(count($packages = Modules\Cargo\Entities\Package::all()))
                            <table class="table mb-0 aiz-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('cargo::view.table.name') }}</th>
                                        <th>{{ __('cargo::view.extra_cost') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $key => $package)
                                        <tr>
                                            <td>{{json_decode($package->name, true)[app()->getLocale()]}}:</td>
                                            <td>
                                                <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" required/>
                                                <input type="hidden" name="package_id[]" value="{{$package->id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td> <button class="btn btn-primary form-control">{{ __('cargo::view.save_package_types_extra_fees') }}</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                                {{ __('cargo::view.please_configure_package_types') }},
                                @if(auth()->user()->can('manage-packages') || $user_role == $admin)
                                    <a class="alert-link" href="{{ route('packages.index') }}">{{ __('cargo::view.configure_now') }}</a>
                                @else
                                    {{ __('cargo::view.configure_now') }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Card-->

@endsection

{{-- Inject styles --}}
@section('styles')
    <style>
        label {
            font-weight: bold !important;
        }
        .card-header{
            display: flex !important;
            align-items: center !important;
        }
        .form-control {
            margin-bottom: 15px !important;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script type="text/javascript">
        $('input[type=radio][class=is_def_mile_or_fees]:checked').each(function () {
            if(this.value == 1)
            {
                $(".def_mile_costs").css("display","block");
                $(".def_shiping_costs").css("display","none");

            }else if (this.value == 2){
                $(".def_mile_costs").css("display","none");
                $(".def_shiping_costs").css("display","block");
            }
        });

        $('input[type=radio][class=is_def_mile_or_fees]').change(function() {
            if(this.value == 1)
            {
                $(".def_mile_costs").css("display","block");
                $(".def_shiping_costs").css("display","none");

            }else if (this.value == 2){
                $(".def_mile_costs").css("display","none");
                $(".def_shiping_costs").css("display","block");
            }

        });
        $('.select-country').select2({
            placeholder: "Select country"
        });
        var inputs = document.getElementsByTagName('input');

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type.toLowerCase() == 'number') {
                inputs[i].onkeydown = function(e) {
                    if (!((e.keyCode > 95 && e.keyCode < 106) ||
                            (e.keyCode > 47 && e.keyCode < 58) ||
                            e.keyCode == 8)) {
                        return false;
                    }
                }
            }
        }
    </script>
@endsection
