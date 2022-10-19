@extends('adminLte.auth.layout')

@section('pageTitle')
    {{ __('view.sign_in') }}
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
    @if(env('DEMO_MODE') == 'On')
      <div class="mb-10">
        <table class="kt-form">
          <tbody>

            <tr>
              <td colspan="3" style="
                  text-align: left;
                  background: #ffefbe;
                  padding: 18px 24px;
                  border: 0 none !important;
                  border-radius: 8px;
                  margin-bottom: 20px;
                  width: 100%;
                  font-size: 13px;
                  color: #a87831;">
                <div style="font-size: 15px !important; text-align: center !important; margin-bottom: 10px !important;">
                  {{ __('view.demo_login_details') }}
                </div>
                {{ __('view.demo_details') }}
              </td>
            </tr>
            <tr>
              <td  colspan="3">
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <span style="font-weight: bold; font-size: 12px">
                  {{ __('view.ADMIN') }}
                </span>
                <br />
                <span id="login_admin" style="color: #EE6517; font-size: 13px; text-decoration: underline; margin-bottom: 15px; display: block;cursor: pointer;">{{ __('view.click_to_copy') }}</span>
              </td>
              <td>
                <span style="opacity: 0.8;">
                  admin@admin.com
                </span>
                <br>
                <span style="opacity: 0.6; font-size: 12px; margin-bottom: 15px; display: block">123456</span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="font-weight: bold; font-size: 12px">
                {{ __('view.EMPLOYEE') }}
                </span>
                <br />
                <span id="login_employee" style="color: #EE6517; font-size: 13px; text-decoration: underline; margin-bottom: 15px; display: block;cursor: pointer;">{{ __('view.click_to_copy') }}</span>
              </td>
              <td>
                employee@cargo.com
                <br>
                <span style="opacity: 0.6; font-size: 12px; margin-bottom: 15px; display: block">123456</span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="font-weight: bold; font-size: 12px">
                {{ __('view.BRANCH_MANAGER') }}
                </span>
                <br />
                <span id="login_branch" style="color: #EE6517; font-size: 13px; text-decoration: underline; margin-bottom: 15px; display: block;cursor: pointer;">{{ __('view.click_to_copy') }}</span>
              </td>
              <td>
                branch@cargo.com
                <br>
                <span style="opacity: 0.6; font-size: 12px; margin-bottom: 15px; display: block">123456</span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="font-weight: bold; font-size: 12px">
                {{ __('view.DRIVER_CAPTAIN') }}
                </span>
                <br />
                <span id="login_driver" style="color: #EE6517; font-size: 13px; text-decoration: underline; margin-bottom: 15px; display: block;cursor: pointer;">{{ __('view.click_to_copy') }}</span>
              </td>
              <td>
                driver@cargo.com
                <br>
                <span style="opacity: 0.6; font-size: 12px; margin-bottom: 15px; display: block">123456</span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="font-weight: bold; font-size: 12px">
                {{ __('view.CUSTOMER') }}
                </span>
                <br />
                <span id="login_client" style="color: #EE6517; font-size: 13px; text-decoration: underline; margin-bottom: 15px; display: block;cursor: pointer;">{{ __('view.click_to_copy') }}</span>
              </td>
              <td>
                client@cargo.com
                <br>
                <span style="opacity: 0.6; font-size: 12px; margin-bottom: 15px; display: block">123456</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    @endif
    <div class="card-body">
      <h3 class="widget-title">{{ __('view.LOG_IN_TO_YOUR_ACCOUNT') }}</h3>

        @error('email')
            <div class="mb-10 bg-light-info p-8 rounded">
                <div class="text-danger"> {{ $message }} </div>
            </div>
        @enderror

      <form method="POST" action="{{ route('login.request') }}" novalidate="novalidate" id="kt_sign_in_form">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('view.Email') }}" autocomplete="off" value="{{ old('email', 'admin@admin.com') }}" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('view.Password') }}" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember" style="font-size: 13px; font-weight: normal">
                {{ __('view.remember_me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('view.login') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="forgot-password">
        <!--begin::Link-->
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('view.forgot_password') }}
            </a>
        @endif
        <!--end::Link-->
      </p>

      @if (check_module('cargo'))
      <p class="forgot-password">
        <!--begin::Link-->
          <a href="{{ route('register') }}">
              {{ __('view.register_as_a_customer') }}
          </a>
        <!--end::Link-->
      </p>
      @endif
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function autoFill(){
        $('#email').val('admin@admin.com');
        $('#password').val('123456');
    }


    @if(env('DEMO_MODE') == 'On')
      // Class Initialization
      $(document).ready(function() {
        autoFill();

        $('body').on('click','#login_admin', function(e){
          $('#email').val('admin@admin.com');
          $('#password').val('123456');
          $('#signin_submit').trigger('click');
        });
        $('body').on('click','#login_employee', function(e){
          $('#email').val('employee@cargo.com');
          $('#password').val('123456');
          $('#signin_submit').trigger('click');
        });
        $('body').on('click','#login_driver', function(e){
          $('#email').val('driver@cargo.com');
          $('#password').val('123456');
          $('#signin_submit').trigger('click');
        });
        $('body').on('click','#login_branch', function(e){
          $('#email').val('branch@cargo.com');
          $('#password').val('123456');
          $('#signin_submit').trigger('click');
        });
        $('body').on('click','#login_client', function(e){
          $('#email').val('client@cargo.com');
          $('#password').val('123456');
          $('#signin_submit').trigger('click');
        });

      });
    @endif
</script>
@endsection


