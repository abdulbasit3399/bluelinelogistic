@csrf

@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
@endphp

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<!--begin::row -->
<div class="row mb-6">
    

    <!--begin::col -- title and content -->
    <div class="col-xl-8">
        

        <!--begin:: page content -->
        <div class="mb-6">
            <div class="card border">
                <!--begin::Card title-->
                <div class="card-title mx-4 mt-5">
                    <h4 class="fw-bolder">{{ __('pages::view.pages_table.page_content_section') }}</h4>
                </div>
                <!--end::Card title-->
                <div class="card-body py-4">

                    <!--begin::Input group -- title -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('pages::view.pages_table.title') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-9">
                            <div class="mb-4">

                                <div class="input-group lang_container">
                                    <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                                        <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                                            {{ get_current_lang()['name'] }}
                                        </option>
                                        @foreach(get_langauges_except_current() as $locale)
                                            <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                                {{ $locale['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input
                                        type="text"
                                        name="title[{{ get_current_lang()['code']}}]"
                                        placeholder="{{ __('pages::view.pages_table.title') }}"
                                        value="{{ old('title.' . get_current_lang()['code'] , isset($model) ? $model->title : '') }}"
                                        class="form-control  form-control-multilingual form-control-{{app()->getLocale()}}  @error('title.' . app()->getLocale()) is-invalid @enderror"
                                        data-slug-content="pages"
                                        data-model="page_title"
                                        data-model-limit="100"
                                    >
                                    @error('title.' . get_current_lang()['code'])
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @foreach(get_langauges_except_current() as $locale)

                                        <input
                                            type="text"
                                            class="form-control  form-control-multilingual form-control-{{$locale['code']}} @error('title.' . $locale['code']) is-invalid @enderror d-none"
                                            name="title[{{ $locale['code'] }}]"
                                            placeholder="{{ __('pages::view.pages_table.title') }}"
                                            value="{{ old('title.' . $locale['code'], isset($model) ? $model->getTranslation('title', $locale['code']) : '') }}"
                                        >

                                        @error('title.' . $locale['code'])
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group -- slug -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('pages::view.pages_table.slug') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-9">
                            <div class="mb-4">
                                <input
                                    type="text"
                                    name="slug"
                                    class="form-control form-control-sm @error('slug') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                                    placeholder="{{ __('pages::view.pages_table.slug') }}"
                                    value="{{ old('slug', isset($model) ? $model->slug : '') }}"
                                    data-slug-inject="pages"
                                >
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group -- content -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('pages::view.pages_table.content') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-9">

                            <div class="mb-4 lang_container text editor">
                                <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                                    <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                                        {{ get_current_lang()['name'] }}
                                    </option>
                                    @foreach(get_langauges_except_current() as $locale)
                                        <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                            {{ $locale['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="editor_container" id="editor_container_{{ get_current_lang()['code'] }}">
                                    <input class="content_{{ get_current_lang()['code'] }}_value" name="content[{{ get_current_lang()['code'] }}]" type="hidden" value="{{ old('content.'.get_current_lang()['code'], isset($model) ? isset($model->content[get_current_lang()['code']]) ? $model->content[get_current_lang()['code']] : $model->content : '') }}">
                                    <div id="editor_content_{{ get_current_lang()['code'] }}" class="editor_content_quillj @error('content.'.get_current_lang()['code']) is-invalid @enderror">{!! old('content.'.get_current_lang()['code'], isset($model) ? isset($model->content[get_current_lang()['code']]) ? $model->content[get_current_lang()['code']] : $model->content : '') !!}</div>
                                    @error('content.' . get_current_lang()['code'])
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @foreach(get_langauges_except_current() as $locale)
                                    <div class="editor_container d-none" id="editor_container_{{ $locale['code'] }}">
                                        <input class="content_{{$locale['code']}}_value" name="content[{{ $locale['code'] }}]" type="hidden" value="{{ old('content.'.$locale['code'], isset($model) ? $model->getTranslation('content', $locale['code'])  : '')}}">
                                        <div id="editor_content_{{ $locale['code'] }}" class="editor_content_quillj @error('content.'.$locale['code']) is-invalid @enderror">{!! old('content.'.$locale['code'], isset($model) ? $model->getTranslation('content', $locale['code']) : '') !!}</div>
                                        @error('content.' . $locale['code'])
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->
                </div>

            </div>
        </div>
        <!--end:: page content -->

        <!--begin:: seo section -->
        <div class="mb-6">
            <div class="card border">
                <!--begin::Card title-->
                <div class="card-title mx-4 mt-5">
                    <h4 class="fw-bolder">{{ __('pages::view.pages_table.seo') }}</h4>
                </div>
                <!--end::Card title-->
                <div class="card-body py-4">

                    <!--begin::Input group -- seo_title -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('pages::view.pages_table.seo_title') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-9">


                            <div class="input-group lang_container">
                                <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                                    <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                                        {{ get_current_lang()['name'] }}
                                    </option>
                                    @foreach(get_langauges_except_current() as $locale)
                                        <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                            {{ $locale['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input
                                    type="text"
                                    name="seo_title[{{ get_current_lang()['code']}}]"
                                    data-slug-content="categories"
                                    placeholder="{{ __('pages::view.pages_table.seo_title') }}"
                                    value="{{ old('seo_title.' . get_current_lang()['code'] , isset($model) ? $model->seo_title : '') }}"
                                    class="form-control  form-control-multilingual form-control-{{app()->getLocale()}}  @error('seo_title.' . app()->getLocale()) is-invalid @enderror"
                                >
                                @error('seo_title.' . get_current_lang()['code'])
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @foreach(get_langauges_except_current() as $locale)

                                    <input
                                        type="text"
                                        class="form-control  form-control-multilingual form-control-{{$locale['code']}} @error('seo_title.' . $locale['code']) is-invalid @enderror d-none"
                                        name="seo_title[{{ $locale['code'] }}]"
                                        placeholder="{{ __('pages::view.pages_table.seo_title') }}"
                                        value="{{ old('seo_title.' . $locale['code'], isset($model) ? $model->getTranslation('seo_title', $locale['code']) : '') }}"
                                    >

                                    @error('seo_title.' . $locale['code'])
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endforeach
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group -- seo_description -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('pages::view.pages_table.seo_description') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-9">


                            <div class="mb-٤ lang_container text">
                                <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                                    <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                                        {{ get_current_lang()['name'] }}
                                    </option>
                                    @foreach(get_langauges_except_current() as $locale)
                                        <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                            {{ $locale['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                <textarea
                                    name="seo_description[{{ get_current_lang()['code'] }}]"
                                    data-model-inject="page_desc_{{ get_current_lang()['code'] }}"
                                    class="form-control  form-control-multilingual form-control-{{get_current_lang()['code']}} @error('seo_description.' . get_current_lang()['code']) is-invalid @enderror"
                                >{{ old('seo_description.' . get_current_lang()['code'], isset($model) ? $model->seo_description : '') }}</textarea>
                                @error('seo_description.' . get_current_lang()['code'])
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @foreach(get_langauges_except_current() as $locale)
                                    <textarea
                                        name="seo_description[{{ $locale['code'] }}]"
                                        data-model-inject="page_desc_{{ $locale['code'] }}"
                                        class="form-control form-control-multilingual form-control-{{$locale['code']}} d-none  @error('seo_description.' . $locale['code']) is-invalid @enderror"
                                    >{{ old('seo_description.' . $locale['code'], isset($model) ? $model->getTranslation('seo_description', $locale['code']) : '') }}</textarea>
                                    @error('seo_description.' . $locale['code'])
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endforeach

                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                </div>
            </div>
        </div>
        <!--end:: seo section -->


    </div>
    <!--end::col -- title and content -->
    

    <!--begin::col -- publish, side right -->
    <div class="col-xl-4">
        

        <!--begin:: Featured image -->
        <div class="card border mb-6">
            <!--begin::Card title-->
            <div class="card-title mx-4 mt-5">
                <h4 class="fw-bolder">{{ __('pages::view.pages_table.image') }}</h4>
            </div>
            <!--end::Card title-->
            <div class="card-body py-4">
                
                <!--begin::Input group -- Select categories -->
                <div class="mb-6">
                    <!--begin::Image input-->
                    @if(isset($model))
                        <x-media-library-collection max-items="1" name="image" :model="$model" collection="featured_image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @else
                        <x-media-library-attachment name="image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @endif
                    <!--end::Image input-->

                    @error('image')
                        <div class="is-invalid"></div>
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!--end::Input group-->

            </div>
        </div>
        <!--end:: Featured image -->

    

        <!--begin:: Publish -->
        <div class="card border mb-6">
            <!--begin::Card title-->
            <div class="card-title mx-4 mt-5">
                <h4 class="fw-bolder">@lang('view.publish')</h4>
            </div>
            <!--end::Card title-->
            <div class="card-body py-4">

                <!--begin::Input group -- publish status -->
                @if ($typeForm == 'edit' && $model->published)
                    <div class="mb-6">
                        <!--begin::Label-->
                        <label class="mb-3 fw-bold fs-6">{{ __('view.status') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="input-content">
                            <div class="custom-control custom-switch form-check form-switch">
                                <input
                                    class="custom-control-input form-check-input"
                                    name="published"
                                    type="checkbox"
                                    id="page_published"
                                    value="1"
                                    {{ old('published', $model->published) == 1 ? 'checked="checked"' : '' }}
                                >
                                <label
                                    class="custom-control-label"
                                    for="page_published"
                                >
                                    {{ __('view.published') }}
                                </label>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                @endif
                <!--end::Input group-->


                
                <!--begin::Input group -- publish status -->
                <div class="mb-6">
                    <!--begin::Label-->
                    <label class="mb-3 fw-bold fs-6">{{ __('pages::view.pages_table.visibility') }}</label>
                    <!--end::Label-->

                    <!--begin::Input group-->
                    <div class="input-content d-flex">
                        <div class="form-check mx-1">
                            <input
                                class=""
                                name="visibility"
                                type="radio"
                                id="page_visibility_public"
                                value="public"
                                {{ isset($model) ? (old('visibility', $model->visibility) == 'public' ? 'checked="checked"' : '') : 'checked="checked"' }}
                            >
                            <label
                                class="form-check-label"
                                for="page_visibility_public"
                            >
                                {{ __('pages::view.pages_table.public') }}
                            </label>
                        </div>
                        <div class="form-check mx-1">
                            <input
                                class=""
                                name="visibility"
                                type="radio"
                                id="page_visibility_auth_user"
                                value="auth_user"
                                {{ isset($model) ? (old('visibility', $model->visibility) == 'auth_user' ? 'checked="checked"' : '') : old('visibility') }}
                            >
                            <label
                                class="form-check-label"
                                for="page_visibility_auth_user"
                            >
                                {{ __('pages::view.pages_table.auth_user') }}
                            </label>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Input group-->



                <!--begin::Input group -- publish immediately -->
                <div class="mb-6">
                    <!--begin::Label-->
                    <label class="mb-3 fw-bold fs-6" for="page_publish_immediately">{{ __('view.publish_immediately') }}</label>
                    <!--end::Label-->

                    <!--begin::Input group-->
                    <div class="input-content">
                        <input
                            class="form-control mw-250px @error('publish_on') is-invalid @enderror"
                            placeholder="{{ __('view.pick_date_range') }}"
                            id="page_publish_immediately"
                            value="{{
                                isset($model) && old('publish_on', $model->publish_on) != null ? (
                                date('Y-m-d', strtotime(old('publish_on', $model->publish_on))) . ' At ' . date('h:i A', strtotime(old('publish_on', $model->publish_on)))
                                ) : (
                                old('publish_on') != null ? (date('Y-m-d', strtotime(old('publish_on'))) . ' At ' . date('h:i A', strtotime(old('publish_on')))
                                ) : '')
                            }}"
                        >
                        @error('publish_on')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input
                            type="hidden"
                            name="publish_on"
                            id="page_publish_immediately_value"
                            value=""
                        >
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Input group-->




                <!--begin::Input group -- activations -->
                @if ($typeForm == 'edit')
                    <div class="mb-6">
                        <!--begin::Label-->
                        <label class="mb-3 fw-bold fs-6">{{ __('view.activation') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="input-content">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    name="active"
                                    type="checkbox"
                                    id="category_activation"
                                    value="1"
                                    {{ old('active', isset($model) ? $model->active : true) == 1 ? 'checked="checked"' : '' }}
                                >
                                <label
                                    class="form-check-label"
                                    for="category_activation"
                                >
                                    {{ __('view.active') }}
                                </label>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                @endif
                <!--end::Input group-->
            </div>
        </div>
        <!--end:: Publish -->



    </div>
    <!--end::col side right -->

</div>
<!--end::row -->




{{-- Inject Scripts --}}
@push('js-component')
    <script>

        // editor
        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
            ['link', 'image'],
            ['blockquote', 'code-block'],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            ['bold', 'italic', 'underline', 'strike', 'clean'],        // toggled buttons
        ];

        var options = {
            debug: 'info',
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: "{{  __('pages::view.pages_table.page_content') }}",
            theme: 'snow', // snow, bubble
        };

        var editorEle = document.getElementById('editor_content_{{ get_current_lang()['code'] }}');
        if (editorEle) {
            var editor = new Quill('#editor_content_{{ get_current_lang()['code'] }}', options),
            qlEditor = $(editorEle).children('.ql-editor');
            editor.on('editor-change', function() {
                var getHTML = qlEditor.html().trim(),
                    getText_{{ get_current_lang()['code'] }} = editor.getText().trim(),
                    seo_desc_{{ get_current_lang()['code'] }} = $('[data-model-inject="page_desc_{{ get_current_lang()['code'] }}"]');
                $('.content_{{ get_current_lang()['code'] }}_value').val(getHTML);
                if (!seo_desc_{{ get_current_lang()['code'] }}.hasClass('edited')) {
                    seo_desc_{{ get_current_lang()['code'] }}.val(getText_{{ get_current_lang()['code'] }}.substr(0, 150));
                }
            })
        }
        @foreach(get_langauges_except_current() as $locale)
            var editorEle = document.getElementById('editor_content_{{ $locale['code'] }}');
            if (editorEle) {
                var editor = new Quill('#editor_content_{{$locale['code'] }}', options),
                qlEditor_{{ $locale['code'] }} = $(editorEle).children('.ql-editor');
                editor.on('editor-change', function() {
                    var getHTML = qlEditor_{{ $locale['code'] }}.html().trim(),
                        getText = editor.getText().trim(),
                        seo_desc_{{ $locale['code'] }} = $('[data-model-inject="page_desc_{{$locale['code'] }}"]');
                    $('.content_{{ $locale['code'] }}_value').val(getHTML);
                    if (!seo_desc_{{ $locale['code'] }}.hasClass('edited')) {
                        seo_desc_{{ $locale['code'] }}.val(getText.substr(0, 150));
                    }
                })
            }
        @endforeach
        // end editor
        /*******************************************************************************************/


        // publish date
        var inputDate = $(`#page_publish_immediately`),
            inputDateValue = $('#page_publish_immediately_value'),
            start;
        // Trigger date picker for created at
        inputDate.daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            autoUpdateInput: false,
            minYear: parseInt(moment().format('YYYY')) - 10,
            maxYear: parseInt(moment().format('YYYY')) + 10,
            timePicker: true,
            startDate: moment().startOf('minute'),
            // timePickerSeconds: false,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "{{ __('view.cancel') }}",
                applyLabel: "{{ __('view.apply') }}",
                "fromLabel": "{{ __('view.from') }}",
                "toLabel": "{{ __('view.to') }}",
                "customRangeLabel": "{{ __('datepicker.custom_range') }}",
                "weekLabel": "{{ __('datepicker.week_label') }}",
                "daysOfWeek": [
                    "{{ __('datepicker.days_of_week.sunday') }}",
                    "{{ __('datepicker.days_of_week.monday') }}",
                    "{{ __('datepicker.days_of_week.tuesday') }}",
                    "{{ __('datepicker.days_of_week.wednesday') }}",
                    "{{ __('datepicker.days_of_week.thursday') }}",
                    "{{ __('datepicker.days_of_week.friday') }}",
                    "{{ __('datepicker.days_of_week.saturday') }}",
                ],
                "monthNames": [
                    "{{ __('datepicker.month_names.january') }}",
                    "{{ __('datepicker.month_names.february') }}",
                    "{{ __('datepicker.month_names.march') }}",
                    "{{ __('datepicker.month_names.april') }}",
                    "{{ __('datepicker.month_names.may') }}",
                    "{{ __('datepicker.month_names.june') }}",
                    "{{ __('datepicker.month_names.july') }}",
                    "{{ __('datepicker.month_names.august') }}",
                    "{{ __('datepicker.month_names.september') }}",
                    "{{ __('datepicker.month_names.october') }}",
                    "{{ __('datepicker.month_names.november') }}",
                    "{{ __('datepicker.month_names.december') }}",
                ],
            }
        }, cb);
        // call back after choose date
        function cb(start) {
            var apiDate = start ? start.format("YYYY-MM-DD H:m") : '';
            var inputShowDate = start ? (start.format("YYYY-MM-DD") + ' At ' + start.format("h:m A")) : '';
            if (start) {
                inputDate.val(inputShowDate);
                inputDateValue.val(apiDate);
            }
        }
        cb(start);
        // end publish date
        /*******************************************************************************************/
    
    </script>
@endpush



