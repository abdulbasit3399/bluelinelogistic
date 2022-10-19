<div class="accordion-container card mb-5">
    <div class="control-section accordion-section add-page" id="add-page">
        <div class="card-header p-2" tabindex="0">
            <div class="card-title accordion-section-title cursor-pointer">
                <h3 class="ps-0 text">
                    @lang('blog::view.posts')
                </h3>
                <div class="icon px-2">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
        <div class="accordion-section-content card-body">
            <div class="inside">
                <div class="customlinkdiv" id="customlinkdiv">
                    <!--begin::Input group -- Select posts -->
                    <div class="mb-6">
                        <!--begin::Label-->
                        <label class="mb-3 fw-bold fs-6" for="select_posts">@lang('blog::view.select_posts')</label>
                        <!--end::Label-->
    
                        <!--begin::Input group-->
                        <div class="input-content">
                            <select class="form-control form_select_post" name="posts[]" multiple id="select_posts" data-placeholder="@lang('blog::view.posts_table.choose_post')" ></select>
    
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <div class="button-controls">
                        <button type="button" onclick="addCustomMenuMulti('post')" class="btn btn-sm float-end btn-primary">
                            @lang('menu::view.add_menu_item')
                            <span class="spinner fas fa-circle-notch fa-spin" id="loading_post"></span>
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

		// select posts
		var selectPosts = $('.form_select_post');
        selectPosts.select2({
            closeOnSelect: false,
            ajax: {
                url: "{{ fr_route('posts.search') }}",
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return { search: params.term };
                },
                processResults: function (data) {
                    if (data && data.posts) {
                        return {
                            results: data.posts.map(function(post) {
                                return {id: post.id, text: post.title}
                            })
                        };
                    }
                },
                cache: true,
            },
        });
        // end select posts
        /*******************************************************************************************/

</script>

@endpush