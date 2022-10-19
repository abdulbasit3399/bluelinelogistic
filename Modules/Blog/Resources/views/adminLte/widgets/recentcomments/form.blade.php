<form class="recentcomments-widget">

    <!--begin::Input group count -->
    <div class="mb-6">
        <label class="fw-bold mb-1 fs-6 required"> @lang('blog::view.widget_recent_comments.comments_count') </label>
        <div class="mb-4">
            <input
                type="text"
                name="comments_count"
                placeholder="@lang('blog::view.widget_recent_comments.comments_count')"
                class="form-control posts-count"
                value="{{ isset($oldData['comments_count']) ? $oldData['comments_count'] : '5' }}"
            >
        </div>
    </div>
    <!--end::Input group count -->

    <!--begin::Input group parent_only -->
    <div class="mb-6">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    name="parent_only"
                    type="checkbox"
                    value="1"
                    {{ isset($oldData['parent_only']) && $oldData['parent_only'] == 1 ? 'checked="checked"' : '' }}
                >
                <label
                    class="form-check-label fw-bold fs-6"
                >
                    @lang('blog::view.widget_recent_comments.parent_only')
                </label>
            </div>
        </div>
    </div>
    <!--end::Input group parent_only -->
</form>