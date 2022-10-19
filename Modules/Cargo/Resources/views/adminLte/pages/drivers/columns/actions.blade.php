@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
@endphp

@if(auth()->user()->can('view-drivers') || $user_role == $admin || $user_role == $branch)
    <a
        href="{{ fr_route('drivers.show', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.view_profile') }}"
        >
        <i class="fas fa-eye fa-fw"></i>
    </a>
@endif

<!-- begin: Btn Edit Row -->
@if(auth()->user()->can('edit-drivers') || $user_role == $admin || $user_role == $branch )
    <a
        href="{{ fr_route('drivers.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endif
<!-- end: Btn Edit Row -->

<!-- begin: Btn Delete Row -->
@if(auth()->user()->can('delete-drivers') || $user_role == $admin || $user_role == $branch )
    <button
        type="button"
        data-action="{{ fr_route('drivers.destroy', $model->id) }}"
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
@endif


<!-- end: Btn Delete Row -->