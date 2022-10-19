<div class="mb-10">
    <!--begin::Label-->
    <label class="form-label fs-5 fw-bold mb-3">{{ __('view.created_at') }}:</label>
    <!--end::Label-->
    <!--begin::Options-->
    <input class="form-control form-control-solid" placeholder="{{ __('view.pick_date_range') }}" id="{{ $table_id }}_created_at_filter"/>
    <!--end::Options-->
</div>



{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}';
            var inputDate = $(`#${table_id}_created_at_filter`);
            var formOptions = $(`#${table_id}_filter_options_form`);
            var dataTableInstance = $(`#${table_id}`).DataTable();
            var start, end;

            // Trigger date picker for created at
            inputDate.daterangepicker({
                showDropdowns: true,
                autoUpdateInput: false,
                ranges: {
                    "{{ __('datepicker.custom_range_titles.yesterday') }}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{ __('datepicker.custom_range_titles.last_7_days') }}": [moment().subtract(6, "days"), moment()],
                    "{{ __('datepicker.custom_range_titles.last_30_days') }}": [moment().subtract(29, "days"), moment()],
                    "{{ __('datepicker.custom_range_titles.this_month') }}": [moment().startOf("month"), moment().endOf("month")],
                    "{{ __('datepicker.custom_range_titles.last_month') }}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                    "{{ __('datepicker.custom_range_titles.this_year') }}": [moment().startOf("year"), moment().endOf("year")],
                    "{{ __('datepicker.custom_range_titles.last_year') }}": [moment().subtract(1, "year").startOf("year"), moment().subtract(1, "year").endOf("year")],
                },
                
                locale: {
                    format: "DD/MM/YYYY",
                    cancelLabel: "{{ __('view.cancel') }}",
                    applyLabel: "{{ __('view.apply') }}",
                    "fromLabel": "{{ __('view.from') }}",
                    "toLabel": "{{ __('view.to') }}",
                    "customRangeLabel": "{{ __('datepicker.custom_range') }}",
                    "weekLabel": "{{ __('datepicker.week_label') }}",
                    "daysOfWeek": [
                        "{{ __('datepicker.days_of_week.sunday') }}",
                        "{{ __('datepicker.days_of_week.monday') }}",
                        "{{ __('datepicker.days_of_week.tuesday') }}",
                        "{{ __('datepicker.days_of_week.wednesday') }}",
                        "{{ __('datepicker.days_of_week.thursday') }}",
                        "{{ __('datepicker.days_of_week.friday') }}",
                        "{{ __('datepicker.days_of_week.saturday') }}",
                    ],
                    "monthNames": [
                        "{{ __('datepicker.month_names.january') }}",
                        "{{ __('datepicker.month_names.february') }}",
                        "{{ __('datepicker.month_names.march') }}",
                        "{{ __('datepicker.month_names.april') }}",
                        "{{ __('datepicker.month_names.may') }}",
                        "{{ __('datepicker.month_names.june') }}",
                        "{{ __('datepicker.month_names.july') }}",
                        "{{ __('datepicker.month_names.august') }}",
                        "{{ __('datepicker.month_names.september') }}",
                        "{{ __('datepicker.month_names.october') }}",
                        "{{ __('datepicker.month_names.november') }}",
                        "{{ __('datepicker.month_names.december') }}",
                    ],
                }
            }, cb);

            // call back after choose date
            function cb(start, end) {
                var startDate = start ? start.format("YYYY-MM-DD") : ''
                var endDate = end ? end.format("YYYY-MM-DD") : ''
                if (startDate) {
                    inputDate.val(startDate + ' / ' + endDate);
                    var menuElement = document.querySelector(`#${table_id}_filter_options`)
                    var menu = KTMenu.getInstance(menuElement);
                    setTimeout(() => {
                        menu.show()
                    })
                }
                // get data by selected date
                dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                    if (!data.filter) {
                        data.filter = {}
                    }
                    data.filter.created_at_start = startDate
                    data.filter.created_at_end = endDate
                })
                // dataTableInstance.ajax.reload()                
            }
            cb(start, end);

            formOptions.on('reset', function(e) {
                dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                    if (data.filter) {
                        data.filter.created_at_start = ''
                        data.filter.created_at_end = ''
                    }
                })
            })
        }, 1000);
    </script>
@endpush