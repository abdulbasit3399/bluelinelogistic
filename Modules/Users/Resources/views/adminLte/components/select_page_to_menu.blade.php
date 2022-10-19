<div class="accordion-container card mb-5">
    <div class="control-section accordion-section add-page" id="add-page">
        <div class="card-header p-2" tabindex="0">
            <div class="card-title accordion-section-title cursor-pointer">
                <h3 class="ps-0 text">
                    @lang('pages::view.pages')
                </h3>
                <div class="icon px-2">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
        <div class="accordion-section-content card-body">
            <div class="inside">
                <div class="customlinkdiv" id="customlinkdiv">
                    <!--begin::Input group -- Select pages -->
                    <div class="mb-6">
                        <!--begin::Label-->
                        <label class="mb-3 fw-bold fs-6" for="select_pages">@lang('pages::view.select_pages')</label>
                        <!--end::Label-->
    
                        <!--begin::Input group-->
                        <div class="input-content">
                            <select
                                class="form-control  form_select_page"
                                name="pages[]"
                                multiple
                                id="select_pages"
                                data-placeholder="@lang('pages::view.pages_table.choose_page')"
                            >
                            </select>
    
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <div class="button-controls">
                        <button type="button" onclick="addCustomMenuMulti('page')" class="btn btn-sm float-end btn-primary">
                            @lang('menu::view.add_menu_item')
                            <span class="spinner fas fa-circle-notch fa-spin" id="loading_page"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Inject Scripts --}}
@push('js-component')

<script>

		// select pages
		var selectPages = $('.form_select_page');
        selectPages.select2({
            closeOnSelect: false,
            ajax: {
                url: "{{ fr_route('pages.search') }}",
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return { search: params.term };
                },
                processResults: function (data) {
                    if (data && data.pages) {
                        return {
                            results: data.pages.map(function(page) {
                                return {id: page.id, text: page.title}
                            })
                        };
                    }
                },
                cache: true,
            },
        });
        // end select pages
        /*******************************************************************************************/

</script>

@endpush