<div class="accordion-container card mb-5">
    <div class="control-section accordion-section add-page" id="add-page">
        <div class="card-header p-2" tabindex="0">
            <div class="card-title accordion-section-title cursor-pointer">
                <h3 class="ps-0 text">
                    @lang('blog::view.categories')
                </h3>
                <div class="icon px-2">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
        <div class="accordion-section-content card-body">
            <div class="inside">
                <div class="customlinkdiv" id="customlinkdiv">
                    <!--begin::Input group -- Select categories -->
                    <div class="mb-6">
                        <!--begin::Label-->
                        <label class="mb-3 fw-bold fs-6" for="select_categories">@lang('blog::view.select_categories')</label>
                        <!--end::Label-->
    
                        <!--begin::Input group-->
                        <div class="input-content">
                            <select
                                class="form-control form_select_category"
                                name="categories[]"
                                multiple
                                id="select_categories"
                                data-placeholder="@lang('blog::view.categories_table.choose_category')"
                            >
                            </select>
    
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <div class="button-controls">
                        <button type="button" onclick="addCustomMenuMulti('category')" class="btn btn-sm float-end btn-primary">
                            @lang('menu::view.add_menu_item')
                            <span class="spinner fas fa-circle-notch fa-spin" id="loading_category"></span>
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

		// select categories
		var selectCategories = $('.form_select_category');
        selectCategories.select2({
            closeOnSelect: false,
            ajax: {
                url: "{{ fr_route('categories.search') }}",
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return { search: params.term };
                },
                processResults: function (data) {
                    if (data && data.categories) {
                        return {
                            results: data.categories.map(function(category) {
                                return {id: category.id, text: category.name}
                            })
                        };
                    }
                },
                cache: true,
            },
        });
        // end select categories
        /*******************************************************************************************/

</script>

@endpush