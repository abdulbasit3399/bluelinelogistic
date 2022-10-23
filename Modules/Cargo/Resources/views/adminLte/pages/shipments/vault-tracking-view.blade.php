{{--  @extends('cargo::adminLte.layouts.blank')  --}}
@extends('cargo::adminLte.template.layout.layout')

@php
    $pageTitle =  __('cargo::view.tracking');
@endphp

@section('pageTitle', $pageTitle )

@section('page-type', 'page')

@section('styles')
@endsection
@section('content')
<br>
<br>
<br>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div id="shipments-tracking-page" class="mb-5">
                <div id="shipments-tracking" class="widget bdaia-widget widget_mc4wp_form_widget">
                    <div class="widget-inner">
                        <form class="form" action="{{ route('shipments.vault.tracking') }}" method="GET">

                            <div class="row justify-content-center">
                                @if(\Session::has('error'))
                                <div class="col-md-6">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{\Session::get('error')}}</strong>
                                
                                </div>
                                </div>
                                @endif
                            </div>

                            <h5 class="text-dark text-center my-4">Please insert your tracking number to know your Vault!</h5>
                            <div class="px-4">
                            <div class="row">
                                <div class="col-11">
                                    <input type="text" name="vault_number" class="form-control @error('vault_number') is-invalid @enderror" placeholder="VA00001">

                                </div>
                                <div class="col-1">
                                    <input type="submit" class="btn btn-success" value="Track">
                                </div>
                            </div>
                            </div>

                            {{--<div class="row">

                                <p class="bdaia-mc4wp-bform-p2 bd2-font col-sm-6" >
                                    <label>
                                        Enter Your Vault Tracking Number1
                                    </label>

                                    <input type="text" name="vault_number" class="@error('vault_number') is-invalid @enderror" placeholder="VA00001">
                                    @error('vault_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </p>
                                  <br>
                                <p class="col-sm-12"></p>

                                <br>
                                <p class="bdaia-mc4wp-bform-p2 bd2-font col-sm-6" >
                                    <label>
                                        Enter Vault Username
                                    </label>

                                    <input type="text" name="vault_username" class="@error('vault_username') is-invalid @enderror" placeholder="">
                                    @error('vault_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <br>
                                <p class="col-sm-12"></p>

                                <br>

                                <p class="bdaia-mc4wp-bform-p2 bd2-font col-sm-6">
                                    <label>
                                        Enter Vault Password
                                    </label>

                                    <input type="password" name="vault_password" class="col-sm-12"  placeholder="">
                                </p>
                            </div>
                            <div class="row d-flex justify-content-center">
                            <input type="submit" class="btn btn-submit" value="{{__('cargo::view.search')}}">
                            </div>--}}
                        </form>
                    </div>
                </div>
            </div><!--#shipments-tracking-page -->
        </div>
    </div>
</div>
    <br>
    <br>
@endsection
@section('scripts')
<script>
    @if(session()->has('error'))
        $.notify("{{ session()->get('error') }}", "error");
    @endif
</script>
@endsection
