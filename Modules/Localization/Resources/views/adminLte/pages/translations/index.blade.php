@extends('localization::adminLte.layouts.master')

@section('pageTitle')
    @lang('localization::view.translations')
@endsection


@section('styles')
    <link href="{{ asset('assets/modules/css/localization.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/modules/js/localization.js') }}"></script>
@endsection



@section('content')

<!--begin:: Form Card-->
<div class="card mb-5 mb-xl-10" id="translations_card">
    <!--begin::Card header-->
    {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
    <div class="card-header border-0">
        <div class="card-title">
            <h3 class="fw-bolder mt-4">@lang('localization::view.edit_translations')</h3>
        </div>
    </div>

    <div class="card-header align-items-center py-3 py-md-2">
        <!--begin::Card title-->
        <div class="card-title flex-column my-5">
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6">
                @foreach($languages as $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $lang->id == $current_language->id ? 'active' : ''}}" href="{{ fr_route('translations.edit', ['id' => $lang->id]) }}"> {{ $lang->name }} </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--end::Card title-->


        <!--begin::Card search-->
        <div class="card-search my-5">
            <div class="search-translations-wrapper w-500px">
                <!--begin::Input-->
                <input
                    type="search"
                    id="translations_search"
                    class="form-control form-control-lg"
                    id="search_on_phrases"
                    placeholder="@lang('view.search_by_phrase')"
                    aria-describedby="basic-addon3"/>
                <!--end::Input-->
            </div>
        </div>
        <!--end::Card search-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div>
        <!--begin::Form-->
        <form class="form" action="{{ fr_route('translations.update', ['lang_code' => $lang_code]) }}" method="post">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                @include('localization::adminLte.pages.translations.form')
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer shadow-sm d-flex justify-content-end py-6 px-9">
                <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                <button type="submit" class="btn btn-success">@lang('view.update')</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end:: Form Card-->

@endsection