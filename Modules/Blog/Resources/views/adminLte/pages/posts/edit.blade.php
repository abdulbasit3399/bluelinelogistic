@extends('blog::adminLte.layouts.master')

@section('pageTitle')
    {{ __('view.edit') }} - {{ $model->title }}
@endsection


@section('content')

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('view.edit') }}</h3>
            </div>
            <!--end::Card title-->

        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form class="form" action="{{ fr_route('posts.update', ['id' => $model->id]) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    @include('blog::adminLte.pages.posts.form', ['typeForm' => 'edit'])
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary mx-1">@lang('view.discard')</a>
                    <input type="submit" class="btn btn-success mx-1" value="@lang('view.update')">
                    @if (!$model->published)
                        <input type="submit" name="publish" class="btn btn-dark mx-1" value="@lang('view.publish')">
                    @endif
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

@endsection
