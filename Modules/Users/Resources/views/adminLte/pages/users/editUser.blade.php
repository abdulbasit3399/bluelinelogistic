@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('Edit User') }}
@endsection

@section('content')
<div class="container mt-4">
    @if (\Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{\Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mt-4">

        <div class="card-header">

                <div class="row ">
                {{--  <div class="d-flex">  --}}
                <h3 class="bl pt-3">{{ __('Edit User') }} {{ '#'.$model->id }}
                </h3>

                    {{--  <span class="badge bg-danger"><a href="" ></a>CANCEL</span>  --}}
                {{--  </div>  --}}
                <p class="bl">You can edit users from here</p>

                </div>

        </div>
        <div class="card-body">
        <form action="{{ fr_route('users.update', ['id' => $model->id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
            <div class="mb-3 col-4">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <input type="text" name="username" class="form-control form-control @error('username') is-invalid @enderror" placeholder="{{ __('username') }}" value="{{ old('username', isset($model) ? $model->username : '') }}" />
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 col-4">
              <label for="" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control form-control @error('password') is-invalid @enderror" placeholder="{{ __('users::view.table.password') }}" value="{{ old('password') }}"  />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>

            <div class="mb-3 col-4">
                <label for="" class="form-label">Retype Password</label>
                <input type="password" name="confirm_password" class="form-control" id="">
              </div>
            </div>

            <div class="row">
            <div class="mb-3 col-4">
                <label for="" class="form-label">Full Name</label>
                <div class="input-group">
                    <input type="text" name="name" class="form-control form-control @error('name') is-invalid @enderror" placeholder="{{ __('users::view.table.full_name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-4">
                <label for="" class="form-label">Email address</label>
                <div class="input-group">
                    <input type="text" name="email" class="form-control form-control @error('email') is-invalid @enderror" placeholder="{{ __('users::view.table.email') }}" value="{{ old('email', isset($model) ? $model->email : '') }}" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="form-label">Type</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="type">
                        <option value="Good">Good</option>
                        <option value="Vault">Vault</option>
                    </select>
                  </div>
                {{--  <label for="" class="form-label">Type</label>
                <select class="form-select " aria-label="Default select example">
                    <option value="Good">Good</option>
                    <option value="Vault">Vault</option>
                  </select>  --}}
            </div>
            </div>
            <!-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-success" style="background-color: rgb(7, 199, 109);">Save</button>
          </form>
        </div>
    </div>

</div>
@endsection
