@csrf

<!--begin::Input group -- name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="name"
                class="form-control form-control-sm @error('name') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('cargo::view.table.name') }}"
                value="{{ old('name', isset($model) ? $model->name : '') }}"
            >
            @error('name') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- symbol -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('currency::view.symbol') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="fv-row col-lg-8">
        <div class="mb-4">
            <input
                type="text"
                name="symbol"
                class="form-control form-control-sm @error('symbol') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('currency::view.symbol') }}"
                value="{{ old('symbol', isset($model) ? $model->symbol : '') }}"
            >
            @error('symbol') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- code -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.code') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="code"
                class="form-control form-control-sm @error('code') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('cargo::view.table.code') }}"
                value="{{ old('code', isset($model) ? $model->code : '') }}"
            >
            @error('code') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- exchange_rate -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('currency::view.exchange_rate') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="mb-4">
            <input
                type="number"
                name="exchange_rate"
                step="0.01" min="0"
                class="form-control form-control-sm @error('exchange_rate') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('currency::view.exchange_rate') }}"
                value="{{ old('exchange_rate', isset($model) ? $model->exchange_rate : '') }}"
            >
            @error('exchange_rate') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

