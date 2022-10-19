
<div class="d-flex justify-content-end align-items-center d-none" id="{{ $table_id }}_selected_component">

    <div class="fw-bolder me-5"><span class="me-2 selected-count">0</span>{{ __('view.selected') }}</div>

    @if ((isset($permission) && auth()->user()->can($permission)) || !isset($permission))
        {{-- 
            data-callback = reload-page, reload-table, delete-row
        --}}
        <button 
            type="button"
            data-action="{{ $url }}"
            data-callback="{{ $callback ?? 'reload-table' }}"
            data-table-id="{{ isset($table_id) ? $table_id : '' }}"
            data-model-name="{{ $model_name }}"
            data-modal-action="@lang('view.delete')"
            data-modal-message="@lang('view.modal_message_delete')"
            data-time-alert="2000"
            data-multi-delete="true"
            class="delete-row btn btn-danger btn-delete-selected me-2"
        >
            @lang('view.delete_selected')
        </button>
    @endif

    @yield('more-actions')
</div>




{{-- Inject Scripts --}}
@push('js-component')
<script>
    // reset title checkbox all items
    setTimeout(function() {
        $('#{{ $table_id }}_wrapper .checkbox-all-rows').attr('title', 'Select items')
    }, 1000)

    function checkSelected() {
        var selected = [],
            table = $('#{{ $table_id }}');
        table.find('.checkbox-row').each(function (i, e) {
            if ($(this)[0].checked) {
                selected.push(i)
            }
        })
        return selected.length == table.find('.checkbox-row').length;
    }

    function checkSelectedOneAtleast() {
        var table = $('#{{ $table_id }}');
        return table.find('.checkbox-row').is(':checked');
    }

    function toggleShowActions() {
        var actions = $('#{{ $table_id }}_selected_component'),
            filter = $('#{{ $table_id }}_custom_filter'),
            checkboxAllRows = $('#{{ $table_id }}_wrapper .checkbox-all-rows');

        setTimeout(() => {
            if (checkSelected()) {
                checkboxAllRows.prop('checked', true)
            } else {
                checkboxAllRows.prop('checked', false)
            }
            
            if (checkSelectedOneAtleast()) {
                actions.removeClass('d-none')
                filter.addClass('d-none')
            } else {
                actions.addClass('d-none')
                filter.removeClass('d-none')
            }
        });
    }

    // choose all rows
    $('body').on('change', '#{{ $table_id }}_wrapper .checkbox-all-rows', function(e) {
        var table = $('#{{ $table_id }}'),
            checkboxAllRows = $(this),
            selectedAll = checkboxAllRows[0].checked,
            checkBoxRowsNotSelected = table.find('.checkbox-row:not(:checked)'),
            checkBoxRowsSelected = table.find('.checkbox-row:checked'),
            checkBoxRowsAll = table.find('.checkbox-row');

        if (selectedAll) {
            // toggle not seleced only
            checkBoxRowsNotSelected.click()
        } else {
            // toggle selected only
            checkBoxRowsSelected.click();
        }
    });
    
    // choose one row
    $('body').on('change', '.checkbox-row', function(e) {
        toggleShowActions();
        setTimeout(() => {
            var actions = $('#{{ $table_id }}_selected_component'),
                selectedCount = actions.find('.selected-count')
                table = $('#{{ $table_id }}'),
                checkBoxSeleced = table.find('.checkbox-row:checked'),
                btnDelete = actions.find('.delete-row')
                idsSelected = []
            // add count selected to html
            selectedCount.text(checkBoxSeleced.length)
            // get all ids selected
            checkBoxSeleced.each(function(e, ele) {
                var id = $(ele).data('row-id')
                idsSelected.push(id)
            })
            // add ids to btn data to passing modal deleting in js
            btnDelete.attr('data-request-data', JSON.stringify(idsSelected))
            actions.attr('data-request-data', JSON.stringify(idsSelected))
        });
    });


</script>
@endpush