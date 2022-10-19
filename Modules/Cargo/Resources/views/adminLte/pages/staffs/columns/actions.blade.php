<!-- begin: Btn Edit Row -->
@can('edit-staffs')
    <a
        href="{{ fr_route('staffs.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endcan
<!-- end: Btn Edit Row -->

<!-- begin: Btn Delete Row -->
@can('delete-staffs')
    <button
        type="button"
        data-action="{{ fr_route('staffs.destroy', $model->id) }}"
        data-callback="reload-table"
        data-table-id="{{ isset($table_id) ? $table_id : '' }}"
        data-model-name="{{ $model->name }}"
        data-modal-message="@lang('view.modal_message_delete')"
        data-modal-action="@lang('view.delete')"
        data-time-alert="2000"
        class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
        data-toggle="tooltip" title="{{ __('view.delete') }}"
    >
        <i class="fas fa-trash fa-fw"></i>
    </button>
@endcan


<!-- end: Btn Delete Row -->

<!-- begin: Btn manage access -->
@admin
    <a
        href="{{ fr_route('users.manage-access', $model->user->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.manage_access') }}"
        >
        <i class="fas fa-universal-access fa-fw"></i>
    </a>
@endadmin
<!-- end: Btn manage access -->