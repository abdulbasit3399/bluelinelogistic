@php
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
$user_role = auth()->user()->role;
$admin  = 1;

@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
{{ __('cargo::view.shipment').'-'. $shipment->code }}
@endsection

@section('content')

<!--begin::Card-->
<div class="card card-custom gutter-b">
  <div class="p-0 card-body">
    <!-- begin: Invoice-->
    <!-- begin: Invoice header-->
    <div class="px-8 py-8 row justify-content-center pt-md-27 px-md-0">
      <div class="col-md-10">
        <div class="pb-10 d-flex justify-content-between pb-md-20 flex-column flex-md-row">
          <div class="px-0 d-flex flex-column align-items-md-start">
            <span class="d-flex flex-column align-items-md-start">
              <h1 class="mb-10 display-4 font-weight-boldest">{{ __('cargo::view.shipment') }}: {{$shipment->code}}</h1>
              @if($shipment->order_id != null)
              <span><span class="font-weight-bolder opacity-70">{{ __('cargo::view.order_id') }}:</span> {{$shipment->order_id}}</span>
              @endif
            </span>
          </div>
          <div class="px-0 d-flex flex-column align-items-md-end">
            <span class="d-flex flex-column align-items-md-end opacity-70">
              @if($shipment->barcode != null)
              <span class="mb-5 font-weight-bolder"><?=$d->getBarcodeHTML($shipment->code, "C128");?></span>
              @endif
              {{--  <span><span class="font-weight-bolder">{{ __('cargo::view.from') }}:</span> {{$shipment->from_address->address}}</span>  --}}
              {{--  <span><span class="font-weight-bolder">{{ __('cargo::view.to') }}:</span> {{$shipment->reciver_address}}</span>  --}}
            </span>
          </div>
        </div>

        <div class="pb-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.client_sender') }}</span>
            @if($user_role == $admin || auth()->user()->can('show-clients') )
            <a class="text-danger font-weight-boldest font-size-lg" href="{{route('clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a>
            @else
            <span class="text-danger font-weight-boldest font-size-lg">{{$shipment->client->name}}</span>
            @endif
            <span class="text-muted font-size-md">{{$shipment->client_phone}}</span>
            {{--  <span class="text-muted font-size-md">{{$shipment->from_address->address}}</span>  --}}
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.receiver') }}</span>

            @if($user_role == $admin || auth()->user()->can('show-clients') )
            <a class="text-danger font-weight-boldest font-size-lg" href="{{route('clients.show',$shipment->reciver_id)}}">{{$shipment->reciever->name}}</a>
            @else
            <span class="text-danger font-weight-boldest font-size-lg">{{$shipment->reciever->name}}</span>

            @endif
            <span class="text-muted font-size-md">{{$shipment->reciver_phone}}</span>
            {{--  <span class="text-muted font-size-md">{{$shipment->reciver_address}}</span>  --}}
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.status') }}</span>
            <span class="opacity-70 d-block">{{$shipment->getStatus()}}</span>
          </div>

          @if (isset($shipment->amount_to_be_collected))
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.amount_to_be_collected') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->amount_to_be_collected)}}</span>
          </div>
          @endif
        </div>
        <div class="border-bottom w-100"></div>
        <div class="pt-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('cargo::view.shipment_type') }}</span>
            <span class="opacity-70">{{$shipment->type}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('cargo::view.current_branch') }}</span>
            @if($user_role == $admin || auth()->user()->can('show-branches') )
            <a class="opacity-70" href="{{route('branches.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a>
            @else
            <span class="text-danger font-weight-boldest font-size-lg">{{$shipment->branch->name}}</span>
            @endif
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('cargo::view.created_date') }}</span>
            <span class="opacity-70">{{$shipment->created_at->format('d-m-Y h:i:s')}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('cargo::view.shipping_date') }}</span>
            <span class="opacity-70">{{\Carbon\Carbon::parse($shipment->shipping_date)->format('d-m-Y')}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('Estimated Delivery Date') }}</span>
            <span class="opacity-70">{{\Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('d-m-Y')}}</span>
          </div>
        </div>


        <div class="pt-6 d-flex justify-content-between">
          @if ($shipment->prev_branch)
          <div class="d-flex flex-column flex-root">
            <span class="mb-2 font-weight-bolder">{{ __('cargo::view.previous_branch') }}</span>
            <span class="opacity-70">{{Modules\Cargo\Entities\Branch::find($shipment->prev_branch)->name}}</span>
          </div>
          @endif
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.total_weight') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->total_weight}} {{ __('cargo::view.KG') }}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.shipping_cost') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->shipping_cost)}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.tax_duty') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->tax)}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.insurance') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->insurance)}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.return_cost') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->return_cost)}}</span>
          </div>
        </div>

        <div class="pt-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">From Address</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->client_address}}</span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">To Address</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->reciver_address}}</span>
          </div>


        </div>

        {{-- <div class="pt-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.from_country') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_country->name)){{$shipment->from_country->name}} @endif </span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.to_country') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_country->name)){{$shipment->to_country->name}} @endif </span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.from_region') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_state->name)){{$shipment->from_state->name}} @endif </span>
          </div>
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.to_region') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_state->name)){{$shipment->to_state->name}} @endif </span>
          </div>
        </div> --}}


        <div class="pt-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.max_delivery_days') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{ $shipment->deliveryTime ? json_decode($shipment->deliveryTime->name, true)[app()->getLocale()] : ''}}</span>
          </div>
          @if($shipment->collection_time != null)
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.collection_time') }}</span>
            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->collection_time}}</span>
          </div>
          @endif
          @if($shipment->captain_id != null)
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.driver') }}</span>
            @if($user_role == $admin || auth()->user()->can('show-drivers'))
            <a class="text-danger font-weight-boldest font-size-lg" href="{{route('drivers.show',$shipment->captain_id)}}">{{$shipment->captain->name}} </a>
            @else
            <span class="text-muted font-weight-boldest font-size-lg">{{$shipment->captain->name}}</span>
            @endif

          </div>
          @endif
          @if ($shipment->mission_id != null)
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.mission') }}</span>
            @if($user_role == $admin || auth()->user()->can('show-missions'))
            <a class="text-danger font-weight-bolder font-size-lg" href="{{route('missions.show',$shipment->mission_id)}}">{{$shipment->current_mission->code}}</a>
            @else
            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->current_mission->code}}</span>
            @endif
          </div>
          @endif
        </div>
        @if(count($shipment->getMedia('attachments')) > 0)
        <div class="pt-6 d-flex justify-content-between">
          <div class="d-flex flex-column flex-root">
            <span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.attachments') }} <span class="text-muted font-size-xs">({{ __('cargo::view.ADDED_WHEN_SHIPMENT_CREATED') }} )</span></span>
            <div class="pt-6 d-flex justify-content-between">
              @foreach($shipment->getMedia('attachments') as $img)
              <div class="d-flex flex-column flex-root ml-1">
                <span class="text-muted font-weight-bolder font-size-lg">
                  <a href="{{$img->getUrl()}}" target="_blank"><img src="{{$img->getUrl()}}" alt="image" style="max-width:100px;max-height:60px" /></a>
                </span>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endif


      </div>
    </div>
    <!-- end: Invoice header-->
    <!-- begin: Invoice body-->
    <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
      <div class="col-md-10">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="pl-0 font-weight-bold text-muted text-uppercase">{{ __('cargo::view.package_items') }}</th>
                <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.qty') }}</th>
                <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.type') }}</th>
                <th class="pr-0 text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.weigh_length_width_height') }}</th>
              </tr>
            </thead>
            <tbody>

              @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
              <tr class="font-weight-boldest">
                <td class="pl-0 border-0 pt-7 d-flex align-items-center">{{$package->description}}</td>
                <td class="text-right align-middle pt-7">{{$package->qty}}</td>
                <td class="text-right align-middle pt-7">@if(isset($package->package->name)){{json_decode($package->package->name, true)[app()->getLocale()]}} @else - @endif</td>
                <td class="pr-0 text-right align-middle text-primary pt-7">{{$package->weight." ". __('cargo::view.KG')." x ".$package->length." ". __('cargo::view.CM') ." x ".$package->width." ".__('cargo::view.CM')." x ".$package->height." ".__('cargo::view.CM')}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end: Invoice body-->
    <!-- begin: Invoice footer-->
    <div class="px-8 py-8 mx-0 bg-gray-100 row justify-content-center py-md-10 px-md-0">
      <div class="col-md-10">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_TYPE') }}</th>
                <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_STATUS') }}</th>
                <th class="font-weight-bold text-muted text-uppercase">{{ __('cargo::view.PAYMENT_DATE') }}</th>
                <th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.total_cost') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr class="font-weight-bolder">
                <td>{{$shipment->payment_method_id}} ({{$shipment->getPaymentType()}})</td>
                <td>@if($shipment->paid == 1) {{ __('cargo::view.paid') }}@else {{ __('cargo::view.pending') }} @endif</td>
                <td>@if($shipment->paid == 1) {{\Carbon\Carbon::parse($shipment->payment->payment_date)->format('d-m-Y') ?? ""}} @else - @endif</td>
                <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}<br /><span class="text-muted font-weight-bolder font-size-lg">{{ __('cargo::view.included_tax_insurance') }}</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end: Invoice footer-->
    <!-- begin: Invoice action-->
    <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
      <div class="col-md-10">
        <div class="d-flex justify-content-between">
          @php
          $INVOICE_PAYMENT = 'invoice_payment';
          $cash_payment = 'cash_payment';
          @endphp
          @if($shipment->paid == 0 && $shipment->payment_method_id != $cash_payment && $shipment->payment_method_id != $INVOICE_PAYMENT )
          <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
            @csrf
            <input type="hidden" name="shipment_id" value="{{$shipment->id}}">
            <button type="submit" class="mr-3 btn btn-success btn-md">{{ __('cargo::view.pay_now') }}<i class="ml-2 far fa-credit-card"></i></button>
          </form>
          <button class="btn btn-success btn-sm " onclick="copyToClipboard('#payment-link')">{{ __('cargo::view.copy_payment_link') }}<i class="ml-2 fas fa-copy"></i></button>
          <div id="payment-link" style="display: none">{{route('admin.shipments.pay', $shipment->id)}}</div>
          @endif

          {{-- <a href="{{route('shipments.print', array($shipment->id, 'label'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{ __('cargo::view.print_label') }}<i class="ml-2 la la-box-open"></i></a> --}}
          <a href="{{route('shipments.print', array($shipment->id, 'invoice'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{ __('cargo::view.print_invoice') }}<i class="ml-2 la la-file-invoice-dollar"></i></a>

          @if($user_role == $admin || auth()->user()->can('edit-shipments'))
          <a href="{{route('shipments.edit', $shipment->id)}}" class="px-6 py-3 btn btn-light-info btn-sm font-weight-bolder font-size-sm">{{ __('cargo::view.edit_shipment') }}</a>
          @endif
        </div>
      </div>
    </div>
    <!-- end: Invoice action-->
    <!-- end: Invoice-->
  </div>
</div>
<!--end::Card-->

@if(!empty($shipment->shipmentReasons->toArray()))
<div class="card card-custom card-stretch-half gutter-b">
  <!--begin::List Widget 19-->

  <!--begin::Header-->
  <div class="pt-6 mb-2 border-0 card-header">
    <h3 class="card-title align-items-start flex-column">
      <span class="mb-3 card-label font-weight-bold font-size-h4 text-dark-75">{{ __('cargo::view.shipment_return_reasons_log') }}</span>

    </h3>
    <div class="card-toolbar">

    </div>
  </div>
  <!--end::Header-->
  <!--begin::Body-->
  <div class="pt-2 card-body" style="overflow:hidden">
    <div class="mt-3 timeline timeline-6 scroll scroll-pull" style="overflow:hidden" data-scroll="true" data-wheel-propagation="true">

      @forelse($shipment->shipmentReasons as $key => $shipmentReason)
      <!--begin::Item-->
      <div class="timeline-item align-items-start">
        <!--begin::Label-->
        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$shipmentReason->created_at->diffForHumans()}}</div>
        <!--end::Label-->

        <!--begin::Badge-->
        <div class="timeline-badge">
          <i class="fa fa-genderless text-warning icon-xl" style="margin-right: 4px;"></i>
        </div>
        <!--end::Badge-->

        <!--begin::Text-->
        <div class="pl-3 font-weight-mormal font-size-lg timeline-content text-muted">
          {{ __('cargo::view.reason').' '.($key+1) }}: "{{$shipmentReason->reason->name}}"
        </div>
        <!--end::Text-->

      </div>
      <!--end::Item-->
      @empty

      @endforelse


    </div>
  </div>
</div>
@endif

<!--end::List Widget 19-->
@if(($user_role == $admin || auth()->user()->can('shipments-log')) && !empty($shipment->logs->toArray()))
<div class="card card-custom card-stretch-half gutter-b">
  <!--begin::List Widget 19-->

  <!--begin::Header-->
  <div class="pt-6 mb-2 border-0 card-header">
    <h3 class="card-title align-items-start flex-column">
      <span class="mb-3 card-label font-weight-bold font-size-h4 text-dark-75">{{ __('cargo::view.shipment_status_log') }}</span>

    </h3>
    <div class="card-toolbar">

    </div>
  </div>
  <!--end::Header-->
  <!--begin::Body-->
  <div class="pt-2 card-body" style="overflow:hidden">
    <div class="mt-3 timeline timeline-6 scroll scroll-pull" style="overflow:hidden" data-scroll="true" data-wheel-propagation="true">

      @foreach($shipment->logs()->orderBy('id','desc')->get() as $log)
      <!--begin::Item-->
      <div class="timeline-item align-items-start">
        <!--begin::Label-->
        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$log->created_at->diffForHumans()}}</div>
        <!--end::Label-->

        <!--begin::Badge-->
        <div class="timeline-badge">
          <i class="fa fa-genderless text-warning icon-xl" style="margin-right: 4px;"></i>
        </div>
        <!--end::Badge-->

        <!--begin::Text-->
        <div class="pl-3 font-weight-mormal font-size-lg timeline-content text-muted">
          {{ __('cargo::view.changed_from') }}: "{{Modules\Cargo\Entities\Shipment::getStatusByStatusId($log->from)}}" {{ __('cargo::view.to') }}: "{{Modules\Cargo\Entities\Shipment::getStatusByStatusId($log->to)}}"
        </div>
        <!--end::Text-->

      </div>
      <!--end::Item-->

      @endforeach


    </div>
  </div>
</div>
@endif

@endsection

{{-- Inject styles --}}
@section('styles')
<style>
  .timeline .timeline-content {
    width: auto;
  }
  .timeline-label{
    margin-right: 6px;
    padding-right: 6px;
    border-right: solid 3px #eff2f5;
  }
  .timeline-label:before{
    width: unset;
  }
</style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
<script>
  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    AIZ.plugins.notify('success', "{{ __('cargo::view.payment_link_copied') }}");
  }
</script>
@endsection
