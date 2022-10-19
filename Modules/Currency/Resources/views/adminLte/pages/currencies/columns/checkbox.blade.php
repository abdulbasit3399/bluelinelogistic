@if ((isset($ifHide) && !$ifHide) || !isset($ifHide))

    <div class="form-check form-check-sm form-check-custom form-check-solid">
        <input 
            class="form-check-input"
            type="checkbox"
            name="selected-rows[]"
            @if($status) checked @endif
            onchange="update_currency_status(this)"
            data-row-id="{{ $model->id }}"
        >
    </div>

@endif


