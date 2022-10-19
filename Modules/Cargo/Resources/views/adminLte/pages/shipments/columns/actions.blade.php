@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
    $client = 4;
    $staff  = 0;
@endphp

<!-- begin: Btn View Shipment Row -->
@if(auth()->user()->can('view-shipments') || $user_role == $admin || $user_role == $branch || $user_role == $client )
    <a
        href="{{ fr_route('shipments.show', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('catgo::view.shipment') }}"
        >
        <i class="fas fa-eye fa-fw"></i>
    </a>
@endif
<!-- end: Btn View profile Row -->

<!-- begin: Btn Edit Row -->
@if(auth()->user()->can('edit-shipments') || $user_role == $admin || $user_role == $branch || $user_role == $client)
    <a
        href="{{ fr_route('shipments.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endif
<!-- end: Btn Edit Row -->