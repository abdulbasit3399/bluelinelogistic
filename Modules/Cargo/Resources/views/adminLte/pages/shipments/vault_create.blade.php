{{--  @extends('cargo::adminLte.layouts.master')  --}}
@extends('cargo::adminLte.template.layout.layout')
@section('pageTitle')
    Add Vault
@endsection

@section('content')
{{--  @if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif  --}}
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
            <form id="kt_form_1" class="form" action="{{ fr_route('admin.shipments.vault-store') }}" method="post" enctype="multipart/form-data" novalidate>
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="row mb-3">
                        <h3 class="bl">Add Vault</h3>
                        <p class="bl">You can add new Vault from here</p>
                    </div>
                    @include('cargo::adminLte.pages.shipments.vault_form', ['typeForm' => 'create'])
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-start py-6 px-9">
                    {{--  <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>  --}}
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">@lang(' Add ')</button>
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

{{-- Inject Scripts --}}
@section('scripts')
<script>
    function random(){
        let r = (Math.random() + 1).toString(36).substring(4);
        document.getElementById('track').value = r.toUpperCase();
    }
</script>
@endsection
