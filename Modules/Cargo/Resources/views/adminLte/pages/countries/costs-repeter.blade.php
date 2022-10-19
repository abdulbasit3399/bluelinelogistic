@php
    $user_role = auth()->user()->role;
    $admin  = 1;

    $default_country_cost = Modules\Cargo\Entities\Cost::where('from_country_id',$from->id)->where('to_country_id',$to->id)->where('from_state_id',0)->where('to_state_id',0)->first();
    $is_def_mile_or_fees = Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees');
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.package_list') }}
@endsection

@section('content')
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ __('cargo::view.from') }}: ( {{$from->name}} ) | {{ __('cargo::view.to') }}: ( {{$to->name}})</h5>
        </div>
        <form class="form-horizontal" action="{{ route('post.countries.config.costs') }}?from_country={{$from->id}}&to_country={{$to->id}}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('cargo::view.from_country') }}:</label>
                                <input disabled readonly class="form-control disabled" value="{{$from->name}}">
                                <input type="hidden" name="from_country_h[]" value="{{$from->id}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('cargo::view.to_country') }}:</label>
                                <input disabled readonly class="form-control disabled" value="{{$to->name}}">
                                <input type="hidden" name="to_country_h[]" value="{{$to->id}}">
                            </div>

                            @if( $is_def_mile_or_fees == '1')
                                <div class="form-group col-md-3">
                                    <label>{{ __('cargo::view.mile_cost') }}:</label>
                                    <input type="number" onchange="changeShippingCosts(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->mile_cost)){echo ($default_country_cost->mile_cost);}else{ echo 0;} @endphp" name="mile_cost[]">
                                </div>
                            @elseif($is_def_mile_or_fees == '2' )
                                <div class="form-group col-md-3">
                                    <label>{{ __('cargo::view.shipping_cost') }}:</label>
                                    <input type="number" onchange="changeShippingCosts(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->shipping_cost)){echo ($default_country_cost->shipping_cost);}else{ echo 0;} @endphp" name="shipping_cost[]">
                                </div>
                            @endif
                            <div class="form-group col-md-3">
                                <label>{{ __('cargo::view.tax') }}%:</label>
                                <input type="number" onchange="changeTax(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->tax)){echo $default_country_cost->tax;}else{ echo 0;} @endphp" name="tax[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('cargo::view.insurance') }}:</label>
                                <input type="number" onchange="changeInsurance(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->insurance)){echo ($default_country_cost->insurance);}else{ echo 0;} @endphp" name="insurance[]">
                            </div>

                            @if( $is_def_mile_or_fees == '1')
                                <div class="form-group col-md-3">
                                    <label>{{ __('cargo::view.returned_mile_cost') }}:</label>
                                    <input type="number" onchange="changeReturnCosts(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->return_mile_cost)){echo ($default_country_cost->return_mile_cost);}else{ echo 0;} @endphp" name="return_mile_cost[]">
                                </div>
                            @elseif($is_def_mile_or_fees == '2' )
                                <div class="form-group col-md-3">
                                    <label>{{ __('cargo::view.returned_shipmen_cost') }}:</label>
                                    <input type="number" onchange="changeReturnCosts(this)" min="0" id="name" class="form-control" placeholder="{{ __('cargo::view.here') }}" value="@php if(isset($default_country_cost->return_cost)){echo ($default_country_cost->return_cost);}else{ echo 0;} @endphp" name="return_cost[]">
                                </div>
                            @endif
                        </div>
                        <hr>
                        <button type="button" class="btn btn-secondary spinner spinner-dark spinner-right evenAjaxRemove">
                        {{ __('cargo::view.loading_costs') }}
                        </button>
                        <div id="placeholder_cost"></div>

                    </div>

                </div>


            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="evenAjaxButton btn btn-lg btn-primary">{{ __('cargo::view.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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
    <script>
        $('.evenAjaxButton').hide();
        function cost_block(label_name,label_returned_name,input_name,input_returned_name,from_name,to_name,from_id,to_id,from_city_name,to_city_name,from_city_id,to_city_id,shipping_cost,tax,return_cost,insurance) {
                return `<div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __('cargo::view.from_country') }}:</label>
                                        <input disabled readonly class="form-control disabled" value="`+from_name+`">
                                        <input type="hidden" name="from_country_h[]" value="`+from_id+`">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('cargo::view.to_country') }}:</label>
                                        <input disabled readonly class="form-control disabled" value="`+to_name+`">
                                        <input type="hidden" name="to_country_h[]" value="`+to_id+`">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('cargo::view.from_region') }}:</label>
                                        <input disabled readonly class="form-control disabled" value="`+from_city_name+`">
                                        <input type="hidden" name="from_state[]" value="`+from_city_id+`">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('cargo::view.to_region')}}:</label>
                                        <input disabled readonly class="form-control disabled" value="`+to_city_name+`">
                                        <input type="hidden" name="to_state[]" value="`+to_city_id+`">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>`+label_name+`:</label>
                                        <input type="number" min="0" id="name" class="form-control shipp_cost" placeholder="{{ __('cargo::view.here') }}" value="`+shipping_cost+`" name="`+input_name+`[]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>{{ __('cargo::view.tax') }}%:</label>
                                        <input type="number" min="0" id="name" class="form-control tax_cost" placeholder="{{ __('cargo::view.here') }}" value="`+tax+`" name="tax[]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>{{ __('cargo::view.insurance') }}:</label>
                                        <input type="number" min="0" id="name" class="form-control insurance_cost" placeholder="{{ __('cargo::view.here') }}" value="`+insurance+`" name="insurance[]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>`+label_returned_name+`:</label>
                                        <input type="number" min="0" id="name" class="form-control return_cost" placeholder="{{ __('cargo::view.here') }}" value="`+return_cost+`" name="`+input_returned_name+`[]">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        `;
        }
        $.ajax( "{{route('countries.config.costs.ajax')}}?from_country={{$from->id}}&to_country={{$to->id}}" )
        .done(function(data) {
            $.each(data, function(k, v) {
                var label_mile_cost='Mile Cost';
                var label_returned_mile_cost='Returned Mile Cost';
                var input_mile_name = "mile_cost";
                var input_returned_mile_name = "return_mile_cost";

                var label_shipping_cost='Shipping Cost';
                var label_returned_cost='Returned Cost';
                var input_name = "shipping_cost";
                var input_returned_name = "return_cost";
                
                
                if( {{$is_def_mile_or_fees}} =='2'){
                    $('#placeholder_cost').append(cost_block(label_shipping_cost,label_returned_cost,input_name,input_returned_name,v.from_country,v.to_country,v.from_country_id,v.to_country_id,v.from_state,v.to_state,v.from_state_id,v.to_state_id,v.shipping_cost,v.tax,v.return_cost,v.insurance));
                }else if( {{$is_def_mile_or_fees}} =='1'){
                    $('#placeholder_cost').append(cost_block(label_mile_cost,label_returned_mile_cost,input_mile_name,input_returned_mile_name,v.from_country,v.to_country,v.from_country_id,v.to_country_id,v.from_state,v.to_state,v.from_state_id,v.to_state_id,v.mile_cost,v.tax,v.return_mile_cost,v.insurance));
                }
            });
            $('.evenAjaxRemove').remove();
            $('.evenAjaxButton').show();
        })
        .fail(function() {
            alert( "error" );
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
        function changeShippingCosts(element)
        {
            $('.shipp_cost').val($(element).val());
        }
        function changeTax(element)
        {
            $('.tax_cost').val($(element).val());
        }
        function changeInsurance(element)
        {
            $('.insurance_cost').val($(element).val());
        }
        function changeReturnCosts(element)
        {
            $('.return_cost').val($(element).val());
        }
        
    </script>
@endsection