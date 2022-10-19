@csrf

<!--begin::Input group --- countries group -->
<div class="row mb-6">
    @php
        $user_role = auth()->user()->role;
        $admin  = 1;
    @endphp
    <div class="col-xl-12 col-md-6 mb-6">
        <div class="card shadow card-permissions">
            <div class="card-header">
                <div class="group-name">
                {{ $form_title }}
                </div>
                <div class="select-all">
                    <div class="custom-control custom-switch form-check form-switch">
                        <input
                            class="custom-control-input form-check-input select-all-groups"
                            type="checkbox"
                            id="all_items"
                            >
                        <label class="custom-control-label" for="all_items">{{ __('view.select_all') }}</label>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="view-permissions">
                    <div class="row">
                        @foreach($items as $item)
                            <div class="col-md-3">
                                <div class="permission-checkbox mb-3">
                                    <div class="custom-control custom-switch form-check form-switch">
                                        <input
                                            class="custom-control-input form-check-input select-single-permission"
                                            name="covered_items[]"
                                            type="checkbox"
                                            id="check_box_item{{ $item->name }}"
                                            value="{{ $item->id }}"
                                            @if($item->covered == 1) checked @endif
                                        >
                                        <label
                                            class="custom-control-label"
                                            for="check_box_item{{ $item->name }}"
                                        >
                                            {{ str_replace('-', ' ', $item->name) }}
                                        </label>
                                        @if(auth()->user()->can('add-covered-regions') || $user_role == $admin )
                                            @if($typeForm == 'country')
                                                @if($item->covered == 1)
                                                    <a href="{{route('countries.covered_states',['country_id'=>$item->id])}}">{{ __('cargo::view.add_covered_regions') }}</a>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Input group --- permissions group -->



@section('styles')
    <link href="{{ asset('assets/custom/css/acl.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
    <script>
        if($('.select-single-permission:checked').length == $('.select-single-permission').length){
            $('.select-all-groups').prop('checked', true);
        }
    </script>
@endsection


