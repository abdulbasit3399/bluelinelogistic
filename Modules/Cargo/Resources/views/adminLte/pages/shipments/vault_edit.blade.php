{{--  @extends('cargo::adminLte.layouts.master')  --}}
@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('Edit Vault') }}
@endsection


@section('content')
<div class="container mt-4">
    @if(\Session::has('error'))
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{\Session::get('error')}}</strong>
    <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
        {{--  <span class="text-end">&times;</span>  --}}
    </button>
    </div>
    </div>
    @endif
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}

        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ route('admin.shipments.vault-update') }}" method="post" enctype="multipart/form-data">

                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="row mb-3">
                        <h3 class="bl">Edit Vaults Tracking #{{ $model->id }}</h3>
                        <p class="bl">You can edit Vaults info from here</p>
                    </div>
                    @include('cargo::adminLte.pages.shipments.vault_form', ['typeForm' => 'edit'])
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-start py-6 px-9">
                    <button type="submit" class="btn btn-primary" onclick="get_estimation_cost()" id="kt_account_profile_details_submit">@lang(' Edit ')</button>

                    {{--  <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>  --}}
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
</div>
@endsection
@section('scripts')
<script>
    function random(){
        let r = (Math.random() + 1).toString(36).substring(4);
        document.getElementById('track').value = r.toUpperCase();
    }
</script>
@endsection
