@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;
    $client = 4;
    $staff  = 0;
    $driver = 5;
@endphp

<!-- begin: Btn View Shipment Row -->
@if(auth()->user()->can('view-missions') || $user_role == $admin || $user_role == $branch || $user_role == $driver )
    <a
        href="{{ fr_route('missions.show', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('cargo::view.mission') }}"
        >
        <i class="fas fa-eye fa-fw"></i>
    </a>
@endif
<!-- end: Btn View profile Row -->

@if($model->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)

    @if($model->getRawOriginal('type') == Modules\Cargo\Entities\Mission::RETURN_TYPE || $model->getRawOriginal('type') == Modules\Cargo\Entities\Mission::SUPPLY_TYPE)
        <a class="btn btn-success btn-sm" data-url="{{route('admin.missions.action.confirm_amount',['mission_id'=>$model->id])}}" data-action="POST" onclick="openAjexedModel(this,event)" href="#" title="{{__('cargo::view.confirm_mission_done') }}">
            <i class="fa fa-check"></i> {{ __('cargo::view.confirm_mission_done') }}
        </a>
    @elseif($user_role != $driver && $model->getRawOriginal('type') == Modules\Cargo\Entities\Mission::PICKUP_TYPE || $model->getRawOriginal('type') == Modules\Cargo\Entities\Mission::TRANSFER_TYPE)
        <a class="btn btn-success btn-sm" data-url="{{route('admin.missions.action.confirm_amount',['mission_id'=>$model->id])}}" data-action="POST" onclick="openAjexedModel(this,event)" href="#" title="{{__('cargo::view.confirm_mission_done') }}">
            <i class="fa fa-check"></i> {{__('cargo::view.confirm_mission_done') }}
        </a>
    @endif

@endif