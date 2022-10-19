@extends('cargo::adminLte.layouts.blank')

@php
    $pageTitle =  __('Vault Tracking') . ' #' . (isset($model) ? $model->vault_number : __('cargo::view.error'));
    $pageTitle =  __('Vault Username') . ' #' . (isset($model) ? $model->vault_username : __('cargo::view.error'));
    $pageTitle =  __('Vault Password') . ' #' . (isset($model) ? $model->vault_password : __('cargo::view.error'));

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
    border-color: blue;
   }

   .ic{
    color: #95bfcd;
    font-size: xx-large;
    text-shadow:3px 4px rgb(20 43 34 / 5%)
   }
</style>
@endsection
@section('page-content')
    @if(isset($error))
        <div id="shipments-tracking-page">
            <div id="shipments-tracking" class="widget bdaia-widget widget_mc4wp_form_widget">
                <div class="tracking-error">
                    <p class="bdaia-mc4wp-bform-p bd1-font"  >
                        {{ $error ?? '' }}
                    </p>
                </div>
                <div class="widget-inner">
                    <form class="form" action="{{route('shipments.vault.tracking')}}" method="GET">
                        <div class="bdaia-mc4wp-form-icon">
                            <span class="bdaia-io text-primary" style="line-height: 0">
                                <svg style="width:auto" height="58px" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m57.123 31.247v13.63h-12.247v-13.63zm3.925-4h27.552l-8.625-15.99h-20.155zm-18.868-15.99h-20.159l-8.621 15.99h27.551zm2.783 15.99h12.073l-1.229-15.99h-9.615zm2.03 44.992a25.612 25.612 0 0 1 .486-4.979h-19.888a5.133 5.133 0 0 0 -5.127 5.127v1.432a5.133 5.133 0 0 0 5.127 5.127h20.3a25.46 25.46 0 0 1 -.897-6.707zm7.393 17.875a25.231 25.231 0 0 1 -5.032-7.169h-21.763a9.137 9.137 0 0 1 -9.127-9.127v-1.431a9.137 9.137 0 0 1 9.127-9.127h21.04a25.28 25.28 0 0 1 41.507-8.9c.214.214.418.434.623.654v-23.767h-29.638v15.63a2 2 0 0 1 -2 2h-16.247a2 2 0 0 1 -2-2v-15.63h-29.638v60.185h44.58c-.49-.421-.97-.856-1.432-1.318zm10.36-23.922a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.08-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm-17.112-2.08a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.084-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm11.673 3.967a21.292 21.292 0 1 1 -21.3-21.292 21.292 21.292 0 0 1 21.292 21.292zm-6.716 0a14.576 14.576 0 1 0 -14.584 14.576 14.576 14.576 0 0 0 14.576-14.576zm29.934 37.387a6.864 6.864 0 0 1 -6.974 7.1 8.6 8.6 0 0 1 -6.214-2.785l-14.663-15.651a1 1 0 0 1 .023-1.391l.977-.977-3.057-3.057a25.493 25.493 0 0 0 6.036-6.044l3.061 3.061.977-.977a1 1 0 0 1 1.391-.023l15.651 14.656a8.624 8.624 0 0 1 2.784 6.088zm-4 .066a4.608 4.608 0 0 0 -1.52-3.233l-13.537-12.672-3.89 3.888 12.671 13.532a4.586 4.586 0 0 0 3.294 1.52 2.868 2.868 0 0 0 2.974-3.034z"/></svg>
                            </span>
                        </div>

                        <div class="mc4wp-form-fields">
                            <p>
                                <label >
                                    {{ __('cargo::view.enter_your_tracking_code') }}
                                </label>

                                <input type="text" name="vault_number" placeholder="{{__('cargo::view.example_SH00001')}}">
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
                                                <img alt="Logo" src="{{ asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                                                
                                                {{--  <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />  --}}
                                            </a>
                                        </p>
                                        <p class="mt-50 text-center"><a href="{{ route('home') }}" style="color: black !important;">{{ __('cargo::view.back_to_dashboard') }}</a></p>
                                        <p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{ __('For inquiries about your vault, please contact us from') }} <a href="#" style="color: black !important;">{{ __('cargo::view.here') }}</a>.</p>
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
                                                <h1 class="text-center display-5 font-weight-boldest mb-10">{{ __('Vault Number') }}: {{$model->vault_number}}</h1>
                                            </div>

                                            <div class="d-flex justify-content-between pb-6">
                                                {{--  <div class="d-flex flex-column flex-root">
                                                    <span class="text-dark font-weight-bold mb-4 text-uppercase">{{ __('cargo::view.current_status') }}</span>
                                                    <span class="opacity-70 d-block">{{$model->getStatus()}}</span>
                                                </div>  --}}
                                                @if ($model->amount_to_be_collected && $model->amount_to_be_collected  > 0)
                                                    <div class="d-flex flex-column flex-root">
                                                        <span class="text-dark text-right font-weight-bold mb-4 text-uppercase">{{ __('cargo::view.shipping_date') }}</span>
                                                        <span class="text-muted text-right font-weight-bolder font-size-lg">{{$model->shipping_date}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <table>
                                                    <tr>
                                                        <td class="text-uppercase">{{ __('Name of Depositer') }}</td>
                                                        <td>{{$model->client->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Phone</td>
                                                        <td>{{$model->client_phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Address</td>
                                                        <td>{{$model->client_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">username</td>
                                                        <td>{{$model->vault_username}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Item Description</td>
                                                        <td class="d-flex">
                                                            <div class="ic">
                                                            {!! $model->vault_icon !!}
                                                            </div>
                                                            <p class="pl-2 pt-1">{{ $model->item_des}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Status</td>
                                                        <td>
                                                            {{$model->getStatus()}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Next Kin</td>
                                                        <td>{{$model->next_kin}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">Arrears</td>
                                                        <td>{{$model->arrears}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase">{{ __('Date of deposit') }}</td>
                                                        <td>{{ Carbon\Carbon::parse($model->created_at)->format('d F, y') }}</td>

                                                    </tr>
                                            </table>
                                            <br>

                                            {{--
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase">{{ __('Name of Depositer') }}</th>
                                                        <th class="text-uppercase">Phone</th>
                                                        <th class="text-uppercase">Address</th>
                                                        <th class="text-uppercase">username</th>
                                                        <th class="text-uppercase">Status</th>
                                                        <th class="text-uppercase">Next Kin</th>
                                                        <th class="text-uppercase">Arrears</th>
                                                        <th class="text-uppercase">{{ __('Date of deposit') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$model->client->name}}</td>
                                                        <td>{{$model->client_phone}}</td>
                                                        <td>{{$model->client_address}}</td>
                                                        <td>{{$model->vault_username}}</td>
                                                        <td>{{$model->getStatus()}}
                                                            {!! $model->vault_icon !!}
                                                        </td>
                                                        <td>{{$model->next_kin}}</td>
                                                        <td>{{$model->arrears}}</td>
                                                        <td>{{ Carbon\Carbon::parse($model->created_at)->format('d F, y') }}</td>
                                                        @foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$model->id)->get() as $package)
                                                        <td>{{$package->qty}}</td>
                                                        @endforeach
                                                    </tr>
                                                    @foreach($model->logs()->orderBy('id','asc')->get() as $log)
                                                        <tr>
                                                            <td>{{$log->created_at->diffForHumans()}}</td>
                                                            <td>{{Modules\Cargo\Entities\Shipment::getClientStatusByStatusId($log->to)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  --}}
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

    {{--  <div class="container">
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
                @php
                    $code = filter_var($model->code, FILTER_SANITIZE_NUMBER_INT);
                @endphp
                <h1 class="display-4 font-weight-boldest mb-10">{{ __('Vault') }}: {{$model->vault_number}}</h1>

            </div>

             <div id="tracking">

                <div class="tracking-list">
                   <div class="tracking-item">
                    <div class="tracking-icon status-outfordelivery">
                        <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path>
                        </svg>
                        <!-- <i class="fas fa-shipping-fast"></i> -->
                    </div>
                      <div class="tracking-date"><span>Order Created</span> </div>
                      <div class="tracking-content">{{$model->client->name}}<span>{{$model->created_at->diffForHumans()}}</span></div>

                   </div>
                <div class="tracking-item">
                    <div class="tracking-icon status-outfordelivery">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                          <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                        </svg>

                       <!-- <i class="fas fa-shipping-fast"></i> -->
                    </div>
                    <div class="tracking-date"><span>Order Confirmed</span> </div>
                    <div class="tracking-content">{{$model->next_kin}}<span></span></div>
                 </div>
                   <div class="tracking-item">
                    <div class="tracking-icon status-outfordelivery">
                       <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path>
                       </svg>
                       <!-- <i class="fas fa-shipping-fast"></i> -->
                    </div>
                    <div class="tracking-date"><span>In Transit</span> </div>
                    <div class="tracking-content">{{ $model->status }}<span></span></div>

                 </div>

                   <div class="tracking-item">
                      <div class="tracking-icon status-inforeceived">
                         <svg class="svg-inline--fa fa-clipboard-list fa-w-12" aria-hidden="true" data-prefix="fas" data-icon="clipboard-list" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z"></path>
                         </svg>
                         <!-- <i class="fas fa-clipboard-list"></i> -->
                      </div>
                      <div class="tracking-date"><span>Delivered</span> </div>
                    <div class="tracking-content">{{ $model->item_des }}<span></span></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>  --}}
@endsection

