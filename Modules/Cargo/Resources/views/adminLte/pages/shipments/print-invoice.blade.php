@php
    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();
    $user_role = auth()->user()->role;
    $admin  = 1;
    $code = filter_var($shipment->code, FILTER_SANITIZE_NUMBER_INT);
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.package_list') }}
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
                                {{ __('cargo::view.INVOICE') }}
                            </h1>
                            <div class="px-0 d-flex flex-column align-items-md-end">
                                <!--begin::Logo-->
                                <a href="#">
                                    @if($shipment->barcode != null)
                                        @php
                                            echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($shipment->code, "C128") . '" alt="barcode"   />';
                                        @endphp
                                    @endif
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <br />
                                    <span><span class="font-weight-bolder">{{ __('cargo::view.from') }}:</span> {{$shipment->client_address}}</span>
                                    <span><span class="font-weight-bolder">{{ __('cargo::view.to') }}:</span> {{$shipment->reciver_address}}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="pt-6 d-flex justify-content-between">
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder d-block">{{ __('cargo::view.DATE') }}<span>
                                <span class="opacity-70 d-block">{{ $shipment->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder">{{ __('cargo::view.SHIPMENT_CODE') }}</span>
                                <span class="opacity-70">{{$shipment->code}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder">{{ __('cargo::view.INVOICE_TO') }}</span>
                                <span class="opacity-70">{{$shipment->reciver_address}}.
                                <br />{{$shipment->reciver_name}}.
                                <br />{{$shipment->reciver_phone}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{ __('cargo::view.package_items') }}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.qty') }}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.type') }}</th>
                                        <th class="pr-0 text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.Weight_length_width_height_') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)

                                        <tr class="font-weight-boldest">
                                            <td class="pl-0 border-0 pt-7 d-flex align-items-center">{{$package->description}}</td>
                                            <td class="text-right align-middle pt-7">{{$package->qty}}</td>
                                            <td class="text-right align-middle pt-7">@if(isset($package->package->name)){{json_decode($package->package->name, true)[app()->getLocale()]}} @else - @endif</td>
                                            <td class="pr-0 text-right align-middle text-primary pt-7">{{$package->weight." ".__('cargo::view.KG')." x ".$package->length." ".__('cargo::view.CM')." x ".$package->width." ".__('cargo::view.CM')." x ".$package->height." ".__('cargo::view.CM')}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="px-8 py-8 bg-gray-100 row justify-content-center py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_TYPE') }}</th>
                                        <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_STATUS') }}</th>
                                        <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_DATE') }}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.TOTAL_COST') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{$shipment->payment_method_id}} ({{$shipment->getPaymentType()}})</td>
                                        <td>@if($shipment->paid == 1) {{__('cargo::view.paid')}} @else {{ __('cargo::view.pending') }} @endif</td>
                                        <td>@if($shipment->paid == 1) {{$shipment->payment->payment_date ?? ""}} @else - @endif</td>
                                        <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}<br /><span class="text-muted font-weight-bolder font-size-lg">{{ __('cargo::view.included_tax_insurance') }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0 no-print">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{ __('cargo::view.print_invoice') }}</button>
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
    .no-print, div#kt_header_mobile, div#kt_header, div#kt_footer{
        display: none;
    }
</style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
<script>
    window.onload = function() {
        javascript:window.print();
    };
</script>
@endsection