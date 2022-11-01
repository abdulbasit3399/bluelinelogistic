{{--  @extends('cargo::adminLte.layouts.blank')  --}}
@extends('cargo::adminLte.template.layout.layout')
@section('pageTitle')
    Goods Tracking
@endsection
@php
$pageTitle =  __('cargo::view.tracking_shipment');

    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();

    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
@endphp

@section('styles')

@endsection

@section('content')
<div class="container mt-4">
    <div class="card px-4">
        <div class="row">
           <div class="col-md-12 col-lg-12">
             <div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
                 <div class="alert-text">
                     <!--begin::Logo-->
                     <p class="d-block py-10 text-center">
                         <a href="{{ route('home') }}">
                             <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                         </a>
                     </p>
                     <p class="mt-50 text-center"><a href="{{ route('home') }}" style="color: black !important;">{{ __('cargo::view.back_to_dashboard') }}</a></p>
                 </div>
             </div>

             <div class="d-flex justify-content-between pb-10 pb-md-10 flex-column flex-md-row">
                 {{--  @php
                     $code = filter_var($model->shipment_id, FILTER_SANITIZE_NUMBER_INT);
                 @endphp  --}}
                @if(isset($error))
                <h1 class="display-5 font-weight-boldest mb-0" style="color:red">{{$error}}</h1>
                @else
                <h1 class="display-5 font-weight-boldest mb-0">{{ __('Shipment Tracking') }}</h1>
                @endif

             </div>
            </div>
        </div>
        <div class="card-body px-4 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-uppercase"><strong>{{ __('cargo::view.client_sender') }}</strong></th>
                        <th class="text-uppercase"><strong>sender address</strong></th>
                        <th class="text-uppercase"><strong>{{ __('cargo::view.date') }}</strong></th>
                        <th class="text-uppercase"><strong>{{ __('Amount') }}</strong></th>
                        <th class="text-uppercase"><strong>{{ __('cargo::view.receiver') }}</strong></th>
                        <th class="text-uppercase"><strong>reciever address</strong></th>
                        <th class="text-uppercase"><strong>quantity</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$shipment->client->name}}</td>
                        <td>{{$shipment->client_address}}</td>
                        <td>{{ Carbon\Carbon::parse($shipment->created_at)->format('d F, y') }}</td>
                        <td>{{$shipment->amount_to_be_collected}}</td>
                        <td>{{$shipment->reciever->name}}</td>
                        <td>{{$shipment->reciver_address}}</td>
                        <td>{{$shipment->quantity}}</td>

                    {{--  @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                        <td>{{$package->qty}}</td>
                    @endforeach  --}}
                    </tr>
                    @foreach($shipment->logs()->orderBy('id','asc')->get() as $log)
                        <tr>
                            <td>{{$log->created_at->diffForHumans()}}</td>
                            <td>{{Modules\Cargo\Entities\Shipment::getClientStatusByStatusId($log->to)}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


            {{--  <div class="col-md-6 col-lg-6">
                    @foreach ($shipment_status as $models)
                    <div class="tracking-item">
                     <div class="tracking-icon">
                         {!! $models->ship_icon !!}
                     </div>
                       <div class="tracking-date">{{ Carbon\Carbon::parse($models->date)->format('d F, y') }}<span>{{$models->local_time}}</span> </div>
                       <div class="tracking-content">{{$models->current_status}}<span>{{$models->current_address}}</span></div>
                    </div>
                    @endforeach
            </div>
            @if($shipment && $shipment->client)
            <div class="col-md-6 col-lg-6">
                <div class="vl">
                    <div class="px-3 py-1">
                        <p><strong>Estimated Delivery Date</strong>
                        <br>
                        {{ Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('d F, y') }}
                        </p>
                        <p><strong>Sender Details</strong>
                        <br>
                        {{ $shipment->client->name }}
                        <br>
                        {{ $shipment->client_address }}
                        <br>
                        {{ $shipment->client_phone }}
                        </p>
                        <p><strong>Reciever Details</strong>
                            <br>
                            {{ $shipment->reciver_name ? $shipment->reciver_name.'<br>': '' }}

                            {{ $shipment->reciver_address }}
                            <br>
                            {{ $shipment->reciver_phone }}
                        </p>
                        <p><strong>Additional Details</strong>
                            <br>
                            <span>Payment Type: </span> {{ $shipment->payment_method_id }}
                            <br>
                            <span>Shipping Cost: </span> {{ $shipment->shipping_cost }}
                            <br>
                           <span>Amount to be Collected: </span> {{ $shipment->amount_to_be_collected }}
                        </p>
                    </div>
                </div>
            </div>
            @endif  --}}
     </div>
</div>
@endsection

