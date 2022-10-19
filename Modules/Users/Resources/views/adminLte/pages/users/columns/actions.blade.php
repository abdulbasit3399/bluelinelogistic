<!-- begin: Btn View profile Row -->
@can('view-profile-users')
    <a
        href="{{ fr_route('users.show', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.view_profile') }}"
        >
        <i class="fas fa-eye fa-fw"></i>
    </a>
@endcan
<!-- end: Btn View profile Row -->


<!-- begin: Btn Edit Row -->
@can('edit-users')
    <a
        href="{{ fr_route('users.edit', $model->id) }}"
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

@can('delete-users')
    @if ($model->id != 1)
        <button
            type="button"
            data-action="{{ fr_route('users.destroy', $model->id) }}"
            data-callback="reload-table"
            data-table-id="{{ isset($table_id) ? $table_id : '' }}"
            data-model-name="{{ __('users::view.table.user') }}"
            data-time-alert="2000"
            class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
            data-toggle="tooltip" title="{{ __('view.delete') }}"
            data-modal-message="@lang('view.modal_message_delete')"
            data-modal-action="@lang('view.delete')"
        >
            <i class="fas fa-trash fa-fw"></i>
        </button>
    @endif
@endcan
<!-- end: Btn Delete Row -->



<!-- begin: Btn manage access -->
@admin
    <a
        href="{{ fr_route('users.manage-access', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.manage_access') }}"
        >
        <i class="fas fa-universal-access fa-fw"></i>
    </a>
@endadmin
<!-- end: Btn manage access -->