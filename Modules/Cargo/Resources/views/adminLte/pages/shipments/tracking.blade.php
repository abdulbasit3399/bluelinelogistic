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
    <div class="card px-8">
        <div class="row justify-content-center">
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

             {{--  <div class="d-flex justify-content-between pb-0 pb-md-10 ">
                 {{--  @php
                     $code = filter_var($model->shipment_id, FILTER_SANITIZE_NUMBER_INT);
                 @endphp  --}}
                {{-- @if(isset($error))
                <h1 class="display-5 font-weight-boldest mb-0" style="color:red">{{$error}}</h1>
                @else
                <h1 class="display-5 font-weight-boldest mb-0">{{ __('Shipment Tracking') }}</h1>
                @endif
             </div>  --}}
        </div>
        <h1 class="text-start display-5 font-weight-boldest mb-0 px-10">{{ __('Shipment Tracking') }}: {{$shipment->code}}</h1>

        <div class="card-body">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-uppercase fw-bold">{{ __('cargo::view.client_sender') }}</th>
                        <td>{{$shipment->client->name}}</td>
                        
                    </tr>
                    <tr>
                    <th class="text-uppercase fw-bold">sender address</th>
                        <td>{{$shipment->client_address}}</td>
                    
                    </tr>
                    <tr>
                    <th class="text-uppercase fw-bold">{{ __('cargo::view.date') }}</th>
                        <td>{{ Carbon\Carbon::parse($shipment->created_at)->format('d F, y') }}</td>
                    
                    </tr>
                    <tr>
                    <th class="text-uppercase fw-bold">{{ __('Amount') }}</th>
                        <td>{{$shipment->amount_to_be_collected}}</td>
                        
                    </tr>
                    <tr>
                    <th class="text-uppercase fw-bold">{{ __('cargo::view.receiver') }}</th>
                        <td>{{$shipment->reciever->name}}</td>
                    </tr>
                    
                    <tr>
                    <th class="text-uppercase fw-bold">reciever address</th>
                        <td>{{$shipment->reciver_address}}</td>
                    
                    </tr>
                    <tr>
                        <th class="text-uppercase fw-bold">quantity</th>
                        <td>{{$shipment->quantity}}</td>

                    </tr>

                </thead>
                <tbody>
                    <tr>

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
    </div>
</div>

<div class="container mt-4">
    <div class="card px-8">
        <div class="row justify-content-center">
        <div class="card-body">
        <h3 class="bl">Package Progress</h3>
            <table class="table table-responsive table-striped table-hover">

                <thead>
                    <th class="text-uppercase fw-bold">{{ __('Location') }}</th>
                    <th class="text-uppercase fw-bold">Receipt no.</th>
                    <th class="text-uppercase fw-bold">{{ __('Customer') }}</th>
                    <th class="text-uppercase fw-bold">{{ __('Date') }}</th>
                    <th class="text-uppercase fw-bold">{{ __('Local Time') }}</th>
                    <th class="text-uppercase fw-bold">Icon</th>
                    <th class="text-uppercase fw-bold">Activity</th>

                </thead>
            @foreach ($shipment_status as $st)

                <tbody>
                <tr>
                    <td class="px-3">{{$st->current_address}}</td>
                    <td class="px-3">{{$st->receipt_no}}</td>
                    <td class="px-3">{{$st->depositor}}</td>
                    <td class="px-3">{{ Carbon\Carbon::parse($st->created_at)->format('d F, y') }}</td>
                    <td class="px-3">{{$st->local_time}}</td>
                    <td class="px-3"> {!!$st->ship_icon!!}</td>
                    <td class="px-3">{{$st->current_status}}</td>
                </tr>
                </tbody>
            
            @endforeach

            </table>

        </div>
        </div>
    </div>
</div>

@endsection

