@extends('adminLte.auth.layout')

@section('pageTitle')
    Reset password
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
            <h3 class="widget-title">{{ __('Update Your Password') }}</h3>
            <h6 class="widget-title widget-sub-title">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</h6>
            <!--begin::Forgot Password Form-->
            <form method="POST" action="{{ route('password.update') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->token }}">

                @error('token')
                    <div class="mb-10 bg-light-info p-8 rounded">
                        <div class="text-danger"> {{ $message }} </div>
                    </div>
                @enderror

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">{{ __('Email') }}</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" autocomplete="off" value="{{ old('email', $request->email) }}" required/>
                    @error('email') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-7 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6">
                            {{ __('Password') }}
                        </label>
                        <!--end::Label-->

                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-2">
                            <input class="form-control form-control-lg" type="password" name="password" autocomplete="new-password"/>
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <!--end::Input wrapper-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Hint-->
                    <div class="text-muted">
                        {{ __('Use 6 or more characters with a mix of letters, numbers & symbols.') }}
                    </div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group--->

                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-gray-900 fs-6">{{ __('Confirm Password') }}</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="off" required/>
                    @error('password') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Actions-->
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" id="kt_password_reset_submit" class="btn btn-primary btn-block">
                            {{ __('Update') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Actions-->

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

