{{--  @extends('cargo::adminLte.layouts.blank')  --}}
@extends('cargo::adminLte.template.layout.layout')
@section('pageTitle')
    Vault Tracking
@endsection
@php
    $pageTitle =  __('Vault Tracking') . ' #' . (isset($model) ? $model->vault_number : __('cargo::view.error'));
    $pageTitle =  __('Vault Username') . ' #' . (isset($model) ? $model->vault_username : __('cargo::view.error'));
    $pageTitle =  __('Vault Password') . ' #' . (isset($model) ? $model->vault_password : __('cargo::view.error'));

    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();

    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
@endphp
@section('content')
<div class="container mt-4">
    <!--begin::Card-->
    <div class="card">
        <div class="alert alert-custom alert-white mb-0 pb-0" role="alert">
            <div class="alert-text">
                <!--begin::Logo-->
                <p   class="d-block py-10 text-center">
                    <a href="{{ route('home') }}">
                        <img alt="Logo" src="{{ asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                    </a>
                </p>
                <p class="mt-50 text-center"><a href="{{ route('home') }}" style="color: black !important;">{{ __('cargo::view.back_to_dashboard') }}</a></p>
                <p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{ __('For inquiries about your vault, please contact us from') }} <a href="#" style="color: black !important;">{{ __('cargo::view.here') }}</a>.</p>
            </div>
        </div>
        <div class="card-body p-0 pb-10">
            <div class="px-10 mx-10">
                <h1 class="display-5 font-weight-boldest mb-8 ">{{ __('Vault Number') }}: {{$model->vault_number}}</h1>
                <table class="table table-responsive table-striped table-hover">
                    <tbody>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">{{ __('Name of Depositer') }}</th>
                            <td>{{$model->client->name}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">Phone</th>
                            <td>{{$model->client_phone}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">Address</th>
                            <td>{{$model->client_address}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">username</th>
                            <td>{{$model->vault_username}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">Status</th>
                            <td>{{$model->getStatus()}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">Next Kin</th>
                            <td>{{$model->next_kin}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">Arrears</th>
                            <td>{{$model->arrears}}</td>
                        </tr>
                        <tr class="text-start" style="border: none">
                            <th class="text-uppercase fw-bold">{{ __('Date of deposit') }}</th>
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
                </table>
            </div>
        </div>
    </div>
</div>
<br>
@endsection


{{--  @extends('cargo::adminLte.template.layout.layout')
@section('pageTitle')
    Vault Tracking
@endsection
@php
    $pageTitle =  __('Vault Tracking') . ' #' . (isset($model) ? $model->vault_number : __('cargo::view.error'));
    $pageTitle =  __('Vault Username') . ' #' . (isset($model) ? $model->vault_username : __('cargo::view.error'));
    $pageTitle =  __('Vault Password') . ' #' . (isset($model) ? $model->vault_password : __('cargo::view.error'));

    use \Milon\Barcode\DNS1D;
    $d = new DNS1D();

    $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
@endphp

@section('content')
<div class="container mt-4">
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
            <div class="alert-text">
                <!--begin::Logo-->
                <p class="d-block py-10 text-center">
                    <a href="{{ route('home') }}">
                        <img alt="Logo" src="{{ asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />

                    </a>
                </p>
                <p class="mt-50 text-center"><a href="{{ route('home') }}" style="color: black !important;">{{ __('cargo::view.back_to_dashboard') }}</a></p>
                <p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{ __('For inquiries about your vault, please contact us from') }} <a href="#" style="color: black !important;">{{ __('cargo::view.here') }}</a>.</p>
            </div>
        </div>
        <h1 class="text-start display-5 font-weight-boldest mb-8 px-10">{{ __('Vault Number') }}: {{$model->vault_number}}</h1>
        <div class="card-body p-0 pb-10">
            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center pt-0 px-8 px-md-0">
                <div class="col-11">
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
                                <td>{{$model->getStatus()}}</td>
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
                    </table>
                </div>
            </div>
            <!-- end: Invoice header-->
        </div>
    </div>
    <!--end::Card-->
</div>
@endsection  --}}
