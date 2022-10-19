<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "@lang('menu::view.menus_table.move_up')",
		"moveDown" : "@lang('menu::view.menus_table.move_down')",
		"moveToTop" : "@lang('menu::view.menus_table.to_top')",
		"moveUnder" : "@lang('menu::view.menus_table.move_under') %s",
		"moveOutFrom" : "@lang('menu::view.menus_table.move_out_from')  %s",
		"under" : "@lang('menu::view.menus_table.under') %s",
		"outFrom" : "@lang('menu::view.menus_table.out_from') %s",
		"menuFocus" : "%1$s. @lang('menu::view.menus_table.element_menu') %2$d @lang('menu::view.menus_table.menu_of') %3$d.",
		"subMenuFocus" : "%1$s. @lang('menu::view.menus_table.menu_of_subelement') %2$d @lang('menu::view.menus_table.menu_of') %3$s."
	};
	var arraydata = [];     
	var addcustommenur = '{{ route("haddcustommenu") }}';
	var addCustomMenuMultiUrl = '{{ route("menu_items.create") }}';
	var updateitemr = '{{ route("hupdateitem")}}';
	var generatemenucontrolr = '{{ route("menu_items.updae") }}';
	var deleteitemmenur = '{{ route("hdeleteitemmenu") }}';
	var deletemenugr = '{{ route("hdeletemenug") }}';
	// var createnewmenur = '{{ route("hcreatenewmenu") }}';
	var createnewmenur = '{{ route("menus.create") }}';
	var csrftoken ="{{ csrf_token() }}";
	var menuwr = "{{ url()->current() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/menu.js')}}"></script>