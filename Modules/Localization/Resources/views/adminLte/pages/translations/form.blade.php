@csrf


<!--begin::Input group -- content -->
<div class="row mb-6">
    @foreach ($translations as $translation)
        
    <!--begin::Input group-->
    <div class="col-xl-4 col-md-6 fv-row field-translation" data-phrase="{{ strtolower($translation->translate('phrase', $lang_code)) }}">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-7">{{ $translation->name }}</label>
        <!--end::Label-->

        <!-- begin phrase input -->
        <div class="mb-4">
            <textarea
                name="phrases[{{ $translation->key }}]"
                class="form-control"
            >{{ $translation->translate('phrase', $lang_code) }}</textarea>
        </div>
        <!-- end phrase input -->
    </div>
    <!--end::Input group-->

    @endforeach
</div>
<!--end::Input group-->




