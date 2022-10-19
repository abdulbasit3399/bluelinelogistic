@if ((isset($ifHide) && !$ifHide) || !isset($ifHide))

    <div class="form-check form-check-sm form-check-custom form-check-solid">
        <input 
            class="form-check-input checkbox-row"
            type="checkbox"
            name="selected-rows[]"
            data-row-id="{{ $model->id }}"
            data-row-client-id="{{ $model->client_id ?? '' }}"
            data-row-client-address-name="{{ $model->from_address->address ?? '' }}"
            data-row-branch-id="{{ $model->branch_id ?? '' }}"
            data-row-branch-name="{{ $model->branch->name ?? '' }}"
            data-row-payment-method="{{ $model->branch->payment_method_id ?? '' }}"
            data-row-reciver-address="{{ $model->reciver_address ?? '' }}"
            data-row-reciver-name="{{ $model->reciver_name ?? '' }}"
            data-row-to-state-name="{{ $model->to_state->name ?? '' }}"
            data-row-to-state-id="{{ $model->to_state_id ?? '' }}"
            data-row-to-area-name="{{ $model->to_area->name ?? '' }}"
            data-row-to-area-id="{{ $model->to_area_id ?? '' }}"
            data-row-mission-id="{{ $model->mission_id ?? '' }}"
        >
    </div>

@endif
<input 

