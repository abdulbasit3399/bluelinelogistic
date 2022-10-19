@extends('adminLte.auth.layout')

@section('pageTitle')
    Forgot password
@endsection

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ aurl('/') }}" class="mb-12">
            @php 
                $model = App\Models\Settings::where('group', 'general')->where('name','login_page_logo')->first();
                $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
            @endphp
            <img alt="Logo" src="{{ $model->getFirstMediaUrl('login_page_logo') ? $model->getFirstMediaUrl('login_page_logo') : ( $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/cargo-logo.svg') ) }}" style="max-width: 88px;max-height: 52px;" />
            </a>
        </div>
        <div class="card-body">
            <h3 class="widget-title">{{ __('Forgot Password ?') }}</h3>
            <h6 class="widget-sub-title widget-title">{{ __('Enter your email to reset your password.') }}</h6>
            <!--begin::Forgot Password Form-->
            <form method="POST" action="{{ route('password.email') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                @csrf

                <!--begin::Input group-->
                <div class="fv-row mb-3">
                    <label class="form-label fw-bolder text-gray-900 fs-6">{{ __('Email') }}</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" autocomplete="off" value="{{ old('email') }}" required autofocus/>
                    @error('email') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" id="kt_password_reset_submit" class="btn btn-primary btn-block">
                            {{ __('Send') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>
            <!--end::Forgot Password Form-->
        </div>
    </div>
</div>

<style type="text/css" media="all">
  body {
    background: #FFF !important;
  }
  div.login-box {
    width: 500px;
  }
  div.login-box div.card {
    padding: 2.75rem 3.75rem!important;
    box-shadow: 0 .1rem 1rem .25rem rgba(0,0,0,.05)!important;
    border-radius: 0.475rem!important;
    border: 0 none !important;
  }
  div.login-box div.card div.card-body {
    padding: 24px 0 0 0 !important;
  }
  div.login-box div.card-header {
    padding: 0 !important;
    border: 0 none !important;
    margin-bottom: 24px !important;
  }
  p.forgot-password {
    text-align: center;
    padding-top: 30px;
    margin: 0 auto !important;
  }

  .widget-title {
    padding: 0 !important;
    margin: 0 auto 24px !important;
    text-align: center !important;
    position: relative !important;
    display: block !important;
    font-size: 22px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
  }
  .widget-sub-title{
    font-size: 16px !important;
  }

  .form-control {
    height: calc(50px + 2px) !important;
    border-radius: 5px !important;
  }

  .input-group:not(.has-validation) > .form-control:not(:last-child), .input-group:not(.has-validation) > .custom-select:not(:last-child), .input-group:not(.has-validation) > .custom-file:not(:last-child) .custom-file-label::after
  {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
  }

  @media (max-width: 767px)
  {
    html, body {
      margin: 0 !important;
      padding: 0 !important;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
      overflow-x: hidden !important;
      width: unset !important;
      height: unset !important;
    }
    body { min-height: unset !important; }
    div.login-box {
      width: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
    }
    div.login-box div.card {
      padding: 40px 24px !important;
      background: none transparent !important;
      box-shadow: none !important;

    }
  }
</style>
@endsection
