<div class="custom-control custom-switch form-check form-switch mb-2">
    <input
        class="custom-control-input form-check-input comment_approval"
        type="checkbox"
        id="comment_approval_{{ $model->id }}"
        data-model-id="{{ $model->id }}"
        data-url="{{ fr_route('comments.approval') }}"
        data-approved-text="@lang('view.approved')"
        data-rejected-text="@lang('view.rejected')"
        {{ $model->approved == 1 ? 'checked="checked"' : '' }}
    >
    <label
        class="custom-control-label"
        for="comment_approval_{{ $model->id }}"
    ></label>
</div>

