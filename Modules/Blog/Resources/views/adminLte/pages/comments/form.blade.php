@csrf


<!--begin::Input group -- content -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label fw-bold fs-6">@lang('blog::view.comments_table.content')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <!-- begin current lang -->
        <div class="mb-4">
            <textarea
                type="text"
                name="content"
                class="form-control min-h-200px @error('content') is-invalid @enderror"
                placeholder="@lang('blog::view.comments_table.content')">{{ old('content', isset($model) ? $model->content : '') }}</textarea>

            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- end current lang -->
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->




