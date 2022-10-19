@extends('cargo::adminLte.layouts.blank')

@php
    $pageTitle =  __('cargo::view.tracking');
@endphp

@section('page-title', $pageTitle )

@section('page-type', 'page')

@section('styles')
@endsection
@section('page-content')

    <div id="shipments-tracking-page" class="mb-5">
        <div id="shipments-tracking" class="widget bdaia-widget widget_mc4wp_form_widget">
            <div class="widget-inner">
                <form class="form" action="{{ route('shipments.vault.tracking') }}" method="GET">


                    <p class="bdaia-mc4wp-bform-p bd1-font"  >
                        Vault Tracking
                    </p>
                    <div class="row justify-content-center">
                        @if(\Session::has('error'))
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{\Session::get('error')}}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        </div>
                        @endif
                    </div>

                    <div class="row">

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
                    </div>
                </form>
            </div>
        </div>
    </div><!--#shipments-tracking-page -->
    <br>
    <br>
@endsection
@push('js-component')
<script>
    @if(session()->has('error'))
        $.notify("{{ session()->get('error') }}", "error");
    @endif
</script>
@endpush
