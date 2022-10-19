@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="info">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_shipito::view.display') </label>
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
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_shipito::view.section_bg') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} header_bg_input"
                    name="header_bg"
                    value="{{ isset($data['header_bg']) ? $data['header_bg'] :  ''  }}"
                >
            </div>
        </div>
    </div>
    <!--end::row header_bg -->

    <!--begin::row title_color -->
    <div class="row mb-6 title_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_shipito::view.section_title_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} title_color_input"
                    name="title_color"
                    value="{{ isset($data['title_color']) ? $data['title_color'] :   ''   }}"
                >
            </div>
        </div>
    </div>
    <!--end::row title_color -->

    <!--begin::row section title_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_shipito::view.title_1') </label>
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
                        name="slides_1_title[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['slides_1_title']) && isset($data['slides_1_title'][app()->getLocale()]) ? $data['slides_1_title'][app()->getLocale()] : 'This is the heading' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="slides_1_title[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['slides_1_title']) && isset($data['slides_1_title'][$locale['code']]) ? $data['slides_1_title'][$locale['code']] : 'This is the heading' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section title_1 -->

    <!--begin::Input img_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_shipito::view.img_1') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="slides_1_img" data-type="image" max-items="1" name="slides_1_img" :model="$model" collection="slides_1_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="slides_1_img" data-type="image" name="slides_1_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input img_1 -->


    <!--begin::row section title_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_shipito::view.title_2') </label>
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
                        name="slides_2_title[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['slides_2_title']) && isset($data['slides_2_title'][app()->getLocale()]) ? $data['slides_2_title'][app()->getLocale()] : 'This is the heading' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="slides_2_title[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['slides_2_title']) && isset($data['slides_2_title'][$locale['code']]) ? $data['slides_2_title'][$locale['code']] : 'This is the heading' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section title_2 -->

    <!--begin::Input img_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_shipito::view.img_2') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="slides_2_img" data-type="image" max-items="1" name="slides_2_img" :model="$model" collection="slides_2_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="slides_2_img" data-type="image" name="slides_2_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input img_2 -->


    <!--begin::row section title_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_shipito::view.title_2') </label>
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
                        name="slides_3_title[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['slides_3_title']) && isset($data['slides_3_title'][app()->getLocale()]) ? $data['slides_3_title'][app()->getLocale()] : 'This is the heading' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="slides_3_title[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['slides_3_title']) && isset($data['slides_3_title'][$locale['code']]) ? $data['slides_3_title'][$locale['code']] : 'This is the heading' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section title_3 -->

    <!--begin::Input img_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_shipito::view.img_3') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="slides_3_img" data-type="image" max-items="1" name="slides_3_img" :model="$model" collection="slides_3_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="slides_3_img" data-type="image" name="slides_3_img" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input img_3 -->




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
