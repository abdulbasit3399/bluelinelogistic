@csrf

@php
    $hasAvatar = isset($model) && $model->img;
    $getAvatar = $hasAvatar ? $model->img : '';
@endphp

<!--begin::Col Avatar -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.avatar') }}</label>
    <!--end::Label-->
    <div class="col-md-12">
        <!--begin::Image input-->
        @if(isset($model))
            <x-media-library-collection max-items="1" name="image" :model="$model" collection="avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @else
            <x-media-library-attachment name="image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @endif
        <!--end::Image input-->

        <!--begin::Hint-->
        <div class="form-text">{{ __('view.hint_image_ext') }}</div>
        <!--end::Hint-->

        @error('avatar')
            <div class="is-invalid"></div>
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
</div>
<!--end::Col-->


<!--begin::Input group --  Full name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.full_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('cargo::view.table.full_name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
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

<!--begin::Input group --  Email -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.email') }}</label>
    <!--end::Label-->
    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('cargo::view.table.email') }}" value="{{ old('email', isset($model) ? $model->email : '') }}" />
            @error('email') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Password -->
<div class="row mb-6">

    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 @if($typeForm == 'create') required @endif">{{ __('cargo::view.table.password') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="password" id="password" name="password" class="form-control form-control-lg has-feedback @error('password') is-invalid @enderror" placeholder="{{ __('cargo::view.table.password') }}" value="{{ old('password', isset($model) ? $model->password : '') }}" />
            <i id="check" class="far fa-eye" id="togglePassword" style="cursor: pointer;position: absolute;right: 0;padding: 3%;font-size: 16px;"></i>
            @error('password') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group --  National Id -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_national_id') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="national_id" class="form-control form-control-lg @error('national_id') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_national_id') }}" value="{{ old('national_id', isset($model) ? $model->national_id : '') }}" />
            @error('national_id') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Address -->
<div class="row mb-6">

    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.address') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" placeholder="{{ __('cargo::view.table.address') }}" value="{{ old('address', isset($model) ? $model->address : '') }}" />
            @error('address') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->


<!--begin::Input group --  Owner all -->
<div class="row mb-6">
    <!--begin::Input group --  Owner Name -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_name') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="responsible_name" class="form-control form-control-lg @error('responsible_name') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_name') }}" value="{{ old('responsible_name', isset($model) ? $model->responsible_name : '') }}" />
            @error('responsible_name') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
    

    <!--begin::Input group --  Owner Phone -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_phone') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="responsible_mobile" class="form-control form-control-lg @error('responsible_mobile') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_phone') }}" value="{{ old('responsible_mobile', isset($model) ? $model->responsible_mobile : '') }}" />
            @error('responsible_mobile') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



{{-- Inject Scripts --}}
@section('scripts')
<script>
    $('#check').click(function(){
        console.log('salman');
        const type = $('#password').attr('type') === 'password' ? 'text' : 'password';
        $('#password').prop('type', type);
    });
</script>
@endsection