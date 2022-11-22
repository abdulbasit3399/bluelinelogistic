{{--  @extends('adminLte.auth.layout')  --}}

@extends('adminLte.layout.userlayout')

@section('pageTitle')
    {{ __('User Login') }}
@endsection
@section('content')
<div class="container mt-4">
    @if (\Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{\Session::get('error')}}
        {{--  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  --}}
    </div>
    @endif
    <div class="card mb-4" style="border-radius: 1rem;">
        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="col-12 text-center mt-3">
                <a href="https://bluelinelogistic.net/">
                <img src="{{ asset('assets/lte/bll.png') }}" alt="" height="80px" width="160px">
                </a>
            </div>
            <div class="col-md-6 col-lg-6 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">
                <form method="POST" action="{{ route('userlogin.store') }}" novalidate="novalidate" id="kt_sign_in_form">
                    @csrf
                <input type="hidden" value="Good" name="type">

                <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;"><strong>Goods Tracking</strong></h3>

                <div class="form-outline mb-3">
                    <label class="form-label" for="">Username</label>

                    <input type="email" id="email" name="email" required placeholder="abc@abc.com" class="form-control form-control" />
                </div>

                <div class="form-outline mb-3">
                    <label class="form-label" for="">Password</label>

                    <input type="password" id="password" name="password" required class="form-control form-control" />
                </div>

                <div class="mb-4">
                    <button class="btn btn-success btn-block" type="submit">Login</button>
                </div>

                {{--  <a class="small text-muted" href="#!">Forgot password?</a>
                <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                    style="color: #393f81;">Register here</a></p>  --}}
                {{--  <a href="#!" class="small text-muted">Terms of use.</a>
                <a href="#!" class="small text-muted">Privacy policy</a>  --}}
                </form>

            </div>
            </div>
            <div class="col-md-6 col-lg-6 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                <form method="POST" action="{{ route('userlogin.store') }}" novalidate="novalidate" id="kt_sign_in_form">
                        @csrf
                    <input type="hidden" value="Vault" name="type">
                    <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;"><strong>Vault Check</strong></h3>

                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example17">Username</label>

                        <input type="email" id="email" name="email" required placeholder="abc@abc.com" class="form-control form-control" />
                    </div>

                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example27">Password</label>
                        <input type="password" id="password" name="password" required class="form-control form-control" />
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-block" type="submit">Login</button>
                    </div>

                    {{--  <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                        style="color: #393f81;">Register here</a></p>  --}}
                    {{--  <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>  --}}
                    </form>

                </div>
            </div>
        </div>

    </div>
    <p class="text-white text-center">By signing in, I acknowledge that I have read and understand the Terms & Conditions.</p>
</div>

@endsection
