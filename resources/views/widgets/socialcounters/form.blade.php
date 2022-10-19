<form>

    <div class="social-counters-widget-form" data-id="{{$id}}">
        <div class="single-social-counter p-4 mb-5 border border-secondary rounded bg-white shadow-sm copy d-none">
            <div class="mb-2 d-flex justify-content-end">
                <span class="remove-platform cursor-pointer" title="@lang('view.remove_platform')">
                    <i class="fas fa-trash fs-6 fa-fw"></i>
                </span>
            </div>
            <!--begin::Input group platform -->
            <div class="mb-6">
                <label class="fw-bold fs-6"> @lang('view.social_counters_data.platform') </label>
                <div class="mb-4">
                    <select
                        class="form-select platform-select"
                    >
                        @foreach($platforms as $platform)
                            <option value="{{ $platform['id'] }}">{{ $platform['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Input group platform -->
        
            <!--begin::Input group count -->
            <div>
                <label class="fw-bold fs-6"> @lang('view.social_counters_data.count') </label>
                <div class="mb-2">
                    <input
                        type="text"
                        placeholder="@lang('view.example'): 25"
                        class="form-control platform-count"
                    >
                </div>
            </div>
            <!--end::Input group count -->
        </div>

        <div class="social-counters">
            @foreach($oldData['socials'] as $index => $social)
            {{-- data-id="{{$id}}" data-index="{{$id . '-' . $index}}" --}}
                <div class="single-social-counter p-4 mb-5 border border-secondary rounded bg-white shadow-sm">
                    <div class="mb-2 d-flex justify-content-end">
                        <span class="remove-platform cursor-pointer" title="@lang('view.remove_platform')">
                            <i class="fas fa-trash fs-6 fa-fw"></i>
                        </span>
                    </div>
                    <!--begin::Input group platform -->
                    <div class="mb-6">
                        <label class="fw-bold fs-6 required"> @lang('view.social_counters_data.platform') </label>
                        <div class="mb-4">
                            <select
                                class="form-select platform-select"
                                name="socials.{{$index}}.platform"
                            >
                                @foreach($platforms as $platform)
                                    <option value="{{ $platform['id'] }}" {{ isset($social['platform']) && $social['platform'] == $platform['id'] ? 'selected' : '' }}>{{ $platform['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Input group platform -->
                
                    <!--begin::Input group count -->
                    <div>
                        <label class="fw-bold fs-6 required"> @lang('view.social_counters_data.count') </label>
                        <div class="mb-2">
                            <input
                                type="text"
                                name="socials.{{$index}}.count"
                                placeholder="@lang('view.example'): 25"
                                class="form-control platform-count"
                                value="{{ isset($social['count']) ? $social['count'] : '' }}"
                            >
                        </div>
                    </div>
                    <!--end::Input group count -->
                </div>
            @endforeach

        </div>
        <div class="d-flex justify-content-end">
            <button
                class="btn btn-primary btn-sm add-new-platform"
                type="button"
            >
                @lang('view.add_new_platform')
                <i class="fas fa-plus ms-1"></i>
            </button>
        </div>
    </div>

</form>

<script class="social-counters-widget-form-script">

    if ($('.social-counters-widget-form-script').length <= 1) {

        $(document).on('click', '.social-counters-widget-form .remove-platform', function () {
            $(this).parents('.single-social-counter').remove();
        });

        $(document).on('click', '.social-counters-widget-form .add-new-platform', function () {
            var self = $(this),
                parentForm = self.parents('.social-counters-widget-form'),
                wrapperSocials = parentForm.find('.social-counters'),
                cloneCopied = parentForm.find('.single-social-counter.copy').clone(),
                newIndex    = wrapperSocials.find('.single-social-counter').length;
                
            cloneCopied.removeClass('copy d-none')
            cloneCopied.find('.platform-select').attr('name', 'socials.' + newIndex + '.platform')
            cloneCopied.find('.platform-count').attr('name', 'socials.' + newIndex + '.count')
            wrapperSocials.append(cloneCopied)
        });
    }

</script>