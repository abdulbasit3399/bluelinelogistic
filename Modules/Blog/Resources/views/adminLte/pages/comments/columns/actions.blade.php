
<!-- begin: Btn Edit Row -->
@can('edit-comments')
    <a
        href="{{ fr_route('comments.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
    >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endcan
<!-- end: Btn Edit Row -->




<!-- begin: Btn Delete Row -->
{{-- 
    data-callback = reload-page, reload-table, delete-row
--}}

@can('delete-comments')
    <button
        type="button"
        data-action="{{ fr_route('comments.destroy', $model->id) }}"
        data-callback="reload-table"
        data-table-id="{{ isset($table_id) ? $table_id : '' }}"
        data-model-name="{{ __('blog::view.comments_table.comment') }}"
        data-time-alert="2000"
        class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
        data-toggle="tooltip"
        title="@lang('view.delete')"
    >
        <i class="fas fa-trash fa-fw"></i>
    </button>
@endcan
<!-- end: Btn Delete Row -->


{{-- @can('approval-comments')
    @if ($model->approved != 1)
        <button 
            type="button"
            data-url="{{ fr_route('comments.approval') }}"
            data-request-data="[{{ $model->id }}]"
            data-action="approve"
            data-callback="reload-table"
            data-table-id="{{ isset($table_id) ? $table_id : '' }}"
            data-model-name="@lang('blog::view.selected_comments')"
            data-modal-action="@lang('view.approve')"
            data-modal-message="@lang('view.modal_message_approve')"
            data-time-alert="2000"
            class="btn-single-action btn btn-sm btn-secondary btn-action-table"
            data-toggle="tooltip"
            title="@lang('view.approve')"
        >
            <i class="fas fa-check fa-fw"></i>
        </button>
    @endif

    @if ($model->approved != 2)
        <button 
            type="button"
            data-url="{{ fr_route('comments.approval') }}"
            data-request-data="[{{ $model->id }}]"
            data-action="reject"
            data-callback="reload-table"
            data-table-id="{{ isset($table_id) ? $table_id : '' }}"
            data-model-name="@lang('blog::view.selected_comments')"
            data-modal-action="@lang('view.reject')"
            data-modal-message="@lang('view.modal_message_reject')"
            data-time-alert="2000"
            class="btn-single-action btn btn-sm btn-secondary btn-action-table"
            data-toggle="tooltip"
            title="@lang('view.reject')"
        >
            <i class="fas fa-ban fa-fw"></i>
        </button>
    @endif
@endcan --}}
<!-- end: Btn Delete Row -->
