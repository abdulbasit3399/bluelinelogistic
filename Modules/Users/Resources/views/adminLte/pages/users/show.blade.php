{{--  @extends('users::adminLte.layouts.master')  --}}

@extends('cargo::adminLte.template.layout.layout')
@section('pageTitle')
    {{ __('view.profile') }} - {{$model->name}}
@endsection

@section('content')
<div class="container mt-4">

    @include('users::adminLte.pages.users.overview-profile', ['model' => $model])

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('view.profile_details') }}</h3>
            </div>
            <!--end::Card title-->

            @can('edit-users')
                <a href="{{ fr_route('users.edit', ['id' => $model->id]) }}" class="btn btn-primary align-self-center">{{ __('view.edit_profile') }}</a>
            @endcan

        </div>
        <!--begin::Card header-->
        <div class="card-body p-9">

                <!--begin::Row  Full name -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('users::view.table.full_name') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  Email -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('users::view.table.email') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->email }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                @if($model->role == 0)
                    @if (app('hook')->get('overview_user_profile'))
                        @foreach(app('hook')->get('overview_user_profile') as $componentView)
                            {!! $componentView !!}
                        @endforeach
                    @endif
                @endif


        </div>
        <!--begin::Card header-->
    </div>
    <!--end::Basic info-->
</div>
@endsection
