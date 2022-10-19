@php
    $user_role = auth()->user()->role;
    $admin  = 1;
@endphp

<!-- begin: Btn Edit Row -->
@if(auth()->user()->can('edit-areas') || $user_role == $admin)
    <a
        href="{{ fr_route('areas.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endif
<!-- end: Btn Edit Row -->

<!-- begin: Btn Delete Row -->
@if(auth()->user()->can('delete-areas') || $user_role == $admin)
    <button
        type="button"
        data-action="{{ fr_route('areas.destroy', $model->id) }}"
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