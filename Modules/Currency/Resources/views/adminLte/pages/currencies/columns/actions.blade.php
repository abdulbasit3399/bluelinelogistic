@php
    $user_role = auth()->user()->role;
    $admin  = 1;
@endphp

<!-- begin: Btn Edit Row -->
@if(auth()->user()->can('edit-currencies') || $user_role == $admin)
    <a
        href="{{ fr_route('currencies.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endif
<!-- end: Btn Edit Row -->