

<!-- begin: Btn Manage Row -->
<a
    href="{{ route('roles.edit', $model->id) }}"
    class="btn btn-sm btn-secondary btn-action-table"
    data-toggle="tooltip" title="{{ __('view.manage') }}"
    >
    <i class="fas fa-edit fa-fw"></i>
</a>
<!-- end: Btn Manage Row -->




<!-- begin: Btn Delete Row -->
{{-- 
    data-callback = reload-page, reload-table, delete-row
--}}
<button
    type="button"
    data-action="{{ route('roles.destroy', $model->id) }}"
    data-callback="reload-table"
    data-table-id="{{ isset($table_id) ? $table_id : '' }}"
    data-model-name="{{ __('acl::view.role') }}"
    data-time-alert="2000"
    class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
    data-toggle="tooltip" title="{{ __('view.delete') }}"
>
    <i class="fas fa-trash fa-fw"></i>
</button>
<!-- end: Btn Delete Row -->
