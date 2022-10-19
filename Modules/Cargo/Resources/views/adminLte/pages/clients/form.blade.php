@csrf

@php
    $user_role = auth()->user()->role;
    $admin  = 1;

    $is_def_mile_or_fees = Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees');

    $googleSettings = resolve(\app\Models\GoogleSettings::class)->toArray();
    $googleMap = json_decode($googleSettings['google_map'], true);
    $google_map_key = '';
    if($googleMap){
        $google_map_key = $googleMap['google_map_key'];
    }

    $countries = Modules\Cargo\Entities\Country::where('covered',1)->get();
@endphp

<!--begin::Col Avatar -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.avatar') }}</label>
    <!--end::Label-->
    <div class="col-md-12">
        <!--begin::Image input-->
        @if(isset($model))
            <x-media-library-collection max-items="1" name="image" :model="$model" collection="avatar" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @else
            <x-media-library-attachment name="image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @endif
        <!--end::Image input-->

        @error('avatar')
            <div class="is-invalid"></div>
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
</div>
<!--end::Col-->


<!--begin::Input group --  Full name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.full_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('cargo::view.table.full_name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Email -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.email') }}</label>
    <!--end::Label-->
    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('cargo::view.table.email') }}" value="{{ old('email', isset($model) ? $model->email : '') }}" />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->


<div class="row mb-6">

    <!--begin::Input group --  Password -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 @if($typeForm == 'create') required @endif">{{ __('cargo::view.table.password') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="password" id="password" name="password" class="form-control form-control-lg has-feedback @error('password') is-invalid @enderror" placeholder="{{ __('cargo::view.table.password') }}" value="{{ old('password', isset($model) ? $model->password : '') }}" />
            <i id="check" class="far fa-eye" id="togglePassword" style="cursor: pointer;position: absolute;right: 0;padding: 3%;font-size: 16px;"></i>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group --  National Id -->
    <!--begin::Input group-->
    {{-- <div class="col-lg-6 fv-row">
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_national_id') }}</label>
        <div class="input-group mb-4">
            <input type="text" name="national_id" class="form-control form-control-lg @error('national_id') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_national_id') }}" value="{{ old('national_id', isset($model) ? $model->national_id : '') }}" />
            @error('national_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}
    <!--end::Input group-->
</div>
<!--end::Input group-->

<div class="row mb-6">

    <!--begin::Input group --  Owner Name -->
    <!--begin::Input group-->
    {{-- <div class="col-lg-6 fv-row">
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_name') }}</label>
        <div class="input-group mb-4">
            <input type="text" name="responsible_name" class="form-control form-control-lg @error('responsible_name') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_name') }}" value="{{ old('responsible_name', isset($model) ? $model->responsible_name : '') }}" />
            @error('responsible_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}
    <!--end::Input group-->


    <!--begin::Input group --  Owner Phone -->
    <!--begin::Input group-->
    {{-- <div class="col-lg-6 fv-row">
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_phone') }}</label>
        <div class="input-group mb-4">
            <input type="text" name="responsible_mobile" class="form-control form-control-lg @error('responsible_mobile') is-invalid @enderror" placeholder="{{ __('cargo::view.table.owner_phone') }}" value="{{ old('responsible_mobile', isset($model) ? $model->responsible_mobile : '') }}" />
            @error('responsible_mobile')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}
    <!--end::Input group-->
</div>
<!--end::Input group-->

<div class="row mb-6">

    <!--begin::Input group --  follow_up_name -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.follow_up_name') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="follow_up_name" class="form-control form-control-lg @error('follow_up_name') is-invalid @enderror" placeholder="{{ __('cargo::view.table.follow_up_name') }}" value="{{ old('follow_up_name', isset($model) ? $model->follow_up_name : '') }}" />
            @error('follow_up_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group --  follow_up_mobile -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.follow_up_mobile') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="follow_up_mobile" class="form-control form-control-lg @error('follow_up_mobile') is-invalid @enderror" placeholder="{{ __('cargo::view.table.follow_up_mobile') }}" value="{{ old('follow_up_mobile', isset($model) ? $model->follow_up_mobile : '') }}" />
            @error('follow_up_mobile')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- Branch -->
{{--  <div class="row mb-6">

    <!--begin::Input group-->
    <div class="fv-row col-lg-12 form-group">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.branch') }}</label>
        <!--end::Label-->
        <select
            class="form-control  @error('branch_id') is-invalid @enderror"
            name="branch_id"
            data-control="select2"
            data-placeholder="{{ __('cargo::view.table.choose_branch') }}"
            data-allow-clear="true"
        >
            <option></option>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}"
                    {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                    @if($typeForm == 'edit')
                        {{ $model->branch_id == $branch->id ? 'selected' : '' }}
                    @endif
                >{{ $branch->name }}</option>
            @endforeach
        </select>
        @error('branch_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!--end::Input group-->
</div>  --}}
<!--end::Input group-->

{{--  <div class="form-group" id="kt_repeater_1">
    <div data-repeater-list="address">
        @if($typeForm == 'create')
            <div data-repeater-item class="data-repeater-item-count">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
                            <select name="country_id" class="change-country-client-address form-control select-country @error('country_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.region') }}</label>
                            <select @error('state_id') is-invalid @enderror name="state_id" class="change-state-client-address form-control select-state">
                                <option value=""></option>

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
                            <select @error('area_id') is-invalid @enderror name="area_id" style="display: block !important;" class="change-area-client-address form-control select-area">
                                <option value=""></option>

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
                    <input @error('address') is-invalid @enderror type="text" placeholder="{{ __('cargo::view.address') }}" name="address" class="form-control" />
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if($googleMap)
                    <div class="mt-2 location-client">
                        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
                        <input type="text" class="form-control address address-client " placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"  rel="client" value="" />
                        <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
                        <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
                        <input type="hidden" class="form-control url" data-client="url" name="client_url" />

                        <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
                        <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                    </div>
                @endif

                <div class="mt-3 mb-3 row">
                    <div class="col-md-12">
                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
                            <i class="la la-trash-o"></i>{{ __('cargo::view.delete') }}
                        </a>
                    </div>
                </div>
            </div>
        @elseif($typeForm == 'edit')
            @if($model)
                @forelse($model->addressess as $address)
                    <div data-repeater-item class="data-repeater-item-count">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
                                    <select name="country_id" class="change-country-client-address form-control select-country @error('country_id') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($country->id == $address->country_id ) selected @endif >{{$country->name}}</option>
                                            @php
                                                if($country->id == $address->country_id )
                                                $states = Modules\Cargo\Entities\State::where('country_id',$address->country_id)->get();
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.region') }}</label>
                                    <select @error('state_id') is-invalid @enderror name="state_id" class="change-state-client-address form-control select-state">
                                        <option value=""></option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" @if($state->id == $address->state_id ) selected @endif >{{$state->name}}</option>
                                            @php
                                                if($state->id == $address->state_id )
                                                $areas = Modules\Cargo\Entities\Area::where('state_id',$address->state_id)->get();
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
                                    <select @error('area_id') is-invalid @enderror name="area_id" style="display: block !important;" class="change-area-client-address form-control select-area">
                                        <option value=""></option>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}" @if($area->id == $address->area_id ) selected @endif >{{json_decode($area->name, true)[app()->getLocale()]}}</option>
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
                            <input @error('address') is-invalid @enderror value="{{$address->address}}" type="text" placeholder="{{ __('cargo::view.address') }}" name="address" class="form-control" />
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if($googleMap)
                            <div class="mt-2 location-client location-client-{{$address->id}}">
                                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
                                <input type="text" value="{{$address->client_street_address_map}}" class="form-control address address-client-{{$address->id}} " placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"  rel="client"/>
                                <input type="hidden" value="{{$address->client_lat}}" class="form-control lat" data-client="lat" name="client_lat" />
                                <input type="hidden" value="{{$address->client_lng}}" class="form-control lng" data-client="lng" name="client_lng" />
                                <input type="hidden" value="{{$address->client_url}}" class="form-control url" data-client="url" name="client_url" />

                                <div class="mt-2 col-sm-12 map_canvas map_canvas_{{$address->id}} map-client map-client_{{$address->id}}" style="width:100%;height:300px;"></div>
                                <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                            </div>
                        @endif

                        <div class="mt-3 mb-3 row">
                            <div class="col-md-12">
                                <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
                                    <i class="la la-trash-o"></i>{{ __('cargo::view.delete') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div data-repeater-item class="data-repeater-item-count">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
                                    <select name="country_id" class="change-country-client-address form-control select-country @error('country_id') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.region') }}</label>
                                    <select @error('state_id') is-invalid @enderror name="state_id" class="change-state-client-address form-control select-state">
                                        <option value=""></option>

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
                                    <select @error('area_id') is-invalid @enderror name="area_id" style="display: block !important;" class="change-area-client-address form-control select-area">
                                        <option value=""></option>

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
                            <input @error('address') is-invalid @enderror type="text" placeholder="{{ __('cargo::view.address') }}" name="address" class="form-control" />
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if($googleMap)
                            <div class="mt-2 location-client">
                                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
                                <input type="text" class="form-control address address-client " placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"  rel="client" value="" />
                                <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
                                <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
                                <input type="hidden" class="form-control url" data-client="url" name="client_url" />

                                <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
                                <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                            </div>
                        @endif

                        <div class="mt-3 mb-3 row">
                            <div class="col-md-12">
                                <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
                                    <i class="la la-trash-o"></i>{{ __('cargo::view.delete') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            @endif
        @endif
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <div>
                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                    <i class="la la-plus"></i>{{ __('cargo::view.add_new_address') }}
                </a>
            </div>
        </div>
    </div>
</div>  --}}

<!--begin::Input group -- How Know Us -->
{{--  <div class="row mb-6">

    <!--begin::Input group-->
    <div class="fv-row col-lg-12 form-group">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.customer_source') }}</label>
        <!--end::Label-->

        <select
            class="form-control  @error('how_know_us') is-invalid @enderror"
            name="how_know_us"
            data-control="select2"
            data-placeholder="{{ __('cargo::view.table.customer_source') }}"
            data-allow-clear="true"
        >
            <option></option>
            <option
                {{ old('how_know_us') ==  'Facebook' ? 'selected' : '' }}
                @if($typeForm == 'edit')
                    {{ $model->how_know_us ==  "Facebook" ? 'selected' : '' }}
                @endif
                value="Facebook">{{ __('cargo::view.facebook') }}
            </option>
            <option
                {{ old('how_know_us') ==  'Website' ? 'selected' : '' }}
                @if($typeForm == 'edit')
                    {{ $model->how_know_us ==  "Website" ? 'selected' : '' }}
                @endif
                value="Website">{{ __('cargo::view.website') }}
            </option>
            <option
                {{ old('how_know_us') ==  'Friend' ? 'selected' : '' }}
                @if($typeForm == 'edit')
                    {{ $model->how_know_us ==  "Friend" ? 'selected' : '' }}
                @endif
                value="Friend">{{ __('cargo::view.friend') }}
            </option>
            <option
                {{ old('how_know_us') ==  'Sales Team' ? 'selected' : '' }}
                @if($typeForm == 'edit')
                    {{ $model->how_know_us ==  "Sales Team" ? 'selected' : '' }}
                @endif
                value="Sales Team">{{ __('cargo::view.sales_team') }}
            </option>
            <option
                {{ old('how_know_us') ==  'Google' ? 'selected' : '' }}
                @if($typeForm == 'edit')
                    {{ $model->how_know_us ==  "Google" ? 'selected' : '' }}
                @endif
                value="Google">{{ __('cargo::view.google') }}
            </option>
        </select>
        @error('how_know_us')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!--end::Input group-->
</div>  --}}
<!--end::Input group-->

<!--begin::Input group --  Missions Costs -->
{{--  <div class="row mb-6">

    <div class="col-lg-12 card-header">
        <h5>{{ __('cargo::view.missions_costs') }}</h5>
    </div>

    <!--begin::Input group --  pickup_cost -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.custom_pickup_cost') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="pickup_cost" class="form-control form-control-lg @error('pickup_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.custom_pickup_cost') }}" value="{{ old('pickup_cost', isset($model) ? $model->pickup_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_pickup_cost') ) }}" />
            @error('pickup_cost')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group --  Custom Supply Cost -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.custom_supply_cost') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="supply_cost" class="form-control form-control-lg @error('supply_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.custom_supply_cost') }}" value="{{ old('supply_cost', isset($model) ? $model->supply_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_supply_cost') ) }}" />
            @error('supply_cost')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>  --}}
<!--end::Input group-->

<!--begin::Input group --  Default Costs For The First kg -->
{{--  <div class="row mb-6">

    <div class="col-lg-12 card-header">
        <h5>{{ __('cargo::view.default_costs_for_the_first_kg') }}</h5>
    </div>

    <!--begin::Input group --  Default Shipping Cost -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">@if($is_def_mile_or_fees == 1) {{ __('cargo::view.default_mile_cost') }} @else {{ __('cargo::view.default_shipping_cost') }} @endif</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            @if($is_def_mile_or_fees == 1)
                <input type="number" min="0" name="def_mile_cost" class="form-control form-control-lg @error('def_mile_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.default_mile_cost') }}" value="{{ old('def_mile_cost', isset($model) ? $model->def_mile_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_mile_cost') ) }}" />
                @error('def_mile_cost')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @elseif($is_def_mile_or_fees == 2)
                <input type="number" min="0" name="def_shipping_cost" class="form-control form-control-lg @error('def_shipping_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.default_shipping_cost') }}" value="{{ old('def_shipping_cost', isset($model) ? $model->def_shipping_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost') ) }}" />
                @error('def_shipping_cost')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif

        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Default Tax -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.default_tax') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="def_tax" class="form-control form-control-lg @error('def_tax') is-invalid @enderror" placeholder="{{ __('cargo::view.default_tax') }}" value="{{ old('def_tax', isset($model) ? $model->def_tax : Modules\Cargo\Entities\ShipmentSetting::getVal('def_tax') ) }}" />
            @error('def_tax')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Default Insurance -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.default_insurance') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="def_insurance" class="form-control form-control-lg @error('def_insurance') is-invalid @enderror" placeholder="{{ __('cargo::view.default_insurance') }}" value="{{ old('def_insurance', isset($model) ? $model->def_insurance : Modules\Cargo\Entities\ShipmentSetting::getVal('def_insurance') ) }}" />
            @error('def_insurance')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Default Returned Shipment Cost -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">@if($is_def_mile_or_fees == 1) {{ __('cargo::view.default_returned_mile_cost') }} @else {{ __('cargo::view.default_returned_shipment_cost') }}  @endif</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            @if($is_def_mile_or_fees == 1)
                <input type="number" min="0" name="def_return_mile_cost" class="form-control form-control-lg @error('def_return_mile_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.default_returned_mile_cost') }}" value="{{ old('def_return_mile_cost', isset($model) ? $model->def_return_mile_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_mile_cost') ) }}" />
                @error('def_return_mile_cost')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @elseif($is_def_mile_or_fees == 2)
                <input type="number" min="0" name="def_return_cost" class="form-control form-control-lg @error('def_return_cost') is-invalid @enderror" placeholder="{{ __('cargo::view.default_returned_shipment_cost') }}" value="{{ old('def_return_cost', isset($model) ? $model->def_return_cost : Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_cost') ) }}" />
                @error('def_return_cost')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
    </div>
    <!--end::Input group-->

</div>  --}}
<!--end::Input group-->

<!--begin::Input group --  Extra Costs For Kg -->
{{--  <div class="row mb-6">

    <div class="col-lg-12 card-header">
        <h5>{{ __('cargo::view.extra_costs_for_kg') }}</h5>
    </div>

    <!--begin::Input group --  Fixed Shipping Cost/Kg -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">@if($is_def_mile_or_fees == 1) {{ __('cargo::view.fixed_mile_cost_Kg') }} @else {{ __('cargo::view.fixed_shipping_cost_Kg') }} @endif</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            @if($is_def_mile_or_fees == 2)
                <input type="number" min="0" name="def_shipping_cost_gram" class="form-control form-control-lg @error('def_shipping_cost_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_shipping_cost_Kg') }}" value="{{ old('def_shipping_cost_gram', isset($model) ? $model->def_shipping_cost_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost_gram') ) }}" />
                @error('def_shipping_cost_gram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @elseif($is_def_mile_or_fees == 1)
                <input type="number" min="0" name="def_mile_cost_gram" class="form-control form-control-lg @error('def_mile_cost_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_mile_cost_Kg') }}" value="{{ old('def_mile_cost_gram', isset($model) ? $model->def_mile_cost_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_mile_cost_gram') ) }}" />
                @error('def_mile_cost_gram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Fixed Tax/Kg -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.fixed_tax_Kg') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="def_tax_gram" class="form-control form-control-lg @error('def_tax_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_tax_Kg') }}" value="{{ old('def_tax_gram', isset($model) ? $model->def_tax_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_tax_gram') ) }}" />
            @error('def_tax_gram')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Fixed Insurance/Kg -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.fixed_insurance_Kg') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="number" min="0" name="def_insurance_gram" class="form-control form-control-lg @error('def_insurance_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_insurance_Kg') }}" value="{{ old('def_insurance_gram', isset($model) ? $model->def_insurance_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_insurance_gram') ) }}" />
            @error('def_insurance_gram')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group --  Fixed Returned Shipment Cost/Kg -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">@if($is_def_mile_or_fees == 1) {{ __('cargo::view.fixed_returned_mile_cost_Kg') }} @else {{ __('cargo::view.fixed_returned_shipment_cost_Kg') }} @endif</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            @if($is_def_mile_or_fees == 2)
                <input type="number" min="0" name="def_return_cost_gram" class="form-control form-control-lg @error('def_return_cost_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_returned_shipment_cost_Kg') }}" value="{{ old('def_return_cost_gram', isset($model) ? $model->def_return_cost_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_cost_gram') ) }}" />
                @error('def_return_cost_gram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @elseif($is_def_mile_or_fees == 1)
                <input type="number" min="0" name="def_return_mile_cost_gram" class="form-control form-control-lg @error('def_return_mile_cost_gram') is-invalid @enderror" placeholder="{{ __('cargo::view.fixed_returned_mile_cost_Kg') }}" value="{{ old('def_return_mile_cost_gram', isset($model) ? $model->def_return_mile_cost_gram : Modules\Cargo\Entities\ShipmentSetting::getVal('def_return_mile_cost_gram') ) }}" />
                @error('def_return_mile_cost_gram')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
    </div>
    <!--end::Input group-->

</div>  --}}
<!--end::Input group-->



<!--begin::Input group --  Extra Fees for Package Types -->
{{--  <div class="row mb-5">
    <div class="col-lg-12 card-header">
        <h5>{{ __('cargo::view.extra_fees_for_package_types') }}</h5>
    </div>
    <div class="col-lg-12 fv-row">
        @if(count($packages = Modules\Cargo\Entities\Package::all()))
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                        <th>{{ __('cargo::view.table.name') }}</th>
                        <th>{{ __('cargo::view.extra_cost') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($typeForm == 'create')
                        @foreach($packages as $key => $package)
                            <tr>
                                <td>{{json_decode($package->name, true)[app()->getLocale()]}}</td>
                                <td>

                                    <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" />
                                    <input type="hidden" name="package_id[]" value="{{$package->id}}">

                                </td>
                            </tr>
                        @endforeach
                    @elseif($typeForm == 'edit')
                        @if($model)
                            @php
                                $package_ids[] = '';
                            @endphp
                            @foreach($model->packages as $key => $package)
                                @php
                                    $package_ids[] =  $package->package_id;
                                @endphp
                                <tr>
                                    <td>{{json_decode($package->name, true)[app()->getLocale()]}}</td>
                                    <td>

                                        <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" />
                                        <input type="hidden" name="package_id[]" value="{{$package->package_id}}">

                                    </td>
                                </tr>
                            @endforeach
                            @foreach($packages = Modules\Cargo\Entities\Package::whereNotIn('id',$package_ids)->get() as $key => $package)
                                <tr>
                                    <td>{{json_decode($package->name, true)[app()->getLocale()]}}</td>
                                    <td>

                                        <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" />
                                        <input type="hidden" name="package_id[]" value="{{$package->id}}">

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                </tbody>
            </table>
        @else
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
            {{ __('cargo::view.please_configure_package_types') }},
                @if(auth()->user()->can('manage-packages') || $user_role == $admin)
                    <a class="alert-link" href="{{ route('packages.index') }}">{{ __('cargo::view.configure_now') }}</a>
                @else
                    {{ __('cargo::view.configure_now') }}
                @endif
            </div>
        @endif
    </div>
</div>  --}}
<!--end::Input group-->

{{-- Inject styles --}}
@section('styles')
    <style>
        label {
            font-weight: bold !important;
        }
        .card-header{
            display: flex !important;
            align-items: center !important;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js" integrity="sha512-0hFHNPMD0WpvGGNbOaTXP0pTO9NkUeVSqW5uFG2f5F9nKyDuHE3T4xnfKhAhnAZWZIO/gBLacwVvxxq0HuZNqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.js" integrity="sha512-k59zBVzm+v8h8BmbntzgQeJbRVBK6AL1doDblD1pSZ50rwUwQmC/qMLZ92/8PcbHWpWYeFaf9hCICWXaiMYVRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/global/js/jquery.geocomplete.js') }}"></script>
    <script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$google_map_key}}"></script>
    <script>
        var typeForm = '{{$typeForm}}';
        if(typeForm == 'edit'){
            @if(isset($model))
                @foreach($model->addressess as $key => $address)
                    $('.address-client-{{$address->id}}').each(function(){
                        var address = $(this);
                        var lat = '{{$address->client_lat}}';
                        lat = parseFloat(lat);
                        var lng = '{{$address->client_lng}}';
                        lng = parseFloat(lng);

                        address.geocomplete({
                            map: ".map_canvas_{{$address->id}}.map-client_{{$address->id}}",
                            mapOptions: {
                                zoom: 8,
                                center: { lat: lat, lng: lng },

                            },
                            markerOptions: {
                                draggable: true
                            },
                            details: ".location-client-{{$address->id}}",
                            detailsAttribute: 'data-client',
                            autoselect: true,
                            restoreValueAfterBlur: true,
                        });
                        address.bind("geocode:dragged", function(event, latLng){
                            $("input[data-client=lat]").val(latLng.lat());
                            $("input[data-client=lng]").val(latLng.lng());
                        });
                    });
                @endforeach
            @endif
        }else{
            $('.address-client').each(function(){
                var address = $(this);
                address.geocomplete({
                    map: ".map_canvas.map-client",
                    mapOptions: {
                        zoom: 8,
                        center: { lat: -34.397, lng: 150.644 },
                    },
                    markerOptions: {
                        draggable: true
                    },
                    details: ".location-client",
                    detailsAttribute: 'data-client',
                    autoselect: true,
                    restoreValueAfterBlur: true,
                });
                address.bind("geocode:dragged", function(event, latLng){
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
                @if($googleMap)
                    var map_canvas  = repeater_item.find(".map_canvas.map-client");
                    var map_data    = repeater_item.find(".location-client");
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

        function changeCountry()
        {
            $('.change-country-client-address').change(function() {
                var id = $(this).parent().find( ".change-country-client-address" ).val();
                var row = $(this).closest(".row");
                var state_input = row.find(".change-state-client-address");
                var state_name  = state_input.attr("name");

                $.get("{{route('ajax.getStates')}}?country_id=" + id, function(data) {
                    $('select[name ="'+state_name+'"]').empty();

                    $('select[name ="'+state_name+'"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="'+state_name+'"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                    }


                });
            });
        }
        changeCountry();

        function changeState()
        {
            $('.change-state-client-address').change(function() {

                var id = $(this).parent().find( ".change-state-client-address" ).val();
                var row = $(this).closest(".row");
                var area_input = row.find(".change-area-client-address");
                var area_name  = area_input.attr("name");
                console.log(area_name);
                $.get("{{route('ajax.getAreas')}}?state_id=" + id, function(data) {
                    $('select[name ="'+area_name+'"]').empty();
                    $('select[name ="'+area_name+'"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="'+area_name+'"]').append('<option value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
                    }
                });
            });
        }
        changeState();

        function selectPlaceholder()
        {
            $('.select-country').select2({
                placeholder: "{{ __('cargo::view.choose_country') }}",
                width: '100%'
            })
            @if(auth()->user()->can('add-covered-countries') || $user_role == $admin)
                .on('select2:open', () => {
                    $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('countries.index')}}?redirect=shipments.create"
                        class="btn btn-primary" >{{ __('cargo::view.manage')}} {{__('cargo::view.covered_countries') }}</a>
                        </li>`);
                });
            @endif

            $('.select-state').select2({
                placeholder: "{{ __('cargo::view.choose_region') }}",
                width: '100%'
            })
            @if(auth()->user()->can('add-covered-regions') || $user_role == $admin)
                .on('select2:open', () => {
                    $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('countries.index')}}?redirect=shipments.create"
                        class="btn btn-primary" >{{ __('cargo::view.manage')}} {{__('cargo::view.covered_regions') }}</a>
                        </li>`);
                });
            @endif

            $('.select-area').select2({
                placeholder: "{{ __('cargo::view.choose_area') }}",
                width: '100%'
            })
            @if(auth()->user()->can('manage-areas') || $user_role == $admin)
                .on('select2:open', () => {
                    $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('areas.index')}}?redirect=shipments.create"
                        class="btn btn-primary" >{{ __('cargo::view.manage')}} {{__('cargo::view.areas') }}</a>
                        </li>`);
                });
            @endif
        }
        selectPlaceholder();

        $('#check').click(function(){
            const type = $('#password').attr('type') === 'password' ? 'text' : 'password';
            $('#password').prop('type', type);
        });
    </script>
@endsection
