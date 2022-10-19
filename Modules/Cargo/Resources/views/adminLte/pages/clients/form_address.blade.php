@csrf

@php
$user_role = auth()->user()->role;
$admin = 1;

$is_def_mile_or_fees = Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees');

$googleSettings = resolve(\app\Models\GoogleSettings::class)->toArray();
$googleMap = json_decode($googleSettings['google_map'], true);
$google_map_key = '';
if ($googleMap) {
    $google_map_key = $googleMap['google_map_key'];
}

$countries = Modules\Cargo\Entities\Country::where('covered', 1)->get();
@endphp



<div class="form-group" id="kt_repeater_1">
    <div data-repeater-list="address">
        @if ($typeForm == 'create')
            <div data-repeater-item class="data-repeater-item-count">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
                            <select name="country_id"class="change-country-client-address form-control select-country @error('address.*.country_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('address.*.country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.region') }}</label>
                            <select name="state_id"
                                class="change-state-client-address form-control select-state @error('address.*.state_id') is-invalid @enderror">
                                <option value=""></option>

                            </select>
                            @error('address.*.state_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.area') }}</label>
                            <select name="area_id" style="display: block !important;"
                                class="change-area-client-address form-control select-area @error('address.*.area_id') is-invalid @enderror">
                                <option value=""></option>

                            </select>
                            @error('address.*.area_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.address') }}</label>
                    <input type="text" placeholder="{{ __('cargo::view.address') }}" name="address"
                        class="form-control @error('address') is-invalid @enderror" />
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if ($googleMap)
                    <div class="mt-2 location-client">
                        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
                        <input type="text" class="form-control address address-client "
                            placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"
                            rel="client" value="" />
                        <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
                        <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
                        <input type="hidden" class="form-control url" data-client="url" name="client_url" />

                        <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
                        <span class="form-text text-muted">{{ 'Change the pin to select the right location' }}</span>
                    </div>
                @endif


            </div>

        @elseif($typeForm == 'edit')
            @if ($model)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label
                                class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
                            <select name="country_id"
                                class="change-country-client-address form-control select-country @error('country_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if ($country->id == $model->country_id) selected @endif>{{ $country->name }}
                                    </option>
                                    @php
                                        if ($country->id == $model->country_id) {
                                            $states = Modules\Cargo\Entities\State::where('country_id', $model->country_id)->get();
                                        }
                                    @endphp
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label
                                class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.region') }}</label>
                            <select name="state_id"
                                class="change-state-client-address form-control select-state @error('state_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        @if ($state->id == $model->state_id) selected @endif>{{ $state->name }}</option>
                                    @php
                                        if ($state->id == $model->state_id) {
                                            $areas = Modules\Cargo\Entities\Area::where('state_id', $model->state_id)->get();
                                        }
                                    @endphp
                                @endforeach

                            </select>
                            @error('state_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.area') }}</label>
                            <select name="area_id" style="display: block !important;"
                                class="change-area-client-address form-control select-area @error('area_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        @if ($area->id == $model->area_id) selected @endif>
                                        {{ json_decode($area->name, true)[app()->getLocale()] }}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.address') }}</label>
                    <input value="{{ $model->address }}" type="text" placeholder="{{ __('cargo::view.address') }}"
                        name="address" class="form-control @error('address') is-invalid @enderror" />
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if ($googleMap)
                    <div class="mt-2 location-client location-client-{{ $model->id }}">
                        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
                        <input type="text" value="{{ $model->client_street_address_map }}"
                            class="form-control address address-client-{{ $model->id }} "
                            placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"
                            rel="client" />
                        <input type="hidden" value="{{ $model->client_lat }}" class="form-control lat"
                            data-client="lat" name="client_lat" />
                        <input type="hidden" value="{{ $model->client_lng }}" class="form-control lng"
                            data-client="lng" name="client_lng" />
                        <input type="hidden" value="{{ $model->client_url }}" class="form-control url"
                            data-client="url" name="client_url" />

                        <div class="mt-2 col-sm-12 map_canvas map_canvas_{{ $model->id }} map-client map-client_{{ $model->id }}"
                            style="width:100%;height:300px;"></div>
                        <span class="form-text text-muted">{{ 'Change the pin to select the right location' }}</span>
                    </div>
                @endif
            @endif
        @endif
    </div>


    @if ($typeForm == 'create')
    <div class="form-group row">
        <div class="col-md-12">
            <div>
                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                    <i class="la la-plus"></i>{{ __('cargo::view.add_new_address') }}
                </a>
            </div>
        </div>
    </div>
    @endif



    <input type="hidden" name="client_id" value="{{ $client->id }}">
</div>






{{-- Inject styles --}}
@section('styles')
    <style>
        label {
            font-weight: bold !important;
        }

        .card-header {
            display: flex !important;
            align-items: center !important;
        }

    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"
        integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"
        integrity="sha512-0hFHNPMD0WpvGGNbOaTXP0pTO9NkUeVSqW5uFG2f5F9nKyDuHE3T4xnfKhAhnAZWZIO/gBLacwVvxxq0HuZNqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.js"
        integrity="sha512-k59zBVzm+v8h8BmbntzgQeJbRVBK6AL1doDblD1pSZ50rwUwQmC/qMLZ92/8PcbHWpWYeFaf9hCICWXaiMYVRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/global/js/jquery.geocomplete.js') }}"></script>
    <script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{ $google_map_key }}"></script>
    <script>
        var typeForm = '{{ $typeForm }}';
        if (typeForm == 'edit') {
            @if (isset($model))
                $('.address-client-{{ $model->id }}').each(function(){
                var address = $(this);
                var lat = '{{ $model->client_lat }}';
                lat = parseFloat(lat);
                var lng = '{{ $model->client_lng }}';
                lng = parseFloat(lng);

                address.geocomplete({
                map: ".map_canvas_{{ $model->id }}.map-client_{{ $model->id }}",
                mapOptions: {
                zoom: 8,
                center: { lat: lat, lng: lng },

                },
                markerOptions: {
                draggable: true
                },
                details: ".location-client-{{ $model->id }}",
                detailsAttribute: 'data-client',
                autoselect: true,
                restoreValueAfterBlur: true,
                });
                address.bind("geocode:dragged", function(event, latLng){
                $("input[data-client=lat]").val(latLng.lat());
                $("input[data-client=lng]").val(latLng.lng());
                });
                });
            @endif
        } else {
            $('.address-client').each(function() {
                var address = $(this);
                address.geocomplete({
                    map: ".map_canvas.map-client",
                    mapOptions: {
                        zoom: 8,
                        center: {
                            lat: -34.397,
                            lng: 150.644
                        },
                    },
                    markerOptions: {
                        draggable: true
                    },
                    details: ".location-client",
                    detailsAttribute: 'data-client',
                    autoselect: true,
                    restoreValueAfterBlur: true,
                });
                address.bind("geocode:dragged", function(event, latLng) {
                    $("input[data-client=lat]").val(latLng.lat());
                    $("input[data-client=lng]").val(latLng.lng());
                });
            });
        }
        //Address Types Repeater
        $('#kt_repeater_1').repeater({
            initEmpty: false,

            show: function() {
                var repeater_item = $(this);
                @if ($googleMap)
                    var map_canvas = repeater_item.find(".map_canvas.map-client");
                    var map_data = repeater_item.find(".location-client");
                    repeater_item.find(".address").geocomplete({
                    map: map_canvas,
                    mapOptions: {
                    zoom: 18,
                    center: { lat: -34.397, lng: 150.644 },
                    },
                    markerOptions: {
                    draggable: true
                    },
                    details: map_data,
                    detailsAttribute: "data-client",
                    autoselect: true,
                    restoreValueAfterBlur: true,
                    });
                    repeater_item.find(".address").bind("geocode:dragged", function(event, latLng){
                    repeater_item.find("input[data-client=lat]").val(latLng.lat());
                    repeater_item.find("input[data-client=lng]").val(latLng.lng());
                    });
                @endif


                $(this).slideDown();

                changeCountry();
                changeState();
                selectPlaceholder();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            isFirstItemUndeletable: true
        });

        function changeCountry() {
            $('.change-country-client-address').change(function() {
                var id = $(this).parent().find(".change-country-client-address").val();
                var row = $(this).closest(".row");
                var state_input = row.find(".change-state-client-address");
                var state_name = state_input.attr("name");

                $.get("{{ route('ajax.getStates') }}?country_id=" + id, function(data) {
                    $('select[name ="' + state_name + '"]').empty();
                    $('select[name ="' + state_name + '"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="' + state_name + '"]').append('<option value="' + element['id'] +
                            '">' + element['name'] + '</option>');
                    }
                });
            });
        }
        changeCountry();

        function changeState() {
            $('.change-state-client-address').change(function() {

                var id = $(this).parent().find(".change-state-client-address").val();
                var row = $(this).closest(".row");
                var area_input = row.find(".change-area-client-address");
                var area_name = area_input.attr("name");
                console.log(area_name);
                $.get("{{ route('ajax.getAreas') }}?state_id=" + id, function(data) {
                    $('select[name ="' + area_name + '"]').empty();
                    $('select[name ="' + area_name + '"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="' + area_name + '"]').append('<option value="' + element['id'] +
                            '">' + JSON.parse(element['name'], true)[`{{ app()->getLocale() }}`] +
                            '</option>');
                    }
                });
            });
        }
        changeState();

        function selectPlaceholder() {
            $('.select-country').select2({
                placeholder: "{{ __('cargo::view.choose_country') }}",
                width: '100%'
            })
            @if (auth()->user()->can('add-covered-countries') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('countries.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.covered_countries') }}</a>
                </li>`);
                });
            @endif

            $('.select-state').select2({
                placeholder: "{{ __('cargo::view.choose_region') }}",
                width: '100%'
            })
            @if (auth()->user()->can('add-covered-regions') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('countries.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.covered_regions') }}</a>
                </li>`);
                });
            @endif

            $('.select-area').select2({
                placeholder: "{{ __('cargo::view.choose_area') }}",
                width: '100%'
            })
            @if (auth()->user()->can('manage-areas') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('areas.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.areas') }}</a>
                </li>`);
                });
            @endif
        }
        selectPlaceholder();

        $('#check').click(function() {
            const type = $('#password').attr('type') === 'password' ? 'text' : 'password';
            $('#password').prop('type', type);
        });
    </script>
@endsection
