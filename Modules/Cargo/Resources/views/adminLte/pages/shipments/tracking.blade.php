@extends('cargo::adminLte.layouts.blank')

@php
$pageTitle =  __('cargo::view.tracking_shipment');

    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();

    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
@endphp

@section('page-title', $pageTitle )

@section('page-type', 'page')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>

    .tracking-detail {
        padding:3rem 0
       }
       #tracking {
        margin-bottom:1rem
       }
       [class*=tracking-status-] p {
        margin:0;
        font-size:1.1rem;
        color:#fff;
        text-transform:uppercase;
        text-align:center
       }
       [class*=tracking-status-] {
        padding:1.6rem 0
       }
       .tracking-status-intransit {
        background-color:#65aee0
       }
       .tracking-status-outfordelivery {
        background-color:#f5a551
       }
       .tracking-status-deliveryoffice {
        background-color:#f7dc6f
       }
       .tracking-status-delivered {
        background-color:#4cbb87
       }
       .tracking-status-attemptfail {
        background-color:#b789c7
       }
       .tracking-status-error,.tracking-status-exception {
        background-color:#d26759
       }
       .tracking-status-expired {
        background-color:#616e7d
       }
       .tracking-status-pending {
        background-color:#ccc
       }
       .tracking-status-inforeceived {
        background-color:#214977
       }
       .tracking-list {
        border:1px solid #e5e5e5
       }
       .tracking-item {
        border-left:1px solid #e5e5e5;
        position:relative;
        padding:2rem 1.5rem .5rem 2.5rem;
        font-size:.9rem;
        margin-left:3rem;
        min-height:5rem
       }
       .tracking-item:last-child {
        padding-bottom:4rem
       }
       .tracking-item .tracking-date {
        margin-bottom:.5rem
       }
       .tracking-item .tracking-date span {
        color:#888;
        font-size:85%;
        padding-left:.4rem
       }
       .tracking-item .tracking-content {
        padding:.5rem .8rem;
        background-color:#f4f4f4;
        border-radius:.5rem
       }
       .tracking-item .tracking-content span {
        display:block;
        color:#888;
        font-size:85%
       }
       .tracking-item .tracking-icon {
        line-height:2.6rem;
        position:absolute;
        left:-1.3rem;
        width:2.6rem;
        height:2.6rem;
        text-align:center;
        border-radius:50%;
        font-size:1.1rem;
        background-color:#fff;
        color:#fff
       }
       .tracking-item .tracking-icon.status-sponsored {
        background-color:#f68
       }
       .tracking-item .tracking-icon.status-delivered {
        background-color:#4cbb87
       }
       .tracking-item .tracking-icon.status-outfordelivery {

       }
       .tracking-item .tracking-icon.status-deliveryoffice {
        background-color:#f7dc6f
       }
       .tracking-item .tracking-icon.status-attemptfail {
        background-color:#b789c7
       }
       .tracking-item .tracking-icon.status-exception {
        background-color:#d26759
       }
       .tracking-item .tracking-icon.status-inforeceived {
        background-color:#214977
       }
       .tracking-item .tracking-icon.status-intransit {
        color:#e5e5e5;
        border:1px solid #e5e5e5;
        font-size:.6rem
       }
       @media(min-width:992px) {
        .tracking-item {
         margin-left:10rem
        }
        .tracking-item .tracking-date {
         position:absolute;
         left:-10rem;
         width:7.5rem;
         text-align:right
        }
        .tracking-item .tracking-date span {
         display:block
        }
        .tracking-item .tracking-content {
         padding:0;
         background-color:transparent
        }
       }
       .tracking-icon >i{
        color: #4cbb87;
       }
       .tracking-icon{
        border: 2px solid;
        border-color: lightblue;
       }

       .vl {
        border-left: 1px solid lightslategray;
        height: 100%;
        left: 50%;
        margin-left: -3px;
        top: 0;
      }

      .es{
        font-size: 20px;
      }
    </style>
@endsection

@section('page-content')
    {{--  @if(isset($error))

        <div id="shipments-tracking-page">
            <div id="shipments-tracking" class="widget bdaia-widget widget_mc4wp_form_widget">
                <div class="tracking-error">
                    <p class="bdaia-mc4wp-bform-p bd1-font"  >
                        {{ $error ?? '' }}
                    </p>
                </div>

                <div class="widget-inner">
                    <form class="form" action="{{route('shipments.tracking')}}" method="GET">
                        <div class="bdaia-mc4wp-form-icon">
                            <span class="bdaia-io text-primary" style="line-height: 0">
                                <svg style="width:auto" height="58px" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m57.123 31.247v13.63h-12.247v-13.63zm3.925-4h27.552l-8.625-15.99h-20.155zm-18.868-15.99h-20.159l-8.621 15.99h27.551zm2.783 15.99h12.073l-1.229-15.99h-9.615zm2.03 44.992a25.612 25.612 0 0 1 .486-4.979h-19.888a5.133 5.133 0 0 0 -5.127 5.127v1.432a5.133 5.133 0 0 0 5.127 5.127h20.3a25.46 25.46 0 0 1 -.897-6.707zm7.393 17.875a25.231 25.231 0 0 1 -5.032-7.169h-21.763a9.137 9.137 0 0 1 -9.127-9.127v-1.431a9.137 9.137 0 0 1 9.127-9.127h21.04a25.28 25.28 0 0 1 41.507-8.9c.214.214.418.434.623.654v-23.767h-29.638v15.63a2 2 0 0 1 -2 2h-16.247a2 2 0 0 1 -2-2v-15.63h-29.638v60.185h44.58c-.49-.421-.97-.856-1.432-1.318zm10.36-23.922a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.08-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm-17.112-2.08a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.084-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm11.673 3.967a21.292 21.292 0 1 1 -21.3-21.292 21.292 21.292 0 0 1 21.292 21.292zm-6.716 0a14.576 14.576 0 1 0 -14.584 14.576 14.576 14.576 0 0 0 14.576-14.576zm29.934 37.387a6.864 6.864 0 0 1 -6.974 7.1 8.6 8.6 0 0 1 -6.214-2.785l-14.663-15.651a1 1 0 0 1 .023-1.391l.977-.977-3.057-3.057a25.493 25.493 0 0 0 6.036-6.044l3.061 3.061.977-.977a1 1 0 0 1 1.391-.023l15.651 14.656a8.624 8.624 0 0 1 2.784 6.088zm-4 .066a4.608 4.608 0 0 0 -1.52-3.233l-13.537-12.672-3.89 3.888 12.671 13.532a4.586 4.586 0 0 0 3.294 1.52 2.868 2.868 0 0 0 2.974-3.034z"/></svg>
                            </span>
                        </div>

                        <p class="bdaia-mc4wp-bform-p bd1-font"  >
                            {{ __('cargo::view.tracking_shipment') }}
                        </p>

                        <p class="bdaia-mc4wp-bform-p2 bd2-font" >
                            {{ __('cargo::view.enter_your_tracking_code') }}
                        </p>

                        <div class="mc4wp-form-fields">
                            <p>
                                <label >
                                    {{ __('cargo::view.enter_your_tracking_code') }}
                                </label>

                                <input type="text" name="code" placeholder="{{__('cargo::view.example_SH00001')}}">
                            </p>
                            <p>
                                <input type="submit" class="btn btn-submit submit" value="{{__('cargo::view.search')}}">
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--#shipments-tracking-page -->
    @else
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b">
                                <div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
                                    <div class="alert-text">
                                        <!--begin::Logo-->
                                        <p class="d-block py-10 text-center">
                                            <a href="{{ route('home') }}">
                                                <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                                            </a>
                                        </p>
                                        <p class="mt-50 text-center"><a href="{{ route('home') }}" style="color: black !important;">{{ __('cargo::view.back_to_dashboard') }}</a></p>
                                        <p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{ __('cargo::view.tracking_note') }} <a href="#" style="color: black !important;">{{ __('cargo::view.here') }}</a>.</p>
                                    </div>
                                </div>
                                <div class="card-body p-0 pb-10">
                                    <!-- begin: Invoice-->
                                    <!-- begin: Invoice header-->
                                    <div class="row justify-content-center pt-8 px-8 px-md-0">
                                        <div class="col-md-10">
                                            <div class="d-flex justify-content-between pb-10 pb-md-10 flex-column flex-md-row">
                                                @php
                                                    $code = filter_var($model->code, FILTER_SANITIZE_NUMBER_INT);
                                                @endphp
                                                <h1 class="display-4 font-weight-boldest mb-10">{{ __('cargo::view.shipment') }}: {{$model->code}}</h1>
                                            </div>

                                            <div class="d-flex justify-content-between pb-6">
                                                <div class="d-flex flex-column flex-root">
                                                    <span class="text-dark font-weight-bold mb-4 text-uppercase">{{ __('cargo::view.current_status') }}</span>
                                                    <span class="opacity-70 d-block">{{$model->getStatus()}}</span>
                                                </div>
                                                @if ($model->amount_to_be_collected && $model->amount_to_be_collected  > 0)
                                                    <div class="d-flex flex-column flex-root">
                                                        <span class="text-dark text-right font-weight-bold mb-4 text-uppercase">{{ __('cargo::view.shipping_date') }}</span>
                                                        <span class="text-muted text-right font-weight-bolder font-size-lg">{{$model->shipping_date}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="border-bottom w-100"></div>
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase">Location</th>
                                                        <th class="text-uppercase">{{ __('cargo::view.client_sender') }}</th>
                                                        <th class="text-uppercase">sender address</th>
                                                        <th class="text-uppercase">{{ __('cargo::view.date') }}</th>
                                                        <th class="text-uppercase">{{ __('cargo::view.shipment') }}</th>
                                                        <th class="text-uppercase">{{ __('cargo::view.receiver') }}</th>
                                                        <th class="text-uppercase">reciever address</th>
                                                        <th class="text-uppercase">quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>sasas</td>

                                                        <td>{{$model->client->name}}</td>
                                                         <td>{{$model->client_address}}</td>
                                                        <td>{{$model->created_at->diffForHumans()}}</td>
                                                        <td>{{ __('cargo::view.created') }}</td>
                                                        <td>{{$model->reciever->name}}</td>
                                                        <td>{{$model->reciver_address}}</td>
                                                    @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$model->id)->get() as $package)
                                                        <td>{{$package->qty}}</td>
                                                    @endforeach
                                                    </tr>
                                                    @foreach($model->logs()->orderBy('id','asc')->get() as $log)
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
                                    <!-- end: Invoice header-->
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                </div>

                <!--end::Content-->
            </div>

        </div>
    @endif
    <br>  --}}

    <div class="container">
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
                <h1 class="display-5 font-weight-boldest mb-10" style="color:red">{{$error}}</h1>
                @else
                <h1 class="display-5 font-weight-boldest mb-10">{{ __('Shipment Tracking') }}</h1>
                @endif

             </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">

                 {{--  <div class="text-center tracking-status-intransit">
                    <p class="tracking-status text-tight">in transit</p>
                 </div>  --}}

                    @foreach ($shipment_status as $models)
                    <div class="tracking-item">
                     <div class="tracking-icon">
                         {{--  <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                         <path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path>
                         </svg>  --}}
                         {!! $models->ship_icon !!}
                     </div>
                       <div class="tracking-date">{{ Carbon\Carbon::parse($models->date)->format('d F, y') }}<span>{{$models->local_time}}</span> </div>
                       {{--  <div class="tracking-date">{{ Carbon\Carbon::parse($models->date)->format('F,d Y') }}<span>{{$models->local_time}}</span> </div>  --}}

                       <div class="tracking-content">{{$models->current_status}}<span>{{$models->current_address}}</span></div>

                       {{--  <div class="tracking-content">SHIPMENT DELAYSHIPPER INSTRUCTION TO DESTROY<span>SHENZHEN, CHINA, PEOPLE'S REPUBLIC</span></div>  --}}
                    </div>
                    @endforeach
            </div>
            @if($shipment)
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
            @endif
        </div>
     </div>
@endsection

