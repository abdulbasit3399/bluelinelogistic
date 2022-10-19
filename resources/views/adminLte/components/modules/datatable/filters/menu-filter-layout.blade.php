@php
    $table_id = $attributes->get('table_id');
    $filters = $attributes->get('filters');
@endphp

<button type="button" class="btn btn-light-primary m-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
    {{ __('view.filter') }}
</button>
<!--begin::Menu 1-->


    


<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="{{$table_id}}_filter_options">
    <form id="{{$table_id}}_filter_options_form">
        <!--begin::Header-->
        <div class="px-7 py-5">
            <div class="fs-4 text-dark fw-bolder">{{ __('view.filter_options') }}</div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator border-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Content-->
        <div class="px-7 py-5">
            <!--begin::Input group-->
            {{-- <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label fs-5 fw-bold mb-3">Month:</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                    <option></option>
                    <option value="aug">August</option>
                    <option value="sep">September</option>
                    <option value="oct">October</option>
                    <option value="nov">November</option>
                    <option value="dec">December</option>
                </select>
                <!--end::Input-->
            </div> --}}
            <!--end::Input group-->



            {{-- Start Global Filters --}}

            <!-- ================== begin created_at filter =============================== -->
            @if (in_array('created_at', $filters))
                @include('adminLte.components.modules.datatable.filters.created_at', ['table_id' => $table_id])
            @endif
            <!-- ================== end created_at filter =============================== -->

            {{-- End Global Filters --}}


            {{-- Start Scope Filters --}}

            {{ $slot }}

            {{-- End Scope Filters --}}

            <!--begin::Actions-->
            <div class="d-flex justify-content-end">
                {{-- btn reset filter table --}}
                @include('adminLte.components.modules.datatable.filters.reset-filter-btn', ['table_id' => $table_id])

                {{-- btn apply filter table --}}
                @include('adminLte.components.modules.datatable.filters.apply-filter-btn', ['table_id' => $table_id])
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Content-->
    </form>
</div>
<!--end::Menu 1-->
