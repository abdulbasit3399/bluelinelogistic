<div class="form-check form-switch mb-2 languages-switch">
    <input
        class="form-check-input switch_table"
        type="checkbox"
        id="switch_table_{{ $model->id }}"
        data-model-id="{{ $model->id }}"
        data-parent=".languages-switch"
        data-url="{{ fr_route('languages.switch-default', ['id' => $model->id]) }}"
        data-approved-text="@lang('view.approved')"
        data-rejected-text="@lang('view.rejected')"
        {{ $model->is_default ? 'checked="checked" disabled' : '' }}
    >
    <label
        class="form-check-label"
        for="comment_approval_{{ $model->id }}"
    ></label>
</div>

