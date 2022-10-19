@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="business">


        <!--begin::row toggle display -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.display') </label>
            <div class="col-md-8">
                <div class="custom-control custom-switch form-check form-switch">
                    <input class="custom-control-input form-check-input" name="display" type="checkbox" value="1" id="display_hero_{{isset($id) ? $id : 'id'}}" {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }} >
                    <label class="custom-control-label form-check-label fw-bold fs-6" for="display_hero_{{isset($id) ? $id : 'id'}}"></label>
                </div>
            </div>
        </div>
        <!--end::row toggle display -->

    <!--begin::row count -->
    <div class="control" style="{{ isset($data['display']) && $data['display'] ?: 'display: ;' }}">

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

        <div class="row mb-6 count">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_goshippo::view.card_counts') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count1" value="1" {{ isset($data['services_count']) && $data['services_count'] == 1 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count1">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-1.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count2" value="2" {{ isset($data['services_count']) && $data['services_count'] == 2 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count2">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-2.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count3" value="3" {{ isset($data['services_count']) && $data['services_count'] == 3 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count3">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-3.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count4" value="4" {{ isset($data['services_count']) && $data['services_count'] == 4 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count4">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-4.svg') }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="cont1">

            <div class="">
                <!--begin::row card_1_bg_color -->
                <div class="row mb-6 card_1_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_1_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                                name="card_1_bg_color"
                                value="{{ isset($data['card_1_bg_color']) ? $data['card_1_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_1_bg_color -->

                <!--begin::row card_title_1_color -->
                <div class="row mb-6 card_title_1_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_title_1_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_1_color_input"
                                name="card_title_1_color"
                                value="{{ isset($data['card_title_1_color']) ? $data['card_title_1_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_title_1_color -->

                <!--begin::row card_desc_1_color -->
                <div class="row mb-6 card_desc_1_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_desc_1_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_1_color_input"
                                name="card_desc_1_color"
                                value="{{ isset($data['card_desc_1_color']) ? $data['card_desc_1_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_desc_1_color -->

                <!--begin::row card_1_button_bg_color -->
                <div class="row mb-6 card_1_button_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_1_button_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_1_button_bg_color_input"
                                name="card_1_button_bg_color"
                                value="{{ isset($data['card_1_button_bg_color']) ? $data['card_1_button_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_1_button_bg_color -->

                <!--begin::row card_1_button_text_color -->
                <div class="row mb-6 card_1_button_text_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_1_button_text_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_1_button_text_color_input"
                                name="card_1_button_text_color"
                                value="{{ isset($data['card_1_button_text_color']) ? $data['card_1_button_text_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_1_button_text_color -->
            </div>
            <!--begin::row card_title_1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_1') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_title_1">
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
                                name="card_title_1[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][app()->getLocale()]) ? $data['card_title_1'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_title_1[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][$locale['code']]) ? $data['card_title_1'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row card_title_1 -->

            <!--begin::row card_description_1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_1') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_card_description_1">
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

                            <textarea name="card_description_1[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_1']) && isset($data['card_description_1'][app()->getLocale()]) ? $data['card_description_1'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="card_description_1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_1']) && isset($data['card_description_1'][$locale['code']]) ? $data['card_description_1'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_description_1 -->

            <!--begin::row card_1_section_button -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_1_section_button') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_1_section_button">
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
                                name="card_1_section_button[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_1_section_button']) && isset($data['card_1_section_button'][app()->getLocale()]) ? $data['card_1_section_button'][app()->getLocale()] : 'Button' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_1_section_button[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_1_section_button']) && isset($data['card_1_section_button'][$locale['code']]) ? $data['card_1_section_button'][$locale['code']] : 'Button' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_1_section_button -->

            <!--begin::row card_1_section_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_1_section_url') </label>
                <div class="col-md-8">

                        <div class="input-group url_input_container" id="url_input_container_card_1_section_url">
                            <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="card_1_section_url[type]" data-title="type">
                                <option value="custom"  {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type'])) ? ($data['card_1_section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                                @if (check_module('pages'))
                                    <option value="page" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                                @endif
                                @if (check_module('blog'))
                                    <option value="category" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                    <option value="post" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                                @endif
                            </select>
                            <input
                                type="text"
                                name="card_1_section_url[custom]"
                                data-title="custom"
                                data-type="array"
                                class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type'])) ? ($data['card_1_section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                                value="{{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['custom']) ? $data['card_1_section_url']['custom'] : '' }}"
                            >
                            @if (check_module('pages'))
                                <div class="form-control-choose-type form-control-page {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'page') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto"
                                        name="card_1_section_url[page]"
                                        data-title="page"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                            @if (check_module('blog'))
                                <div class="form-control-choose-type form-control-category {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'category') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select  mw-auto "
                                        name="card_1_section_url[category]"
                                        data-title="category"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-control-choose-type form-control-post {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'post') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto "
                                        name="card_1_section_url[post]"
                                        data-title="post"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <!--end::row card_1_section_url -->

            <!--begin::Input Image card 1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_banner_1') </label>
                <div class="col-md-8">

                    @if(isset($model))
                        <x-media-library-collection data-title="section_banner_1" data-type="image" max-items="1" name="section_banner_1" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @else
                        <x-media-library-attachment data-title="section_banner_1" data-type="image" name="section_banner_1" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @endif

                </div>
            </div>
            <!--end::Input Image -->
        </div>

        <div class="cont2">
            <div class="">
                <!--begin::row card_2_bg_color -->
                <div class="row mb-6 card_2_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_2_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                                name="card_2_bg_color"
                                value="{{ isset($data['card_2_bg_color']) ? $data['card_2_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_2_bg_color -->

                <!--begin::row card_title_2_color -->
                <div class="row mb-6 card_title_2_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_title_2_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_2_color_input"
                                name="card_title_2_color"
                                value="{{ isset($data['card_title_2_color']) ? $data['card_title_2_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_title_2_color -->

                <!--begin::row card_desc_2_color -->
                <div class="row mb-6 card_desc_2_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_desc_2_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_2_color_input"
                                name="card_desc_2_color"
                                value="{{ isset($data['card_desc_2_color']) ? $data['card_desc_2_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_desc_2_color -->

                <!--begin::row card_2_button_bg_color -->
                <div class="row mb-6 card_2_button_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_2_button_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_2_button_bg_color_input"
                                name="card_2_button_bg_color"
                                value="{{ isset($data['card_2_button_bg_color']) ? $data['card_2_button_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_2_button_bg_color -->

                <!--begin::row card_2_button_text_color -->
                <div class="row mb-6 card_2_button_text_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_2_button_text_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_2_button_text_color_input"
                                name="card_2_button_text_color"
                                value="{{ isset($data['card_2_button_text_color']) ? $data['card_2_button_text_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_2_button_text_color -->
            </div>


            <!--begin::row card_title_2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_2') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_title_2">
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
                                name="card_title_2[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][app()->getLocale()]) ? $data['card_title_2'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_title_2[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][$locale['code']]) ? $data['card_title_2'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row card_title_2 -->

            <!--begin::row card_description_2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_2') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_card_description_2">
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

                            <textarea name="card_description_2[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_2']) && isset($data['card_description_2'][app()->getLocale()]) ? $data['card_description_2'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="card_description_2[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_2']) && isset($data['card_description_2'][$locale['code']]) ? $data['card_description_2'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_description_2 -->

            <!--begin::row card_2_section_button -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_2_section_button') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_2_section_button">
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
                                name="card_2_section_button[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_2_section_button']) && isset($data['card_2_section_button'][app()->getLocale()]) ? $data['card_2_section_button'][app()->getLocale()] : 'Button' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_2_section_button[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_2_section_button']) && isset($data['card_2_section_button'][$locale['code']]) ? $data['card_2_section_button'][$locale['code']] : 'Button' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_2_section_button -->

            <!--begin::row card_2_section_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_2_section_url') </label>
                <div class="col-md-8">

                        <div class="input-group url_input_container" id="url_input_container_card_2_section_url">
                            <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="card_2_section_url[type]" data-title="type">
                                <option value="custom"  {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type'])) ? ($data['card_2_section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                                @if (check_module('pages'))
                                    <option value="page" {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                                @endif
                                @if (check_module('blog'))
                                    <option value="category" {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                    <option value="post" {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                                @endif
                            </select>
                            <input
                                type="text"
                                name="card_2_section_url[custom]"
                                data-title="custom"
                                data-type="array"
                                class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type'])) ? ($data['card_2_section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                                value="{{ isset($data['card_2_section_url']) && isset($data['card_2_section_url']['custom']) ? $data['card_2_section_url']['custom'] : '' }}"
                            >
                            @if (check_module('pages'))
                                <div class="form-control-choose-type form-control-page {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'page') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto"
                                        name="card_2_section_url[page]"
                                        data-title="page"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_2_section_url']) && isset($data['card_2_section_url']['page']) && $data['card_2_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                            @if (check_module('blog'))
                                <div class="form-control-choose-type form-control-category {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'category') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select  mw-auto "
                                        name="card_2_section_url[category]"
                                        data-title="category"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_2_section_url']) && isset($data['card_2_section_url']['page']) && $data['card_2_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-control-choose-type form-control-post {{ (isset($data['card_2_section_url']) && isset($data['card_2_section_url']['type']) && $data['card_2_section_url']['type'] == 'post') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto "
                                        name="card_2_section_url[post]"
                                        data-title="post"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_2_section_url']) && isset($data['card_2_section_url']['page']) && $data['card_2_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <!--end::row card_2_section_url -->

            <!--begin::Input Image card 2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_banner_2') </label>
                <div class="col-md-8">

                    @if(isset($model))
                        <x-media-library-collection data-title="section_banner_2" data-type="image" max-items="1" name="section_banner_2" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @else
                        <x-media-library-attachment data-title="section_banner_2" data-type="image" name="section_banner_2" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @endif


                </div>
            </div>
            <!--end::Input Image -->
        </div>

        <div class="cont3">
            <div class="">
                <!--begin::row card_3_bg_color -->
                <div class="row mb-6 card_3_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_3_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                                name="card_3_bg_color"
                                value="{{ isset($data['card_3_bg_color']) ? $data['card_3_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_3_bg_color -->

                <!--begin::row card_title_3_color -->
                <div class="row mb-6 card_title_3_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_title_3_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_3_color_input"
                                name="card_title_3_color"
                                value="{{ isset($data['card_title_3_color']) ? $data['card_title_3_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_title_3_color -->

                <!--begin::row card_desc_3_color -->
                <div class="row mb-6 card_desc_3_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_desc_3_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_3_color_input"
                                name="card_desc_3_color"
                                value="{{ isset($data['card_desc_3_color']) ? $data['card_desc_3_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_desc_3_color -->

                <!--begin::row card_3_button_bg_color -->
                <div class="row mb-6 card_3_button_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_3_button_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_3_button_bg_color_input"
                                name="card_3_button_bg_color"
                                value="{{ isset($data['card_3_button_bg_color']) ? $data['card_3_button_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_3_button_bg_color -->

                <!--begin::row card_3_button_text_color -->
                <div class="row mb-6 card_3_button_text_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_3_button_text_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_3_button_text_color_input"
                                name="card_3_button_text_color"
                                value="{{ isset($data['card_3_button_text_color']) ? $data['card_3_button_text_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_3_button_text_color -->
            </div>
            <!--begin::row card_title_3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_3') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_title_3">
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
                                name="card_title_3[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][app()->getLocale()]) ? $data['card_title_3'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_title_3[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][$locale['code']]) ? $data['card_title_3'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row card_title_3 -->

            <!--begin::row card_description_3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_3') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_card_description_3">
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

                            <textarea name="card_description_3[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_3']) && isset($data['card_description_3'][app()->getLocale()]) ? $data['card_description_3'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="card_description_3[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_3']) && isset($data['card_description_3'][$locale['code']]) ? $data['card_description_3'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_description_3 -->

            <!--begin::row card_3_section_button -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_3_section_button') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_3_section_button">
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
                                name="card_3_section_button[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_3_section_button']) && isset($data['card_3_section_button'][app()->getLocale()]) ? $data['card_3_section_button'][app()->getLocale()] : 'Button' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_3_section_button[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_3_section_button']) && isset($data['card_3_section_button'][$locale['code']]) ? $data['card_3_section_button'][$locale['code']] : 'Button' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_3_section_button -->

            <!--begin::row card_3_section_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_3_section_url') </label>
                <div class="col-md-8">

                        <div class="input-group url_input_container" id="url_input_container_card_3_section_url">
                            <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="card_3_section_url[type]" data-title="type">
                                <option value="custom"  {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type'])) ? ($data['card_3_section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                                @if (check_module('pages'))
                                    <option value="page" {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                                @endif
                                @if (check_module('blog'))
                                    <option value="category" {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                    <option value="post" {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                                @endif
                            </select>
                            <input
                                type="text"
                                name="card_3_section_url[custom]"
                                data-title="custom"
                                data-type="array"
                                class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type'])) ? ($data['card_3_section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                                value="{{ isset($data['card_3_section_url']) && isset($data['card_3_section_url']['custom']) ? $data['card_3_section_url']['custom'] : '' }}"
                            >
                            @if (check_module('pages'))
                                <div class="form-control-choose-type form-control-page {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'page') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto"
                                        name="card_3_section_url[page]"
                                        data-title="page"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_3_section_url']) && isset($data['card_3_section_url']['page']) && $data['card_3_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                            @if (check_module('blog'))
                                <div class="form-control-choose-type form-control-category {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'category') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select  mw-auto "
                                        name="card_3_section_url[category]"
                                        data-title="category"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_3_section_url']) && isset($data['card_3_section_url']['page']) && $data['card_3_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-control-choose-type form-control-post {{ (isset($data['card_3_section_url']) && isset($data['card_3_section_url']['type']) && $data['card_3_section_url']['type'] == 'post') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto "
                                        name="card_3_section_url[post]"
                                        data-title="post"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_3_section_url']) && isset($data['card_3_section_url']['page']) && $data['card_3_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <!--end::row card_3_section_url -->

            <!--begin::Input Image card 3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_banner_3') </label>
                <div class="col-md-8">

                    @if(isset($model))
                        <x-media-library-collection data-title="section_banner_3" data-type="image" max-items="1" name="section_banner_3" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @else
                        <x-media-library-attachment data-title="section_banner_3" data-type="image" name="section_banner_3" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @endif


                </div>
            </div>
            <!--end::Input Image -->
        </div>

        <div class="cont4">
            <div class="">
                <!--begin::row card_4_bg_color -->
                <div class="row mb-6 card_4_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_4_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                                name="card_4_bg_color"
                                value="{{ isset($data['card_4_bg_color']) ? $data['card_4_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_4_bg_color -->

                <!--begin::row card_title_4_color -->
                <div class="row mb-6 card_title_4_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_title_4_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_4_color_input"
                                name="card_title_4_color"
                                value="{{ isset($data['card_title_4_color']) ? $data['card_title_4_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_title_4_color -->

                <!--begin::row card_desc_4_color -->
                <div class="row mb-6 card_desc_4_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_desc_4_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_4_color_input"
                                name="card_desc_4_color"
                                value="{{ isset($data['card_desc_4_color']) ? $data['card_desc_4_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_desc_4_color -->

                <!--begin::row card_4_button_bg_color -->
                <div class="row mb-6 card_4_button_bg_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_4_button_bg_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_4_button_bg_color_input"
                                name="card_4_button_bg_color"
                                value="{{ isset($data['card_4_button_bg_color']) ? $data['card_4_button_bg_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_4_button_bg_color -->

                <!--begin::row card_4_button_text_color -->
                <div class="row mb-6 card_4_button_text_color">
                    <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_4_button_text_color') </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input
                                class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_4_button_text_color_input"
                                name="card_4_button_text_color"
                                value="{{ isset($data['card_4_button_text_color']) ? $data['card_4_button_text_color'] : '' }}"
                            >
                        </div>
                    </div>
                </div>
                <!--end::row card_4_button_text_color -->
            </div>

            <!--begin::row card_title_4 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_4') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_title_4">
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
                                name="card_title_4[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_title_4']) && isset($data['card_title_4'][app()->getLocale()]) ? $data['card_title_4'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_title_4[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_title_4']) && isset($data['card_title_4'][$locale['code']]) ? $data['card_title_4'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row card_title_4 -->

            <!--begin::row card_description_4 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_4') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_card_description_4">
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

                            <textarea name="card_description_4[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_4']) && isset($data['card_description_4'][app()->getLocale()]) ? $data['card_description_4'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="card_description_4[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_4']) && isset($data['card_description_4'][$locale['code']]) ? $data['card_description_4'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_description_4 -->

            <!--begin::row card_4_section_button -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_4_section_button') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_card_4_section_button">
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
                                name="card_4_section_button[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['card_4_section_button']) && isset($data['card_4_section_button'][app()->getLocale()]) ? $data['card_4_section_button'][app()->getLocale()] : 'Button' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="card_4_section_button[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['card_4_section_button']) && isset($data['card_4_section_button'][$locale['code']]) ? $data['card_4_section_button'][$locale['code']] : 'Button' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row card_4_section_button -->

            <!--begin::row card_4_section_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_4_section_url') </label>
                <div class="col-md-8">

                        <div class="input-group url_input_container" id="url_input_container_card_4_section_url">
                            <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="card_4_section_url[type]" data-title="type">
                                <option value="custom"  {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type'])) ? ($data['card_4_section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                                @if (check_module('pages'))
                                    <option value="page" {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                                @endif
                                @if (check_module('blog'))
                                    <option value="category" {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                                    <option value="post" {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                                @endif
                            </select>
                            <input
                                type="text"
                                name="card_4_section_url[custom]"
                                data-title="custom"
                                data-type="array"
                                class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type'])) ? ($data['card_4_section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                                value="{{ isset($data['card_4_section_url']) && isset($data['card_4_section_url']['custom']) ? $data['card_4_section_url']['custom'] : '' }}"
                            >
                            @if (check_module('pages'))
                                <div class="form-control-choose-type form-control-page {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'page') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto"
                                        name="card_4_section_url[page]"
                                        data-title="page"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_page')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_4_section_url']) && isset($data['card_4_section_url']['page']) && $data['card_4_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                            @if (check_module('blog'))
                                <div class="form-control-choose-type form-control-category {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'category') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select  mw-auto "
                                        name="card_4_section_url[category]"
                                        data-title="category"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_category')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_4_section_url']) && isset($data['card_4_section_url']['page']) && $data['card_4_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-control-choose-type form-control-post {{ (isset($data['card_4_section_url']) && isset($data['card_4_section_url']['type']) && $data['card_4_section_url']['type'] == 'post') ? '' : 'd-none' }}">
                                    <select
                                        class="form-select mw-auto "
                                        name="card_4_section_url[post]"
                                        data-title="post"
                                        data-type="array"
                                        data-placeholder="@lang('theme_goshippo::view.choose_post')"
                                    >
                                        @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                            @foreach ($data['categories'] as $categoryId)
                                                @php
                                                    $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                                @endphp
                                                <option value="{{$category->id}}" {{ isset($data['card_4_section_url']) && isset($data['card_4_section_url']['page']) && $data['card_4_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
            <!--end::row card_4_section_url -->

            <!--begin::Input Image card 4 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_banner_4') </label>
                <div class="col-md-8">

                    @if(isset($model))
                        <x-media-library-collection data-title="section_banner_4" data-type="image" max-items="1" name="section_banner_4" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @else
                        <x-media-library-attachment data-title="section_banner_4" data-type="image" name="section_banner_4" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                    @endif

                </div>
            </div>
            <!--end::Input Image -->
        </div>
    </div>

</div>


<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
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
    $(".color_picker_input_{{ isset($id) ? $id : 'id' }}").spectrum({
        type: "component",
        showInput: true,
        showInitial: true,
        clickoutFiresChange: true,
        allowEmpty: true,
        maxSelectionSize: 8,
    });
    function formatFlag(lang) {
        if (!lang.id) {
            return lang.text;
        }
        var $img = $(lang.element).attr("data-flag");
        if ($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") +
                ' " />&emsp;' + lang.text + '</span>'
            );
        } else {
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    }
    function formatState(lang) {
        if (!lang.id) {
            return lang.text;
        }
        var $img = $(lang.element).attr("data-flag");
        if ($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") +
                ' " />&emsp;' + lang.text + '</span>'
            );
        } else {
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
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                if (data && data.categories) {
                    return {
                        results: data.categories.map(function(category) {
                            return {
                                id: category.id,
                                text: category.name
                            }
                        })
                    };
                }
            },
            cache: true,
        },
    });
    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))
        $('.select_categories_{{ $id }}').val([{{ implode(', ', $data['categories']) }}]).trigger(
            'change');
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
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                if (data && data.tags) {
                    return {
                        results: data.tags.map(function(tag) {
                            return {
                                id: tag.id,
                                text: tag.name
                            }
                        })
                    };
                }
            },
            cache: true,
        },
    });
    @if (isset($id) && isset($data['tags']) && is_array($data['tags']))
        $('.select_tags_{{ $id }}').val([{{ implode(', ', $data['tags']) }}]).trigger('change');
    @endif
    // end select tags
    /*******************************************************************************************/
    $('.display_input ').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.control').show()
        } else {
            $('.control').hide()
        }
    });


        $('input[type=radio]').change(function() {
            if (this.value == 1){
                $(".cont1").css("display","block");
                $(".cont2").css("display","none");
                $(".cont3").css("display","none");
                $(".cont4").css("display","none");
            }
            else if (this.value == 2){
                $(".cont1").css("display","block");
                $(".cont2").css("display","block");
                $(".cont3").css("display","none");
                $(".cont4").css("display","none");
            }
            else if (this.value == 3){
                    $(".cont1").css("display","block");
                    $(".cont2").css("display","block");
                    $(".cont3").css("display","block");
                    $(".cont4").css("display","none");
                }
            else if (this.value == 4){
                    $(".cont1").css("display","block");
                    $(".cont2").css("display","block");
                    $(".cont3").css("display","block");
                    $(".cont4").css("display","block");
                }
        });
</script>
