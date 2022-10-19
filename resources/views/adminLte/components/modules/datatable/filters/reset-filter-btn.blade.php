<button type="reset" class="btn btn-light btn-active-light-primary me-2" id="{{$table_id}}_btn_reset_filter" data-kt-menu-dismiss="true">{{ __('view.reset') }}</button>



{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}';
            var btnResetFilter = $(`#${table_id}_btn_reset_filter`);
            var dataTableInstance = $(`#${table_id}`).DataTable();

            btnResetFilter.on('click', function() {
                setTimeout(() => {
                    dataTableInstance.ajax.reload()
                })
            })
        }, 1000);
    </script>
@endpush