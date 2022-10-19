@extends('cargo::adminLte.layouts.master')

@section('pageTitle','Goods Tracking Progress')

@section('content')

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">

        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">View/Edit Goods Tracking Progress # {{$data['shipment']->code}}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_form_1" class="form" action="{{ fr_route('shipment_status_store') }}" method="post" enctype="multipart/form-data" novalidate>
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    @include('cargo::adminLte.pages.shipments.shipment_status_form')
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

@endsection

{{-- Inject Scripts --}}
@push('js-component')
<script>

</script>
@endpush
