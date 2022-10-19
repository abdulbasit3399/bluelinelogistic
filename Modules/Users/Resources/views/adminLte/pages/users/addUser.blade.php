@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('users::view.create_new_user') }}
@endsection

@section('content')
<div class="container">
    <div class="card mt-4">

        <div class="card-header">
            <div class="row">
                <h3 class="bl pt-3">{{ __('Add User') }}</h3>
                <p class="bl">You can Add user from here</p>
            </div>
        </div>
        <div class="card-body">
        <form action="{{ fr_route('users.store') }}" method="post" enctype="multipart/form-data">
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
                <input type="password" class="form-control" id="">
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
    {{--  <!-- <div id="box1" class="box show">
        <div class="item">
            <div class="itemhead">
                <img src="https://polymer-tut.appspot.com/images/avatar-01.svg" width="70" height"70" />
                <h2>Eric</h2>
                <div class="heart">
                    <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                </div>
            </div>
          <p>Have you heard about the Web Components revolution?</p><p>Click to tabs!</p>
        </div>
      <div class="item">
            <div class="itemhead">
                <img src="https://polymer-tut.appspot.com/images/avatar-05.svg" width="70" height"70" />
                <h2>Norberrt</h2>
                <div class="heart">
                    <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                </div>
            </div>
        <p>Decentralize! No canvas, no polymer.</p><p><strong>Needs only CSS and pure javascript!</strong></p>
        </div>
    </div>
    <div id="box2" class="box">
        <div class="item">
            <div class="itemhead">
                <img src="https://polymer-tut.appspot.com/images/avatar-02.svg" width="70" height"70" />
                <h2>Rob</h2>
                <div class="heart">
                    <svg viewBox="0 0 24 24" style="pointer-events: none; width: 24px; height: 24px; display: block;"><g id="favorite"><path d="M12,21.4L10.6,20C5.4,15.4,2,12.3,2,8.5C2,5.4,4.4,3,7.5,3c1.7,0,3.4,0.8,4.5,2.1C13.1,3.8,14.8,3,16.5,3C19.6,3,22,5.4,22,8.5c0,3.8-3.4,6.9-8.6,11.5L12,21.4z"></path></g></svg>
                </div>
            </div>
          <p>Loving this Polymer thing. This tab app from Polymer projects.</p>
          <p><a href="http://www.polymer-project.org/samples/tutorial/finished/index.html" target="_blank">YOU CAN SEE IT ON THIS LINK</a></p>
        </div>
    </div> -->  --}}
</div>
@endsection
