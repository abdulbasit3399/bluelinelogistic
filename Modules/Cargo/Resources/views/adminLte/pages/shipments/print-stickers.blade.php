	
@php
    $n = 0;
    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();
    $cash_payment = 'cash_payment';
@endphp
@foreach ($shipments as $shipment)
    @php
        $n++;
    @endphp

    <div class="page" style="padding-top:0px;">
        <div class="subpage">
            <table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;font-family:Arial, Helvetica, sans-serif; ">
                <tr>
                    <td>
                        <table width="450px" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">
                            <tr>
                                <td height="21px" colspan="3" style="padding-left:5px; padding-bottom:5px;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="middle" style="padding-left:5px; height: 90px;">
                                                @php 
                                                    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
                                                @endphp
                                                <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="21px" colspan="3" style="border-top:#000000  1px solid;border-bottom:#000000 1px solid;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="81%" height="21px" valign="top">
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="padding-left:10px; font-size:14px; font-weight:bold; width:420px">
                                                                        {{ get_general_setting('company_name', config('app.name')) }}
                                                                    </td>
                                                                    <td nowrap="nowrap">
                                                                        <span style="font-size:20px; font-weight:bold; padding-right:10px;">{{$shipment->code}}</span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-left:10px;font-size: 14px;white-space: pre-line;word-wrap: break-word;max-width: 360px;">{{$shipment->reciver_address}}</td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="border-top: 1px solid #000000; border-bottom: 0px solid #000000;">
                                                            <div style="margin-top:1px;">
                                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td style="text-align: center; padding-top: 10px;" colspan="1">
                                                                            <span style="font-size:16px; font-weight:bold; padding:10px;">
                                                                            @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID && $shipment->payment_method_id != $cash_payment )
                                                                                {{ __('cargo::view.POSTPAID') }}: 
                                                                            @elseif($shipment->payment_type == Modules\Cargo\Entities\Shipment::PREPAID)
                                                                                {{ __('cargo::view.PREPAID') }}:
                                                                            @elseif($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID && $shipment->payment_method_id == $cash_payment )
                                                                                {{ __('cargo::view.cod') }}:
                                                                            @endif

                                                                            @if ($shipment->amount_to_be_collected && $shipment->amount_to_be_collected  > 0)
                                                                                
                                                                                @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID )
                                                                                    {{format_price($shipment->amount_to_be_collected + $shipment->tax + $shipment->shipping_cost + $shipment->insurance)}}
                                                                                @else
                                                                                    {{format_price($shipment->amount_to_be_collected)}}
                                                                                @endif
                                                                                
                                                                            @else
                                                                                @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID )
                                                                                    {{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance)}}
                                                                                @else
                                                                                    0
                                                                                @endif
                                                                            @endif
                                                                            </span>
                                                                            <br />
                                                                            <span style="font-size:16px; font-weight:bold; margin-bottom:10px;padding: 2px;">
                                                                                {{ __('cargo::view.total_weight') }}: {{$shipment->total_weight}} {{ __('cargo::view.KG') }}
                                                                            </span>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 2px; text-align: center">
                                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                <tr>
                                                                                    <td  style="text-align: center">
                                                                                        <br />
                                                                                            @if($shipment->barcode != null)
                                                                                                @php
                                                                                                    echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($shipment->code, "C128") . '" alt="barcode"   />';
                                                                                                @endphp
                                                                                            @endif
                                                                                        <br />
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <span style="font-size:16px; font-weight:bold;">
                                                                            <br />
                                                                            @if($shipment->order_id != null) {{ __('cargo::view.order_id') }}: {{$shipment->order_id}} / @endif {{$shipment->code}} / {{$shipment->total_weight}} {{ __('cargo::view.KG') }} / {{\Carbon\Carbon::parse($shipment->shipping_date)->format('d-m-Y')}}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="padding:5px; font-size:12px;">
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
                                                                        <span style="font-weight:bold;">{{ __('cargo::view.from') }}: </span>
                                                                        {{$shipment->client->name}}<br />
                                                                        {{$shipment->client_phone}}<br />
                                                                        {{$shipment->from_address->address}}
                                                                    </td>
                                                                    <td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
                                                                        <span style="font-weight:bold;">{{ __('cargo::view.to') }}: </span>
                                                                        {{$shipment->reciver_name}}<br />
                                                                        {{$shipment->reciver_phone}}<br />
                                                                        {{$shipment->reciver_address}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;border-top:#000000 1px solid;">
                                                    <tr>
                                                        <td style="padding:5px; font-size:12px; text-align:center">
                                                            <span style="font-weight:bold; font-size: 14px;">{{ __('cargo::view.contains') }}: </span>
                                                            @php $i=0; @endphp
                                                            @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                                                                @if ($i != 0 ), @endif{{$package->description}}
                                                                @php $i++; @endphp
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top" style="padding:0px;">
                        <img src="{{ asset('assets/img/cut-line.gif') }}" alt="" />
                    </td>

                    <td style="padding-right:20px;">
                        <table width="450px" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">
                            <tr>
                                <td height="21px" colspan="3" style="padding-left:5px; padding-bottom:5px;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="middle" style="padding-left:5px; height: 90px;">
                                                @php 
                                                    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
                                                @endphp
                                                <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="21px" colspan="3" style="border-top:#000000  1px solid;border-bottom:#000000 1px solid;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="81%" height="21px" valign="top">
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="padding-left:10px; font-size:14px; font-weight:bold; width:420px">
                                                                        {{ get_general_setting('company_name', config('app.name')) }}
                                                                    </td>
                                                                    <td nowrap="nowrap">
                                                                        <span style="font-size:20px; font-weight:bold; padding-right:10px;">{{$shipment->code}}</span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-left:10px;font-size: 14px;white-space: pre-line;word-wrap: break-word;max-width: 360px;">{{$shipment->reciver_address}}</td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="border-top: 1px solid #000000; border-bottom: 0px solid #000000;">
                                                            <div style="margin-top:1px;">
                                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td style="text-align: center; padding-top: 10px;" colspan="1">
                                                                            <span style="font-size:16px; font-weight:bold; padding:10px;">
                                                                            @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID && $shipment->payment_method_id != $cash_payment )
                                                                                {{ __('cargo::view.POSTPAID') }}: 
                                                                            @elseif($shipment->payment_type == Modules\Cargo\Entities\Shipment::PREPAID)
                                                                                {{ __('cargo::view.PREPAID') }}:
                                                                            @elseif($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID && $shipment->payment_method_id == $cash_payment )
                                                                                {{ __('cargo::view.cod') }}:
                                                                            @endif

                                                                            @if ($shipment->amount_to_be_collected && $shipment->amount_to_be_collected  > 0)
                                                                                
                                                                                @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID )
                                                                                    {{format_price($shipment->amount_to_be_collected + $shipment->tax + $shipment->shipping_cost + $shipment->insurance)}}
                                                                                @else
                                                                                    {{format_price($shipment->amount_to_be_collected)}}
                                                                                @endif
                                                                                
                                                                            @else
                                                                                @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID )
                                                                                    {{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance)}}
                                                                                @else
                                                                                    0
                                                                                @endif
                                                                            @endif
                                                                            </span>
                                                                            <br />
                                                                            <span style="font-size:16px; font-weight:bold; margin-bottom:10px;padding: 2px;">
                                                                                {{ __('cargo::view.total_weight') }}: {{$shipment->total_weight}} {{ __('cargo::view.KG') }}
                                                                            </span>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 2px; text-align: center">
                                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                <tr>
                                                                                    <td  style="text-align: center">
                                                                                        <br />
                                                                                            @if($shipment->barcode != null)
                                                                                                @php
                                                                                                    echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($shipment->code, "C128") . '" alt="barcode"   />';
                                                                                                @endphp
                                                                                            @endif
                                                                                        <br />
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <span style="font-size:16px; font-weight:bold;">
                                                                            <br />
                                                                            @if($shipment->order_id != null) {{ __('cargo::view.order_id') }}: {{$shipment->order_id}} / @endif {{$shipment->code}} / {{$shipment->total_weight}} {{ __('cargo::view.KG') }} / {{\Carbon\Carbon::parse($shipment->shipping_date)->format('d-m-Y')}}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="padding:5px; font-size:12px;">
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
                                                                        <span style="font-weight:bold;">{{ __('cargo::view.from') }}: </span>
                                                                        {{$shipment->client->name}}<br />
                                                                        {{$shipment->client_phone}}<br />
                                                                        {{$shipment->from_address->address}}
                                                                    </td>
                                                                    <td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
                                                                        <span style="font-weight:bold;">{{ __('cargo::view.to') }}: </span>
                                                                        {{$shipment->reciver_name}}<br />
                                                                        {{$shipment->reciver_phone}}<br />
                                                                        {{$shipment->reciver_address}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;border-top:#000000 1px solid;">
                                                    <tr>
                                                        <td style="padding:5px; font-size:12px; text-align:center">
                                                            <span style="font-weight:bold; font-size: 14px;">{{ __('cargo::view.contains') }}: </span>
                                                            @php $i=0; @endphp
                                                            @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                                                                @if ($i != 0 ), @endif{{$package->description}}
                                                                @php $i++; @endphp
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page" style="padding-top:0px;">
        <div class="subpage">
            <style media="all">
                .upper-container, .main-container, .order-units-container, .address-container, .return-authorization {
                    margin: 5px;
                }
                .float-left {
                    float: left;
                }
                .float-right {
                    float: right;
                }
                .upper-container, .main-container, .upper-units-container {
                    display: block;
                    overflow: auto;
                }

                .upper-container, .order-units-container {
                    border: 1px solid #ccc;
                }

                .order-units-container {
                    /*clear: both;*/
                }

                .upper-container {
                    margin-top: 20px;
                }

                .item-info-container {
                    padding: 5px;
                }

                .main-container {
                    width: 70%;
                }

                .barcode-container {
                    /*width: 50%;*/
                    text-align: right;
                }

                .order-id-container {
                    padding: 10px;
                }

                .header-container {
                    overflow: auto;
                    display: block;
                    margin-bottom: 0;
                    background-color: #f7f7f7;
                    border-bottom: 1px solid #ccc;
                    padding: 10px;
                }

                .upper-units-container {
                    width: 100%;
                }

                .image-container {
                    width: 40px;
                    margin-right: 10px;
                }

                .margin-top {
                    margin-top: 20px;
                }

                .not-first-unit-container {
                    border-top: 1px dashed #ccc;
                }

                .bold {
                    font-weight: bold;
                }

                .font-20 {
                    font-size: 20px;
                }

                .item-image {
                    width: 40px;
                }

                .address {
                    margin-bottom: 3px;
                }

                .width-90-px {
                    width: 90px;
                }

                .width-200-px {
                    width: 200px;
                }

                .margin-right {
                    margin-right: 10px;
                }

                .green-text {
                    color: #008000;
                }

                .red-text {
                    color: red;
                }

                .not-inspected {
                    color: #EB6E13;
                }

                .info-container {
                    width: 45%;
                }

                .text-wrap {
                    overflow-wrap: break-word;
                }

                .text-align-right {
                    text-align: right;
                }
            </style>
            <style media="print">
                .no-print {
                    display: none;
                }

                .main-container {
                    width: 100%;
                }

                .page-break {
                    page-break-before: always;
                }
            </style>
            
            <div class="main-container not-first-unit-container">
                <div class="upper-units-container">
                    <div class="upper-units-container">
                        <div class="float-left item-info-container">
                            <span class="font-20">{{ __('cargo::view.shipment_code') }}:</span> <span class="return-authorization font-20">{{$shipment->code}}</span>
                        </div>
                        <div class="float-right item-info-container text-align-right">
                            {{ __('cargo::view.shipment_code') }}:<span> {{\Carbon\Carbon::parse($shipment->shipping_date)->format('d-m-Y')}}</span>
                        </div>
                        
                        @if($shipment->collection_time != null)
                            <div class="float-right item-info-container text-align-right">
                                {{ __('cargo::view.collection_time') }}:<span> {{$shipment->collection_time}} /</span>
                            </div>
                        @endif
                    </div>
                    <div class="upper-units-container">

                        <div class="float-left margin-top info-container text-wrap">
                            @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                                <div class="bold item-info-container">{{$package->description}}</div>
                                <div class="item-info-container">
                                    <span class="bold">{{ __('cargo::view.qty') }}: </span><span>{{$package->qty}}</span>
                                </div>
                                @if(isset($package->package->name))
                                    <div class="item-info-container">
                                        <span class="bold">{{ __('cargo::view.package_type') }}:</span> <span>{{json_decode($package->package->name, true)[app()->getLocale()]}}</span>
                                    </div>
                                @endif
                                <div class="item-info-container">
                                    <span class="bold">{{ __('cargo::view.weigh_length_width_height') }}:</span> <span>{{$package->weight." ".__('cargo::view.KG')." x ".$package->length." ".__('cargo::view.CM')." x ".$package->width." ".__('cargo::view.CM')." x ".$package->height." ".__('cargo::view.CM')}}</span>
                                </div>
                                </br>
                            @endforeach
                        </div>

                        @if($shipment->barcode != null)
                            <div class="float-right margin-top barcode-container">
                                @php
                                    echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($shipment->code, "C128") . '" alt="barcode"   />';
                                @endphp
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="page-break"></div>
        </div>
    </div>

    @if(count($shipments) > $n)
        <div class="page" style="padding-top:0px;position:relative">
            <div class="subpage" style="position: absolute;top: -50px;">
                <table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;font-family:Arial, Helvetica, sans-serif; ">
                    <tr>
                        <td valign="top" style="padding:0px;">
                            <img src="{{ asset('assets/img/cut-hr-line.gif') }}" alt="" />
                        </td>
                        <td valign="top" style="min-width:40px;">
                        </td>
                        <td valign="top" style="padding:0px;">
                            <img src="{{ asset('assets/img/cut-hr-line.gif') }}" alt="" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
    <div class="page-break"></div>
@endforeach

<script>
window.onload = function() {
	javascript:window.print();
};
</script>
