@php
    $id_select = $id ?? rand(9999, 99999);
@endphp

<form class="post-widget">

    <!--begin::Input group section_title -->
    <div>
        <label class="fw-bold mb-1 fs-6 required"> @lang('blog::view.widget_post.section_title') </label>
        <div class="mb-2">
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
                    name="section_title[{{ get_current_lang()['code']}}]"
                    title="{{get_current_lang()['code']}}"
                    placeholder="@lang('blog::view.widget_post.section_title')"
                    value="{{ old('section_title.' . get_current_lang()['code'] , isset($oldData['section_title']) ? (isset($oldData['section_title'][get_current_lang()['code']]) ? $oldData['section_title'][get_current_lang()['code']] : '' ) : '') }}"
                    class="section-title form-control  form-control-multilingual form-control-{{app()->getLocale()}}  @error('section_title.' . app()->getLocale()) is-invalid @enderror"
                >
                @error('section_title.' . get_current_lang()['code'])
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @foreach(get_langauges_except_current() as $locale)

                    <input
                        type="text"
                        class="section-title form-control  form-control-multilingual form-control-{{$locale['code']}} @error('title.' . $locale['code']) is-invalid @enderror d-none"
                        name="section_title[{{ $locale['code'] }}]"
                        title="{{$locale['code']}}"
                        placeholder="@lang('blog::view.widget_post.section_title')"
                        value="{{ old('section_title.' . $locale['code'], isset($oldData['section_title']) ? (isset($oldData['section_title'][$locale['code']]) ? $oldData['section_title'][$locale['code']] : '' ) : '') }}"
                    >

                    @error('section_title.' . $locale['code'])
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Input group section_title -->

    <!--begin::Input group count -->
    <div>
        <label class="fw-bold mb-1 fs-6 required"> @lang('blog::view.widget_post.posts_count') </label>
        <div class="mb-2">
            <input
                type="text"
                name="posts_count"
                placeholder="@lang('blog::view.widget_post.posts_count')"
                class="form-control posts-count"
                value="{{ isset($oldData['posts_count']) ? $oldData['posts_count'] : '3' }}"
            >
        </div>
    </div>
    <!--end::Input group count -->

    <!--begin::Input group posts_order -->
    <div class="mb-6">
        <label class="fw-bold mb-1 fs-6 required"> @lang('blog::view.widget_post.posts_order') </label>
        <div class="mb-4">
            <select
                class="form-control order-posts-select"
                name="posts_order"
            >
                @foreach($postOrderTypes as $type)
                    <option value="{{ $type['id'] }}" {{ isset($oldData['posts_order']) && $oldData['posts_order'] == $type['id'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end::Input group posts_order -->

    <!--begin::Input group view_style -->
    <div class="mb-6">
        <label class="fw-bold mb-1 fs-6 required"> @lang('blog::view.widget_post.view_style') </label>
        <div class="mb-4">
            <select
                class="form-control view-style-select"
                name="view_style"
            >
                @foreach($viewStyles as $viewStyles)
                    <option value="{{ $viewStyles['id'] }}" {{ isset($oldData['view_style']) && $oldData['view_style'] == $viewStyles['id'] ? 'selected' : '' }}>{{ $viewStyles['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end::Input group view_style -->


    <!--begin::Input group display_rating -->
    {{-- <div class="mb-6">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    name="display_rating"
                    type="checkbox"
                    value="1"
                    {{ isset($oldData['display_rating']) && $oldData['display_rating'] == 1 ? 'checked="checked"' : '' }}
                >
                <label
                    class="form-check-label fw-bold fs-6"
                >
                    @lang('blog::view.widget_post.display_rating')
                </label>
            </div>
        </div>
    </div> --}}
    <!--end::Input group display_rating -->

    <!--begin::Input group display_category -->
    <div class="mb-6">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    name="display_category"
                    {{-- id="display_category_{{$id_select}}" --}}
                    type="checkbox"
                    value="1"
                    {{ isset($oldData['display_category']) && $oldData['display_category'] == 1 ? 'checked="checked"' : '' }}
                >
                <label
                    class="form-check-label fw-bold fs-6"
                    {{-- for="display_category_{{$id_select}}" --}}
                >
                    @lang('blog::view.widget_post.display_category')
                </label>
            </div>
        </div>
    </div>
    <!--end::Input group display_category -->

    <!--begin::Input group display_load_posts_button -->
    <div class="mb-6">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    name="display_load_posts_button"
                    {{-- id="display_load_posts_button_{{$id_select}}" --}}
                    type="checkbox"
                    value="1"
                    {{ isset($oldData['display_load_posts_button']) && $oldData['display_load_posts_button'] == 1 ? 'checked="checked"' : '' }}
                >
                <label
                    class="form-check-label fw-bold fs-6"
                    {{-- for="display_load_posts_button_{{$id_select}}" --}}
                >
                    @lang('blog::view.widget_post.display_load_posts_button')
                </label>
            </div>
        </div>
    </div>
    <!--end::Input group display_load_posts_button -->


    


</form>