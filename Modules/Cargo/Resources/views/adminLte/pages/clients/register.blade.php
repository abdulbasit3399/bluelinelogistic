@extends('adminLte.auth.layout')

@section('pageTitle')
    {{ __('Sign In') }}
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
          <!-- <img alt="Logo" src="{{ $model->getFirstMediaUrl('login_page_logo') ? $model->getFirstMediaUrl('login_page_logo') : ( $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') ) }}" style="max-width: 88px;max-height: 52px;" /> -->
          <img alt="Logo" src="{{ asset('assets/lte/media/logos/bll.png') }}" style="max-width: 160px;max-height: 52px;" />
        </a>
    </div>
    <div class="card-body">
      <h3 class="widget-title">{{ __('cargo::view.create_a_new_account') }}</h3>
      <form method="POST" action="{{ route('register.request') }}" novalidate="novalidate" id="kt_sign_in_form">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="{{ __('cargo::view.table.full_name') }}" autocomplete="off" value="{{ old('name') }}" required autofocus>
            @error('name') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required id="email" placeholder="{{ __('cargo::view.table.email') }}" autocomplete="off" value="{{ old('email') }}" required>
            @error('email') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required id="password" placeholder="{{ __('cargo::view.table.password') }}" autocomplete="off" required>
            @error('password') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control @error('national_id') is-invalid @enderror" name="national_id" required placeholder="{{ __('cargo::view.table.owner_national_id') }}" autocomplete="off" value="{{ old('national_id') }}" required autofocus>
            @error('national_id') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control @error('responsible_name') is-invalid @enderror" name="responsible_name" required placeholder="{{ __('cargo::view.table.owner_name') }}" autocomplete="off" value="{{ old('responsible_name') }}" required autofocus>
            @error('responsible_name') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('responsible_mobile') is-invalid @enderror" name="responsible_mobile" required placeholder="{{ __('cargo::view.table.owner_phone') }}" autocomplete="off" value="{{ old('responsible_mobile') }}" required autofocus>
            @error('responsible_mobile') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!--begin::Input group-->
        <div class="input-group mb-3">
            <select
                class="form-control select-branch  @error('branch_id') is-invalid @enderror"
                name="branch_id"
            >
                <option></option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" 
                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                    >{{ $branch->name }}</option>
                @endforeach
            </select>
            @error('branch_id') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="terms_conditions" class="@error('terms_conditions') is-invalid @enderror" id="remember">
              <label for="remember" style="font-size: 13px; font-weight: normal" required>
                {{ __('cargo::view.terms_and_conditions') }}
              </label>
                @error('terms_conditions') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('cargo::view.register') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="forgot-password">
        {{ __('cargo::view.already_have_an_account') }}
        <!--begin::Link-->
            <a href="{{ route('login') }}">
                {{ __('cargo::view.login') }}
            </a>
        <!--end::Link-->
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/select2/css/select2.min.css">
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
    .select2-container--default .select2-selection--single {
        height: 100% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.select-branch').select2({ 
        placeholder: "{{ __('cargo::view.table.choose_branch') }}",
        width: '100%',
    })
</script>
@endsection


