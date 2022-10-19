@if ((isset($ifHide) && !$ifHide) || !isset($ifHide))

    <div class="form-check form-check-sm form-check-custom form-check-solid">
        <input 
            class="form-check-input checkbox-row"
            type="checkbox"
            name="selected-rows[]"
            data-row-id="{{ $model->id }}"
        >
    </div>

@endif
