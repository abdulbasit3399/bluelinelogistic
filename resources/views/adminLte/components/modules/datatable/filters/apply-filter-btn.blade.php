<button type="button" class="btn btn-primary" data-kt-menu-dismiss="true" id="{{$table_id}}_btn_apply_filter">{{ __('view.apply') }}</button>





{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}';
            var btnApplyFilter = $(`#${table_id}_btn_apply_filter`);
            var dataTableInstance = $(`#${table_id}`).DataTable();

            btnApplyFilter.on('click', function() {
                dataTableInstance.ajax.reload()
            })
        }, 1000);
    </script>
@endpush