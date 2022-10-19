@php
$currentUrl = url()->current();
$checkMenuFound = request()->has('menu')  && !empty(request()->input("menu"));
$menu_places = config_theme("menu_places");
@endphp

<!--begin:: hwpwrap-->
<div id="hwpwrap">
	<!--begin:: nav-menus-php-->
	<div class="nav-menus-php">
		<!--begin:: menu card-->
		<div class="card card-menus">
			<!--begin::Card header-->
			<div class="card-header">
				<!--begin::Card title-->
				<div class="card-title">

					<div class="manage-menuss">
						<form method="get" action="{{ $currentUrl }}" class="d-flex align-items-center flex-wrap">
							<label for="menu" class="selected-menu m-2">@lang('menu::view.select_menu_to_edit')</label>

							@php
								$menulistSelect = '<select name="menu" class="form-select w-150px m2">';
								$menulistSelect .= '<option value="0">' . __('menu::view.select_menu') . '</option>';
									foreach ($menulist as $key => $val) {
										$active = '';
										if (request()->input('menu') == $key) {
											$active = 'selected="selected"';
										}
										if ($key != 0) {
											$menulistSelect .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
										}
									}
								$menulistSelect .= '</select>';
							@endphp
							{!! $menulistSelect !!}
							<span class="submit-btn">
								<input type="submit" class="btn btn-secondary m-2 me-3" value="@lang('view.choose')">
							</span>
							<span class="add-new-menu-action m-2"> @lang('view.or') <a href="{{ $currentUrl }}?action=edit">@lang('menu::view.create_new_menu')</a>. </span>
						</form>
					</div>	

				</div>
				<!--begin::Card title-->
				
			</div>
			<!--end::Card header-->

			<!--begin::Card body-->
			<div class="card-body">
				<div class="row">
					@if($checkMenuFound)
						<div class="col-lg-4">
							<div id="menu-settings-column" class="metabox-holder">
					
								<div class="clear"></div>
					
								{{-- Begin: componentView --}}
								@if (app('hook')->get('menu_addables'))
									@foreach(app('hook')->get('menu_addables') as $componentView)
										{!! $componentView !!}
									@endforeach
								@endif
								{{-- End: componentView --}}
					
								{{-- Begin: Custom link --}}
								<div class="accordion-container card mb-5">
									<div class="control-section accordion-section add-page" id="add-page">
										<div class="card-header p-2" tabindex="0">
											<div class="card-title accordion-section-title cursor-pointer">
												<h3 class="ps-0 text">
													@lang('menu::view.custom_link')
												</h3>
												<div class="icon px-2">
													<i class="fas fa-chevron-down"></i>
												</div>
											</div>
										</div>
										<div class="accordion-section-content card-body">
											<div class="inside">
												<div class="customlinkdiv" id="customlinkdiv">
													<div class="mb-4">
														<label class="required fw-bold fs-7">@lang('menu::view.menus_table.url')</label>
														<input
															id="custom-menu-item-url"
															type="text"
															name="url"
															class="form-control form-control-sm"
															placeholder="https://"
															value="{{ old('url') }}"
														>
													</div>

													<div class="mb-4">
														<label class="required fw-bold fs-7">@lang('menu::view.menus_table.label')</label>
														<div class="input-group lang_container">
															<select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
																<option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
																	{{ get_current_lang()['name'] }}
																</option>
																@foreach(get_langauges_except_current() as $locale)
																	<option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
																		{{ $locale['name'] }}
																	</option>
																@endforeach
															</select>
															<input
																type="text"
																name="label[{{ get_current_lang()['code']}}]"
																data-lang="{{ get_current_lang()['code']}}"
																placeholder="@lang('menu::view.menus_table.label_menu')"
																value="{{ old('label.' . get_current_lang()['code'], isset($model) ? $model->getTranslation('label', get_current_lang()['code']) : '') }}"
																class="custom-menu-item-name add-custom-menu-label form-control form-control-multilingual form-control-{{app()->getLocale()}}  @error('label.' . app()->getLocale()) is-invalid @enderror"
															>
															@error('label.' . get_current_lang()['code'])
																<div class="invalid-feedback">
																	{{ $message }}
																</div>
															@enderror
															@foreach(get_langauges_except_current() as $locale)
																<input
																	type="text"
																	class="custom-menu-item-name add-custom-menu-label form-control  form-control-multilingual form-control-{{$locale['code']}} @error('label.' . $locale['code']) is-invalid @enderror d-none"
																	name="label[{{ $locale['code'] }}]"
																	data-lang="{{ $locale['code'] }}"
																	placeholder="@lang('menu::view.menus_table.label_menu')"
																	value="{{ old('label.' . $locale['code'], isset($model) ? $model->getTranslation('label', $locale['code']) : '') }}"
																>

																@error('label.' . $locale['code'])
																	<div class="invalid-feedback">
																		{{ $message }}
																	</div>
																@enderror
															@endforeach
														</div>
													</div>
			
													<div class="button-controls">
														<button type="button" onclick="addcustommenu()" class="btn btn-sm float-end btn-primary">
															@lang('menu::view.add_menu_item')
															<span class="spinner fas fa-circle-notch fa-spin" id="spincustomu"></span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								{{-- End: Custom link --}}
								
					
							</div>
						</div>
					@endif


					<div class="{{ $checkMenuFound ? 'col-lg-8' : 'col-12' }}">
						<div id="menu-management">
							<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
								<div class="menu-edit">
									<!--begin:: menu-content card-->
									<div class="card card-menu-content">
										<!--begin:: card-header-->
										<div class="card-header">
											<div class="card-title">
												<div id="nav-menu-header">
													<div class="major-publishing-actions">
														<label class="menu-name-label howto open-label" for="menu-name">
															<span class="mx-3">@lang('menu::view.menus_table.name')</span>
															<input
																name="menu-name"
																id="menu-name"
																type="text"
																class="menu-name regular-text menu-item-textbox form-control form-control-sm"
																placeholder="@lang('menu::view.menus_table.menu_name')"
																value="@if(isset($indmenu)){{$indmenu->name}}@endif"
															>
															<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
														</label>
													</div>
												</div>
											</div>
											<div class="card-title">
												@if(request()->has("action"))
													<div class="publishing-action">
														<button type="button" onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary btn-sm menu-save">
															@lang('menu::view.create_menu')
															<span class="spinner fas fa-circle-notch fa-spin" id="spincustomu2"></span>
														</button>
													</div>
												
												@elseif(request()->has("menu"))
													<div class="publishing-action">
														<button type="button" onclick="getmenus()" name="save_menu" id="save_menu_header" class="btn btn-success btn-sm menu-save">
															@lang('menu::view.save_menu')
															<span class="spinner fas fa-circle-notch fa-spin" id="spincustomu2"></span>
														</button>
													</div>
												@else
													<div class="publishing-action">
														<button type="button" onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary btn-sm menu-save">
															@lang('menu::view.create_menu')
															<span class="spinner fas fa-circle-notch fa-spin" id="spincustomu2"></span>
														</button>
													</div>
												@endif
											</div>
										</div>
										<!--end:: card-header-->
										
										<!--begin:: card-body-->
										<div class="card-body">
											<div id="post-body">
												<div id="post-body-content">
					
													@if(request()->has("menu"))
														<h3>
															@lang('menu::view.menu_structure')
														</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																@lang('menu::view.menu_structure_hint')
															</p>
														</div>
													@else
														<h3>
															@lang('menu::view.menu_creation')
														</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																@lang('menu::view.menu_creation_hint')
															</p>
														</div>
													@endif
					
													<ul class="menu ui-sortable flex-column" id="menu-to-edit">
														@if(isset($menus))
															@foreach($menus as $m)
																
																<li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
																	<dl class="menu-item-bar">
																		<dt class="menu-item-handle">
																			<span class="item-title">
																				<span class="menu-item-title">
																					<span id="menutitletemp_{{$m->id}}">{{ isset(json_decode($m->label, true)[app()->getLocale()]) ? json_decode($m->label, true)[app()->getLocale()] : (!is_array(json_decode($m->label, true)) ? json_decode($m->label, true) : '') }}</span>
																					<span style="color: transparent;">|{{$m->id}}|</span>
																				</span>
																				<span class="is-submenu" style="@if($m->depth==0)display: none;@endif">
																					@lang('menu::view.menus_table.sub_element')
																				</span>
																			</span>

																			<span class="item-controls">
																				<span class="item-type">{{ ucfirst($m->type) }}</span> <!-- type here menu type [category, post, link, page] -->
																				<a class="item-edit fas" id="edit-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"></a>
																			</span>
																		</dt>
																	</dl>
							
																	<div class="menu-item-settings p-5" id="menu-item-settings-{{$m->id}}">
																		<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
																		<div class="mb-4">
																			<label for="edit-menu-item-title-{{$m->id}}" class="required fw-bold fs-7">@lang('menu::view.menus_table.label')</label>
																			<div class="input-group lang_container">
																				<select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
																					<option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
																						{{ get_current_lang()['name'] }}
																					</option>
																					@foreach(get_langauges_except_current() as $locale)
																						<option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
																							{{ $locale['name'] }}
																						</option>
																					@endforeach
																				</select>
																				<input
																					name="idlabelmenu_{{$m->id}}"
																					type="text"
																					placeholder="@lang('menu::view.menus_table.label_menu_item')"
																					data-lang="{{ get_current_lang()['code']}}"
																					data-message="@lang('view.saved')"
																					value="{{json_decode($m->label, true)[get_current_lang()['code']] ?? ''}}"
																					class="edit-menu-item-title idlabelmenu_{{$m->id}} custom-menu-item-name form-control form-control-multilingual form-control-{{app()->getLocale()}}  @error('label.' . app()->getLocale()) is-invalid @enderror"
																				>
																				@error('label.' . get_current_lang()['code'])
																					<div class="invalid-feedback">
																						{{ $message }}
																					</div>
																				@enderror
																				@foreach(get_langauges_except_current() as $locale)
																					<input
																						name="idlabelmenu_{{$m->id}}"
																						type="text"
																						placeholder="@lang('menu::view.menus_table.label_menu_item')"
																						data-lang="{{ $locale['code'] }}"
																						data-message="@lang('view.saved')"
																						value="{{json_decode($m->label, true)[$locale['code']] ?? ''}}"
																						class="edit-menu-item-title idlabelmenu_{{$m->id}} custom-menu-item-name form-control  form-control-multilingual form-control-{{$locale['code']}} @error('label.' . $locale['code']) is-invalid @enderror d-none"
																					>

																					@error('label.' . $locale['code'])
																						<div class="invalid-feedback">
																							{{ $message }}
																						</div>
																					@enderror
																				@endforeach
																			</div>
																		</div>
																		<!-- end: label -->


																		<!-- begin: Class CSS (optional) -->
																		<div class="mb-4">
																			<label for="edit-menu-item-classes-{{$m->id}}" class="fw-bold fs-7">@lang('menu::view.menus_table.class_css')</label>
																			<input
																				id="clases_menu_{{$m->id}}"
																				name="clases_menu_{{$m->id}}"
																				type="text"
																				class="form-control form-control-sm widefat code edit-menu-item-classes"
																				placeholder="@lang('menu::view.menus_table.class_css')"
																				value="{{$m->class}}"
																			>
																		</div>
																		<!-- end: Class CSS (optional) -->
						
																		
																		
																		<!-- begin: url -->
																		<div class="mb-4 {{ $m->type != 'link' ? 'd-none' : '' }}">
																			<label for="edit-menu-item-url-{{$m->id}}" class="required fw-bold fs-7">@lang('menu::view.menus_table.url')</label>
																			<input
																				id="url_menu_{{$m->id}}"
																				name="url_menu_{{$m->id}}"
																				type="text"
																				class="form-control form-control-sm widefat code edit-menu-item-url"
																				placeholder="@lang('menu::view.menus_table.url')"
																				value="{{$m->link}}"
																			>
																		</div>
																		<!-- end: url -->

																		@if ($m->type != 'link')
																			<div class="mb-4">
																				<label for="edit-menu-item-url-{{$m->id}}" class="fw-bold fs-7">@lang('menu::view.menus_table.original'): </label>
																				@if($m->type == 'static')
																					<a href="{{ fr_route('home').$m->link }}" target="_blank">
																						{{json_decode($m->label, true)[get_current_lang()['code']] ?? 'salman'}}
																					</a>
																				@else
																					<a href="{{ route($m->type . '-page', ['slug' => $m->link]) }}" target="_blank">
																						{{json_decode($m->label, true)[get_current_lang()['code']] ?? ''}}
																					</a>
																				@endif
																			</div>
																		@endif
																		

						
							
																		<p class="field-move hide-if-no-js description description-wide">
																			<label>
																				<span>@lang('menu::view.menus_table.move')</span>:
																				<a href="{{ $currentUrl }}" class="menus-move-up" style="display: none;">@lang('menu::view.menus_table.move_up')</a>
																				<a href="{{ $currentUrl }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">@lang('menu::view.menus_table.move_down')</a>
																				<a href="{{ $currentUrl }}" class="menus-move-left" style="display: none;"></a>
																				<a href="{{ $currentUrl }}" class="menus-move-right" style="display: none;"></a>
																				<a href="{{ $currentUrl }}" class="menus-move-top" style="display: none;">@lang('menu::view.menus_table.to_top')</a> </label>
																		</p>
							
																		<div class="menu-item-actions description-wide submitbox">
							
																			<button
																				class="btn btn-danger btn-sm btn-action-item"
																				id="delete-{{$m->id}}"
																				onclick="deleteitem('{{$m->id}}')"
																				type="button"
																			>
																				{{-- href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501" --}}
																				@lang('view.delete')
																			</button>
																			
																			<a class="item-cancel hide-if-no-js btn btn-secondary btn-sm btn-action-item" id="cancel-{{$m->id}}">
																				@lang('view.cancel')
																			</a>
																			<button onclick="getmenus()" class="btn btn-success btn-sm btn-action-item" id="update-{{$m->id}}" type="button">
																				@lang('menu::view.update_item')
																			</button>
							
																		</div>
							
																	</div>
																	<ul class="menu-item-transport"></ul>
																</li>
															@endforeach
														@endif
													</ul>
													
													@if ($menu_places && is_array($menu_places) && count($menu_places))
													<div class="menu-settings">
														<div class="menu-places">
															<label class="required fw-bold fs-6 my-4">@lang('menu::view.menus_table.menu_location')</label>
															@foreach ($menu_places as $place)
																<div class="form-check ms-3 mb-3">
																	<input
																		class="menu_location"
																		type="radio"
																		name="menu-place"
																		value="{{ $place }}"
																		id="menu_location_{{ $place }}"
																		{{ isset($indmenu) && $indmenu->place == $place ? 'checked="checked"' : '' }}
																	>
																	<label class="form-check-label" for="menu_location_{{ $place }}">
																		{{ ucfirst($place) }}
																	</label>
																</div>
															@endforeach
														</div>
													</div>
													@endif
												</div>
											</div>
										</div>
										<!--end:: card-body-->

										<!--begin:: card-footer-->
										<div class="card-footer">
											<div id="nav-menu-footer">
												<div class="major-publishing-actions">

													@if(request()->has('action'))
														<div class="publishing-action">
															<button type="button" onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary btn-sm menu-save">
																@lang('menu::view.create_menu')
															</button>
														</div>
													@elseif(request()->has("menu"))
														<span class="delete-action">
															<button type="button" class="submitdelete deletion menu-delete btn btn-danger btn-sm" onclick="deletemenu()" href="javascript:void(9)">
																@lang('menu::view.delete_menu')
															</button>
														</span>

														<div class="publishing-action">
															<button type="button" onclick="getmenus()" name="save_menu" id="save_menu_header" class="btn btn-success btn-sm menu-save">
																@lang('menu::view.save_menu')
																<span class="spinner fas fa-circle-notch fa-spin" id="spincustomu2"></span>
															</button>
														</div>
													@else
														<div class="publishing-action">
															<button type="button" onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary btn-sm menu-save">
																@lang('menu::view.create_menu')
															</button>
														</div>
													@endif
												</div>
											</div>
										</div>
										<!--end:: card-footer-->
									</div>
									<!--end:: menu-content card-->
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
			<!--end::Card body-->

		</div>
		<!--end:: menu card-->
	</div>
	<!--end:: nav-menus-php-->
</div>
<!--end:: hwpwrap-->



{{-- Inject Scripts --}}
{{-- @push('js-component')

<script>

		// select categories
		var selectCategories = $('.select_categories');
        selectCategories.select2({
            closeOnSelect: false,
            ajax: {
                url: "{{ route('categories.search') }}",
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

@endpush --}}