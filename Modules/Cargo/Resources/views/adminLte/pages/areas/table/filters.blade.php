@if (in_array('state_id', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.choose_region') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select
                class="form-control  @error('state_id') is-invalid @enderror"
                name="state_id"
                data-control="select2"
                data-placeholder="{{ __('cargo::view.choose_region') }}"
                data-allow-clear="true"
            >
                <option></option>
                @php $states = Modules\Cargo\Entities\State::where('covered',1)->get(); @endphp
                @foreach($states as $state)
                    <option value="{{ $state->id }}" 
                        {{ old('state_id') == $state->id ? 'selected' : '' }}
                    >{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
        <!--end::Options-->
    </div>

    {{-- Inject Scripts --}}
    @push('js-component')
        <script>
            $(window).on('load', function() {
                setTimeout(() => {
                    var table_id = '{{ $table_id }}';
                    var roleCheckbox = $(`[name="state_id"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);
                    
                    roleCheckbox.on('change', function (e) {
                        var value = $(this).val(),
                            roles = [],
                            roleCheckboxChecked = roleCheckbox.filter(':checked')

                        // get multi roles
                        roleCheckboxChecked.each(function (i) {
                            roles.push($(this).val())
                        })
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.role = roles
                        })
                        // dataTableInstance.ajax.reload()
                    })

                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (data.filter) {
                                data.filter.role = ''
                            }
                        })
                        dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush

@endif