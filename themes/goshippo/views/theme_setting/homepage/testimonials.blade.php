@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="testimonials">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input
                    class="custom-control-input form-check-input"
                    name="display"
                    type="checkbox"
                    value="1"
                    id="display_info_{{isset($id) ? $id : 'id'}}"
                    {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}
                >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_info_{{isset($id) ? $id : 'id'}}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->

    <!--begin::row header_bg -->
    <div class="row mb-6 header_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_bg') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} header_bg_input"
                    name="header_bg"
                    value="{{ isset($data['header_bg']) ? $data['header_bg'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row header_bg -->

    <!--begin::row card_bg -->
    <div class="row mb-6 card_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_bg') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_input"
                    name="card_bg"
                    value="{{ isset($data['card_bg']) ? $data['card_bg'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_bg -->

    <!--begin::row title_color -->
    <div class="row mb-6 title_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_title_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} title_color_input"
                    name="title_color"
                    value="{{ isset($data['title_color']) ? $data['title_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row title_color -->

    <!--begin::row text_color -->
    <div class="row mb-6 text_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_text_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} text_color_input"
                    name="text_color"
                    value="{{ isset($data['text_color']) ? $data['text_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row text_color -->

    <!--begin::row button_text_color -->
    <div class="row mb-6 button_text_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_button_text_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} button_text_color_input"
                    name="button_text_color"
                    value="{{ isset($data['button_text_color']) ? $data['button_text_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row button_text_color -->


    <!-- 1 -->
    <div>
        <!--begin::row section title -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_1_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_1_title']) && isset($data['section_1_title'][app()->getLocale()]) ? $data['section_1_title'][app()->getLocale()] : 'This is the heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_1_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_1_title']) && isset($data['section_1_title'][$locale['code']]) ? $data['section_1_title'][$locale['code']] : 'This is the heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section title -->

        <!--begin::row section_sub_title -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_subtitle') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_sub_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_1_sub_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_1_sub_title']) && isset($data['section_1_sub_title'][app()->getLocale()]) ? $data['section_1_sub_title'][app()->getLocale()] : 'This is sub heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_1_sub_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_1_sub_title']) && isset($data['section_1_sub_title'][$locale['code']]) ? $data['section_1_sub_title'][$locale['code']] : 'This is sub heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section_sub_title -->

        <!--begin::row section description -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach(get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="section_1_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['section_1_description']) && isset($data['section_1_description'][app()->getLocale()]) ? $data['section_1_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach(get_langauges_except_current() as $locale)
                            <textarea name="section_1_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['section_1_description']) && isset($data['section_1_description'][$locale['code']]) ? $data['section_1_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section description -->

        <!--begin::row section button -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_button">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_1_button[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_1_button']) && isset($data['section_1_button'][app()->getLocale()]) ? $data['section_1_button'][app()->getLocale()] : 'Button' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_1_button[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_1_button']) && isset($data['section_1_button'][$locale['code']]) ? $data['section_1_button'][$locale['code']] : 'Button' }}"
                            >
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::row section URL Field -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
            <div class="col-md-8">

                    <div class="input-group url_input_container" id="url_input_container_section_url">
                        <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_1_url[type]" data-title="type">
                            <option value="custom"  {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type'])) ? ($data['section_1_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                            @if (check_module('pages'))
                                <option value="page" {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                            @endif
                            @if (check_module('blog'))
                                <option value="category" {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                <option value="post" {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                            @endif
                        </select>
                        <input
                            type="text"
                            name="section_1_url[custom]"
                            data-title="custom"
                            data-type="array"
                            class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type'])) ? ($data['section_1_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                            value="{{ isset($data['section_1_url']) && isset($data['section_1_url']['custom']) ? $data['section_1_url']['custom'] : '' }}"
                        >
                        @if (check_module('pages'))
                            <div class="form-control-choose-type form-control-page {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'page') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto"
                                    name="section_1_url[page]"
                                    data-title="page"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_1_url']) && isset($data['section_1_url']['page']) && $data['section_1_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (check_module('blog'))
                            <div class="form-control-choose-type form-control-category {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'category') ? '' : 'd-none' }}">
                                <select
                                    class="form-select  mw-auto "
                                    name="section_1_url[category]"
                                    data-title="category"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_1_url']) && isset($data['section_1_url']['page']) && $data['section_1_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-control-choose-type form-control-post {{ (isset($data['section_1_url']) && isset($data['section_1_url']['type']) && $data['section_1_url']['type'] == 'post') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto "
                                    name="section_1_url[post]"
                                    data-title="post"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_1_url']) && isset($data['section_1_url']['page']) && $data['section_1_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::Input logo 1 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_logo') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_1_logo" data-type="image" max-items="1" name="section_1_logo" :model="$model" collection="section_1_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_1_logo" data-type="image" name="section_1_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input logo -->

        <!--begin::Input avatar 1 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_avatar') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_1_avatar" data-type="image" max-items="1" name="section_1_avatar" :model="$model" collection="section_1_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_1_avatar" data-type="image" name="section_1_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input avatar -->
    </div>

    <!-- 2 -->
    <div>
        <!--begin::row section title  2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_2_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_2_title']) && isset($data['section_2_title'][app()->getLocale()]) ? $data['section_2_title'][app()->getLocale()] : 'This is the heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_2_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_2_title']) && isset($data['section_2_title'][$locale['code']]) ? $data['section_2_title'][$locale['code']] : 'This is the heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section title -->

        <!--begin::row section_sub_title  2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_subtitle') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_sub_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_2_sub_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_2_sub_title']) && isset($data['section_2_sub_title'][app()->getLocale()]) ? $data['section_2_sub_title'][app()->getLocale()] : 'This is sub heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_2_sub_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_2_sub_title']) && isset($data['section_2_sub_title'][$locale['code']]) ? $data['section_2_sub_title'][$locale['code']] : 'This is sub heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section_sub_title -->

        <!--begin::row section description 2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach(get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="section_2_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['section_2_description']) && isset($data['section_2_description'][app()->getLocale()]) ? $data['section_2_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach(get_langauges_except_current() as $locale)
                            <textarea name="section_2_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['section_2_description']) && isset($data['section_2_description'][$locale['code']]) ? $data['section_2_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section description -->

        <!--begin::row section button 2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_button">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_2_button[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_2_button']) && isset($data['section_2_button'][app()->getLocale()]) ? $data['section_2_button'][app()->getLocale()] : 'Button' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_2_button[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_2_button']) && isset($data['section_2_button'][$locale['code']]) ? $data['section_2_button'][$locale['code']] : 'Button' }}"
                            >
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::row section URL Field  2-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
            <div class="col-md-8">

                    <div class="input-group url_input_container" id="url_input_container_section_url">
                        <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_2_url[type]" data-title="type">
                            <option value="custom"  {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type'])) ? ($data['section_2_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                            @if (check_module('pages'))
                                <option value="page" {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                            @endif
                            @if (check_module('blog'))
                                <option value="category" {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                <option value="post" {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                            @endif
                        </select>
                        <input
                            type="text"
                            name="section_2_url[custom]"
                            data-title="custom"
                            data-type="array"
                            class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type'])) ? ($data['section_2_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                            value="{{ isset($data['section_2_url']) && isset($data['section_2_url']['custom']) ? $data['section_2_url']['custom'] : '' }}"
                        >
                        @if (check_module('pages'))
                            <div class="form-control-choose-type form-control-page {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'page') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto"
                                    name="section_2_url[page]"
                                    data-title="page"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_2_url']) && isset($data['section_2_url']['page']) && $data['section_2_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (check_module('blog'))
                            <div class="form-control-choose-type form-control-category {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'category') ? '' : 'd-none' }}">
                                <select
                                    class="form-select  mw-auto "
                                    name="section_2_url[category]"
                                    data-title="category"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_2_url']) && isset($data['section_2_url']['page']) && $data['section_2_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-control-choose-type form-control-post {{ (isset($data['section_2_url']) && isset($data['section_2_url']['type']) && $data['section_2_url']['type'] == 'post') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto "
                                    name="section_2_url[post]"
                                    data-title="post"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_2_url']) && isset($data['section_2_url']['page']) && $data['section_2_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <!--end::row section button 2 -->


        <!--begin::Input logo 2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_logo') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_2_logo" data-type="image" max-items="1" name="section_2_logo" :model="$model" collection="section_2_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_2_logo" data-type="image" name="section_2_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input logo -->


        <!--begin::Input avatar 2 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_avatar') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_2_avatar" data-type="image" max-items="1" name="section_2_avatar" :model="$model" collection="section_2_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_2_avatar" data-type="image" name="section_2_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input avatar -->

    </div>

    <!-- 3-->
    <div>
        <!--begin::row section title  3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_3_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_3_title']) && isset($data['section_3_title'][app()->getLocale()]) ? $data['section_3_title'][app()->getLocale()] : 'This is the heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_3_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_3_title']) && isset($data['section_3_title'][$locale['code']]) ? $data['section_3_title'][$locale['code']] : 'This is the heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section title -->

        <!--begin::row section_sub_title  3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_subtitle') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_sub_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_3_sub_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_3_sub_title']) && isset($data['section_3_sub_title'][app()->getLocale()]) ? $data['section_3_sub_title'][app()->getLocale()] : 'This is sub heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_3_sub_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_3_sub_title']) && isset($data['section_3_sub_title'][$locale['code']]) ? $data['section_3_sub_title'][$locale['code']] : 'This is sub heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section_sub_title -->

        <!--begin::row section description 3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach(get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="section_3_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['section_3_description']) && isset($data['section_3_description'][app()->getLocale()]) ? $data['section_3_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach(get_langauges_except_current() as $locale)
                            <textarea name="section_3_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['section_3_description']) && isset($data['section_3_description'][$locale['code']]) ? $data['section_3_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section description -->

        <!--begin::row section button 3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_button">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_3_button[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_3_button']) && isset($data['section_3_button'][app()->getLocale()]) ? $data['section_3_button'][app()->getLocale()] : 'Button' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_3_button[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_3_button']) && isset($data['section_3_button'][$locale['code']]) ? $data['section_3_button'][$locale['code']] : 'Button' }}"
                            >
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::row section URL Field  3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
            <div class="col-md-8">

                    <div class="input-group url_input_container" id="url_input_container_section_url">
                        <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_3_url[type]" data-title="type">
                            <option value="custom"  {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type'])) ? ($data['section_3_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                            @if (check_module('pages'))
                                <option value="page" {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                            @endif
                            @if (check_module('blog'))
                                <option value="category" {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                <option value="post" {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                            @endif
                        </select>
                        <input
                            type="text"
                            name="section_3_url[custom]"
                            data-title="custom"
                            data-type="array"
                            class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type'])) ? ($data['section_3_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                            value="{{ isset($data['section_3_url']) && isset($data['section_3_url']['custom']) ? $data['section_3_url']['custom'] : '' }}"
                        >
                        @if (check_module('pages'))
                            <div class="form-control-choose-type form-control-page {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'page') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto"
                                    name="section_3_url[page]"
                                    data-title="page"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_3_url']) && isset($data['section_3_url']['page']) && $data['section_3_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (check_module('blog'))
                            <div class="form-control-choose-type form-control-category {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'category') ? '' : 'd-none' }}">
                                <select
                                    class="form-select  mw-auto "
                                    name="section_3_url[category]"
                                    data-title="category"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_3_url']) && isset($data['section_3_url']['page']) && $data['section_3_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-control-choose-type form-control-post {{ (isset($data['section_3_url']) && isset($data['section_3_url']['type']) && $data['section_3_url']['type'] == 'post') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto "
                                    name="section_3_url[post]"
                                    data-title="post"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_3_url']) && isset($data['section_3_url']['page']) && $data['section_3_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <!--end::row section button 3 -->


        <!--begin::Input logo 3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_logo') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_3_logo" data-type="image" max-items="1" name="section_3_logo" :model="$model" collection="section_3_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_3_logo" data-type="image" name="section_3_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input logo -->


        <!--begin::Input avatar 3 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_avatar') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_3_avatar" data-type="image" max-items="1" name="section_3_avatar" :model="$model" collection="section_3_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_3_avatar" data-type="image" name="section_3_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input avatar -->
    </div>

    <!-- 4 -->
    <div>
        <!--begin::row section title  4-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_4_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_4_title']) && isset($data['section_4_title'][app()->getLocale()]) ? $data['section_4_title'][app()->getLocale()] : 'This is the heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_4_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_4_title']) && isset($data['section_4_title'][$locale['code']]) ? $data['section_4_title'][$locale['code']] : 'This is the heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section title -->

        <!--begin::row section_sub_title  4-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_subtitle') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_sub_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_4_sub_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_4_sub_title']) && isset($data['section_4_sub_title'][app()->getLocale()]) ? $data['section_4_sub_title'][app()->getLocale()] : 'This is sub heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_4_sub_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_4_sub_title']) && isset($data['section_4_sub_title'][$locale['code']]) ? $data['section_4_sub_title'][$locale['code']] : 'This is sub heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section_sub_title -->

        <!--begin::row section description 4-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach(get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="section_4_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['section_4_description']) && isset($data['section_4_description'][app()->getLocale()]) ? $data['section_4_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach(get_langauges_except_current() as $locale)
                            <textarea name="section_4_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['section_4_description']) && isset($data['section_4_description'][$locale['code']]) ? $data['section_4_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section description -->

        <!--begin::row section button 4-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_button">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_4_button[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_4_button']) && isset($data['section_4_button'][app()->getLocale()]) ? $data['section_4_button'][app()->getLocale()] : 'Button' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_4_button[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_4_button']) && isset($data['section_4_button'][$locale['code']]) ? $data['section_4_button'][$locale['code']] : 'Button' }}"
                            >
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::row section URL Field  4-->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
            <div class="col-md-8">

                    <div class="input-group url_input_container" id="url_input_container_section_url">
                        <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_4_url[type]" data-title="type">
                            <option value="custom"  {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type'])) ? ($data['section_4_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                            @if (check_module('pages'))
                                <option value="page" {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                            @endif
                            @if (check_module('blog'))
                                <option value="category" {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                <option value="post" {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                            @endif
                        </select>
                        <input
                            type="text"
                            name="section_4_url[custom]"
                            data-title="custom"
                            data-type="array"
                            class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type'])) ? ($data['section_4_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                            value="{{ isset($data['section_4_url']) && isset($data['section_4_url']['custom']) ? $data['section_4_url']['custom'] : '' }}"
                        >
                        @if (check_module('pages'))
                            <div class="form-control-choose-type form-control-page {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'page') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto"
                                    name="section_4_url[page]"
                                    data-title="page"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_4_url']) && isset($data['section_4_url']['page']) && $data['section_4_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (check_module('blog'))
                            <div class="form-control-choose-type form-control-category {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'category') ? '' : 'd-none' }}">
                                <select
                                    class="form-select  mw-auto "
                                    name="section_4_url[category]"
                                    data-title="category"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_4_url']) && isset($data['section_4_url']['page']) && $data['section_4_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-control-choose-type form-control-post {{ (isset($data['section_4_url']) && isset($data['section_4_url']['type']) && $data['section_4_url']['type'] == 'post') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto "
                                    name="section_4_url[post]"
                                    data-title="post"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_4_url']) && isset($data['section_4_url']['page']) && $data['section_4_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <!--end::row section button 4-->

        <!--begin::Input logo 4 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_logo') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_4_logo" data-type="image" max-items="1" name="section_4_logo" :model="$model" collection="section_4_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_4_logo" data-type="image" name="section_4_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input logo -->

        <!--begin::Input avatar 4 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_avatar') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_4_avatar" data-type="image" max-items="1" name="section_4_avatar" :model="$model" collection="section_4_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_4_avatar" data-type="image" name="section_4_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input avatar -->
    </div>

    <!-- 5 -->
    <div>
        <!--begin::row section title  5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_5_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_5_title']) && isset($data['section_5_title'][app()->getLocale()]) ? $data['section_5_title'][app()->getLocale()] : 'This is the heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_5_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_5_title']) && isset($data['section_5_title'][$locale['code']]) ? $data['section_5_title'][$locale['code']] : 'This is the heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section title -->

        <!--begin::row section_sub_title  5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_subtitle') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_sub_title">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_5_sub_title[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_5_sub_title']) && isset($data['section_5_sub_title'][app()->getLocale()]) ? $data['section_5_sub_title'][app()->getLocale()] : 'This is sub heading' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_5_sub_title[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_5_sub_title']) && isset($data['section_5_sub_title'][$locale['code']]) ? $data['section_5_sub_title'][$locale['code']] : 'This is sub heading' }}"
                            >
                        @endforeach
                    </div>


            </div>
        </div>
        <!--end::row section_sub_title -->

        <!--begin::row section description 5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach(get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="section_5_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['section_5_description']) && isset($data['section_5_description'][app()->getLocale()]) ? $data['section_5_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach(get_langauges_except_current() as $locale)
                            <textarea name="section_5_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['section_5_description']) && isset($data['section_5_description'][$locale['code']]) ? $data['section_5_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section description -->

        <!--begin::row section button 5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
            <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_button">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
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
                            name="section_5_button[{{app()->getLocale()}}]"
                            title="{{app()->getLocale()}}"
                            class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                            value="{{ isset($data['section_5_button']) && isset($data['section_5_button'][app()->getLocale()]) ? $data['section_5_button'][app()->getLocale()] : 'Button' }}"
                        >
                        @foreach(get_langauges_except_current() as $locale)
                            <input
                                type="text"
                                name="section_5_button[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                value="{{ isset($data['section_5_button']) && isset($data['section_5_button'][$locale['code']]) ? $data['section_5_button'][$locale['code']] : 'Button' }}"
                            >
                        @endforeach
                    </div>
            </div>
        </div>
        <!--end::row section button -->

        <!--begin::row section URL Field  5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
            <div class="col-md-8">

                    <div class="input-group url_input_container" id="url_input_container_section_url">
                        <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_5_url[type]" data-title="type">
                            <option value="custom"  {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type'])) ? ($data['section_5_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                            @if (check_module('pages'))
                                <option value="page" {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                            @endif
                            @if (check_module('blog'))
                                <option value="category" {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                <option value="post" {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                            @endif
                        </select>
                        <input
                            type="text"
                            name="section_5_url[custom]"
                            data-title="custom"
                            data-type="array"
                            class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type'])) ? ($data['section_5_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                            value="{{ isset($data['section_5_url']) && isset($data['section_5_url']['custom']) ? $data['section_5_url']['custom'] : '' }}"
                        >
                        @if (check_module('pages'))
                            <div class="form-control-choose-type form-control-page {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'page') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto"
                                    name="section_5_url[page]"
                                    data-title="page"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_5_url']) && isset($data['section_5_url']['page']) && $data['section_5_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (check_module('blog'))
                            <div class="form-control-choose-type form-control-category {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'category') ? '' : 'd-none' }}">
                                <select
                                    class="form-select  mw-auto "
                                    name="section_5_url[category]"
                                    data-title="category"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_5_url']) && isset($data['section_5_url']['page']) && $data['section_5_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-control-choose-type form-control-post {{ (isset($data['section_5_url']) && isset($data['section_5_url']['type']) && $data['section_5_url']['type'] == 'post') ? '' : 'd-none' }}">
                                <select
                                    class="form-select mw-auto "
                                    name="section_5_url[post]"
                                    data-title="post"
                                    data-type="array"
                                    data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                >
                                    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                        @foreach ($data['categories'] as $categoryId)
                                            @php
                                                $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                            @endphp
                                            <option value="{{$category->id}}" {{ isset($data['section_5_url']) && isset($data['section_5_url']['page']) && $data['section_5_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        <!--end::row section button 5 -->

        <!--begin::Input logo 5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_logo') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_5_logo" data-type="image" max-items="1" name="section_5_logo" :model="$model" collection="section_5_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_5_logo" data-type="image" name="section_5_logo" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input logo -->


        <!--begin::Input avatar 5 -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_avatar') </label>
            <div class="col-md-8">

                @if(isset($model))
                    <x-media-library-collection data-title="section_5_avatar" data-type="image" max-items="1" name="section_5_avatar" :model="$model" collection="section_5_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @else
                    <x-media-library-attachment data-title="section_5_avatar" data-type="image" name="section_5_avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                @endif


            </div>
        </div>
        <!--end::Input avatar -->
    </div>


</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
<livewire:styles />
    <livewire:scripts />
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>

    /*!*******************************************************!*\
      !*** Select fields ***!
      \*******************************************************/
      $("select.form-select").select2();
    $(".change_language").select2({
        templateResult: formatFlag,
        templateSelection: formatState,
        minimumResultsForSearch: -1,
        width: '100%'
    });
    /*!*******************************************************!*\
      !*** Color picker fields ***!
      \*******************************************************/
      $(".color_picker_input_{{isset($id) ? $id : 'id'}}").spectrum({
      type: "component",
      showInput: true,
       showInitial: true,
      clickoutFiresChange: true,
      allowEmpty: true,
      maxSelectionSize: 8,
    });

    function formatFlag (lang) {
        if (!lang.id) { return lang.text; }
        var $img    = $(lang.element).attr("data-flag");
        if($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
            );
        }else{
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    }
    function formatState (lang) {
        if (!lang.id) {
        return lang.text;
        }
        var $img    = $(lang.element).attr("data-flag");
        if($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
            );
        }else{
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    };
    // select category_select
    var selectCategories = $('.select_categories');
    selectCategories.select2({
        closeOnSelect: false,
        ajax: {
            url: "{{ fr_route('categories.search') }}",
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return { search: params.term };
            },
            processResults: function (data) {
                if (data && data.categories) {
                    return {
                        results: data.categories.map(function(category) {
                            return {id: category.id, text: category.name}
                        })
                    };
                }
            },
            cache: true,
        },
    });

    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))
        $('.select_categories_{{$id}}').val([{{ implode(", ", $data['categories']) }}]).trigger('change');
    @endif
    // end select category_select
    /*******************************************************************************************/

    // select tags
    var selectTags = $('.select_tags');
    selectTags.select2({
        closeOnSelect: false,
        ajax: {
            url: "{{ fr_route('tags.search') }}",
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return { search: params.term };
            },
            processResults: function (data) {
                if (data && data.tags) {
                    return {
                        results: data.tags.map(function(tag) {
                            return {id: tag.id, text: tag.name}
                        })
                    };
                }
            },
            cache: true,
        },
    });

    @if (isset($id) && isset($data['tags']) && is_array($data['tags']))
        $('.select_tags_{{$id}}').val([{{ implode(", ", $data['tags']) }}]).trigger('change');
    @endif
    // end select tags
    /*******************************************************************************************/

</script>
