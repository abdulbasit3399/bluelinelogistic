@php
    $hasFooterLogo = isset($data['footer_logo']) && $data['footer_logo'];
    $getFooterLogo = $hasFooterLogo ? Storage::url(Config::get('DIRECTORY_IMAGE') . '/' . $data['footer_logo']) : '';

@endphp

<div class="footer-setting">



    <!--begin::main_footer -->
    <div class="setting-box">
        <h4 class="setting-box-label fw-bold fs-3">@lang('theme_easyship::view.main_footer') </h4>

        <!--begin::row display_footer -->
        <div class="row mb-6 display_footer">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.display_footer') </label>
            <div class="col-md-8">
                <div class="custom-control custom-switch form-check form-switch">
                    <input
                        class="custom-control-input form-check-input display_footer_input"
                        name="display_footer"
                        type="checkbox"
                        value="1"
                        id="display_footer"
                        {{ isset($data['display_footer']) && $data['display_footer'] == 1 ? 'checked="checked"' : '' }}
                    >
                    <label
                        class="custom-control-label form-check-label fw-bold fs-6" for="display_footer"
                    >
                    </label>
                </div>
            </div>
        </div>
        <!--end::row display_footer -->

        <div class="footer_control" style="{{ isset($data['display_footer']) && $data['display_footer'] ?: 'display: none;' }}">
            <!--begin::row footer_style -->
            <div class="row mb-6 footer_style">
                <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.footer_style') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="form-check mx-3">
                            <input
                                class="custom-control-input form-check-input"
                                type="radio"
                                name="footer_style"
                                id="footer_light_style"
                                value="light_style"
                                {{ isset($data['footer_style']) && $data['footer_style'] == 'light_style' ? 'checked="checked"' : '' }}
                            >
                            <label class="custom-control-label form-check-label" for="footer_light_style">
                                @lang('theme_easyship::view.light')
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input
                                class="custom-control-input form-check-input"
                                type="radio"
                                name="footer_style"
                                id="footer_dark_style"
                                value="dark_style"
                                {{ isset($data['footer_style']) && $data['footer_style'] == 'dark_style' ? 'checked="checked"' : '' }}
                            >
                            <label class="custom-control-label form-check-label" for="footer_dark_style">
                                @lang('theme_easyship::view.dark')
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::row footer_style -->
        </div>
    </div>
    <!--end::main_footer -->

    <!--begin::footer_widgets -->
    <div class="setting-box footer_control" style="{{ isset($data['display_footer']) && $data['display_footer'] ?: 'display: none;' }}">
        <h4 class="setting-box-label fw-bold fs-3">@lang('theme_easyship::view.footer_widgets') </h4>

        <!--begin::row display_widgets -->
        <div class="row mb-6 display_widgets">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.display_widgets') </label>
            <div class="col-md-8">
                <div class="custom-control custom-switch form-check form-switch">
                    <input
                        class="custom-control-input form-check-input display_widgets_input"
                        name="display_widgets"
                        type="checkbox"
                        value="1"
                        id="display_widgets"
                        {{ isset($data['display_widgets']) && $data['display_widgets'] == 1 ? 'checked="checked"' : '' }}
                    >
                    <label
                        class="custom-control-label form-check-label fw-bold fs-6" for="display_widgets"
                    >
                    </label>
                </div>
            </div>
        </div>
        <!--end::row display_widgets -->

        <!--begin::row widgets_count -->
        <div class="widgets_control" style="{{ isset($data['display_widgets']) && $data['display_widgets'] ?: 'display: none;' }}">
            <div class="row mb-6 widgets_count">
                <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.widgets_count') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="form-check mx-3">
                            <input class="custom-control-input form-check-input" type="radio" name="widgets_count" id="widgets_count1" value="1" {{ isset($data['widgets_count']) && $data['widgets_count'] == 1 ? 'checked="checked"' : '' }} >
                            <label class="custom-control-label form-check-label" for="widgets_count1">
                                <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-1.svg') }}">
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="custom-control-input form-check-input" type="radio" name="widgets_count" id="widgets_count2" value="2" {{ isset($data['widgets_count']) && $data['widgets_count'] == 2 ? 'checked="checked"' : '' }} >
                            <label class="custom-control-label form-check-label" for="widgets_count2">
                                <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-2.svg') }}">
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="custom-control-input form-check-input" type="radio" name="widgets_count" id="widgets_count3" value="3" {{ isset($data['widgets_count']) && $data['widgets_count'] == 3 ? 'checked="checked"' : '' }} >
                            <label class="custom-control-label form-check-label" for="widgets_count3">
                                <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-3.svg') }}">
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input  class="custom-control-input form-check-input" type="radio" name="widgets_count" id="widgets_count4" value="4" {{ isset($data['widgets_count']) && $data['widgets_count'] == 4 ? 'checked="checked"' : '' }} >
                            <label class="custom-control-label form-check-label" for="widgets_count4">
                                <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-4.svg') }}">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::row widgets_count -->
    </div>
    <!--end::footer_widgets -->



    <!--begin::footer_copyright -->
    <div class="setting-box footer_control" style="{{ isset($data['display_footer']) && $data['display_footer'] ?: 'display: none;' }}">
        <h4 class="setting-box-label fw-bold fs-3">@lang('theme_easyship::view.footer_copyright') </h4>
        <!--begin::row display_copyright -->
        <div class="row mb-6 display_copyright">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.display_copyright') </label>
            <div class="col-md-8">
                <div class="custom-control custom-switch form-check form-switch">
                    <input
                        class="custom-control-input form-check-input display_copyright_input"
                        name="display_copyright"
                        type="checkbox"
                        value="1"
                        id="display_copyright"
                        {{ isset($data['display_copyright']) && $data['display_copyright'] == 1 ? 'checked="checked"' : '' }}
                    >
                    <label
                        class="custom-control-label form-check-label fw-bold fs-6" for="display_copyright"
                    >
                    </label>
                </div>
            </div>
        </div>
        <!--end::row display_copyright -->

        <div class="copyright_control" style="{{ isset($data['display_copyright']) && $data['display_copyright'] ?: 'display: none;' }}">

            <!--begin::row copyright -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.copyright') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <textarea
                            name="copyright"
                            placeholder="@lang('theme_easyship::view.copyright')"
                            class="form-control min-h-100px copyright_input"
                        >{{ isset($data['copyright']) ? $data['copyright'] : '' }}</textarea>
                    </div>
                    <div class="form-text">@lang('theme_easyship::view.hint_copyright')</div>
                </div>
            </div>
            <!--end::row copyright -->

            <!--begin::row display_footer_links -->
            <div class="row mb-6 display_footer_links">
                <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.display_footer_links') </label>
                <div class="col-md-8">
                    <div class="custom-control custom-switch form-check form-switch">
                        <input
                            class="custom-control-input form-check-input display_footer_links_input"
                            name="display_footer_links"
                            type="checkbox"
                            value="1"
                            id="display_footer_links"
                            {{ isset($data['display_footer_links']) && $data['display_footer_links'] == 1 ? 'checked="checked"' : '' }}
                        >
                        <label
                            class="custom-control-label form-check-label fw-bold fs-6" for="display_footer_links"
                        >
                        </label>
                    </div>
                </div>
            </div>
            <!--end::row display_footer_links -->
        </div>



        <!--begin::row display_social -->
        <div class="row mb-6 display_social">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.display_social') </label>
            <div class="col-md-8">
                <div class="custom-control custom-switch form-check form-switch">
                    <input
                        class="custom-control-input form-check-input display_social_input"
                        name="display_social"
                        type="checkbox"
                        value="1"
                        id="display_social"
                        {{ isset($data['display_social']) && $data['display_social'] == 1 ? 'checked="checked"' : '' }}
                    >
                    <label
                        class="custom-control-label form-check-label fw-bold fs-6" for="display_social"
                    >
                    </label>
                </div>
            </div>
        </div>
        <!--end::row display_social -->

        <!--begin::row social_links -->
        <div class="social_links" style="{{ isset($data['display_social']) && $data['display_social'] ?: 'display: none;' }}">

            <!--begin::row section facebook_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.facebook_url') </label>
                <div class="col-md-8">
                    <div class="input-group url_input_container" id="url_input_container_facebook_url">
                        <input
                            type="text"
                            name="facebook_url"
                            class="form-control section-title form-control-choose-type form-control-custom "
                            value="{{ isset($data['facebook_url']) && isset($data['facebook_url']) ? $data['facebook_url'] : '' }}"
                        >
                    </div>
                </div>
            </div>
            <!--end::row section facebook_url -->

            <!--begin::row section twitter_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.twitter_url') </label>
                <div class="col-md-8">
                    <div class="input-group url_input_container" id="url_input_container_twitter_url">
                        <input
                            type="text"
                            name="twitter_url"
                            class="form-control section-title form-control-choose-type form-control-custom "
                            value="{{ isset($data['twitter_url']) && isset($data['twitter_url']) ? $data['twitter_url'] : '' }}"
                        >
                    </div>
                </div>
            </div>
            <!--end::row section twitter_url -->

            <!--begin::row section google_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.google_url') </label>
                <div class="col-md-8">
                    <div class="input-group url_input_container" id="url_input_container_google_url">
                        <input
                            type="text"
                            name="google_url"
                            class="form-control section-title form-control-choose-type form-control-custom "
                            value="{{ isset($data['google_url']) && isset($data['google_url']) ? $data['google_url'] : '' }}"
                        >
                    </div>
                </div>
            </div>
            <!--end::row section google_url -->

            <!--begin::row section dribbble_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.dribbble_url') </label>
                <div class="col-md-8">
                    <div class="input-group url_input_container" id="url_input_container_dribbble_url">
                        <input
                            type="text"
                            name="dribbble_url"
                            class="form-control section-title form-control-choose-type form-control-custom "
                            value="{{ isset($data['dribbble_url']) && isset($data['dribbble_url']) ? $data['dribbble_url'] : '' }}"
                        >
                    </div>
                </div>
            </div>
            <!--end::row section dribbble_url -->

            <!--begin::row section youtube_url -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.youtube_url') </label>
                <div class="col-md-8">
                    <div class="input-group url_input_container" id="url_input_container_youtube_url">
                        <input
                            type="text"
                            name="youtube_url"
                            class="form-control section-title form-control-choose-type form-control-custom "
                            value="{{ isset($data['youtube_url']) && isset($data['youtube_url']) ? $data['youtube_url'] : '' }}"
                        >
                    </div>
                </div>
            </div>
            <!--end::row section youtube_url -->
        </div>
        <!--end::row social_links -->

    </div>
    <!--end::footer_copyright -->

</div>

<script>


    $('.display_footer_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.footer_control, .footer_style').show()
        } else {
            $('.footer_control, .footer_style').hide()
        }
    });

    $('.display_widgets_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.widgets_control').show()
        } else {
            $('.widgets_control').hide()
        }
    });


    $('.display_footer_top_area_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.footer_top_area_control').show()
        } else {
            $('.footer_top_area_control').hide()
        }
    });

    $('.display_footer_logo_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.footer_logo').show()
        } else {
            $('.footer_logo').hide()
        }
    });

    $('.display_footer_paragraph_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.footer_paragraph').show()
        } else {
            $('.footer_paragraph').hide()
        }
    });

    $('.display_social_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.social_links').show()
        } else {
            $('.social_links').hide()
        }
    });

    $('.display_copyright_input').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.copyright_control').show()
        } else {
            $('.copyright_control').hide()
        }
    });

</script>
