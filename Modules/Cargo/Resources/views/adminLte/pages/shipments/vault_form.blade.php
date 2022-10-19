@csrf

@php
$user_role = auth()->user()->role;
$admin  = 1;
$auth_staff  = 0;
$auth_branch = 3;
$auth_client = 4;

$userBranch = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->first();
$userStaff  = Modules\Cargo\Entities\Staff::where('user_id',auth()->user()->id)->first();
$userClient = Modules\Cargo\Entities\Client::where('user_id',auth()->user()->id)->first();

$branches = Modules\Cargo\Entities\Branch::where('is_archived', 0)->get();
$clients = Modules\Cargo\Entities\Client::where('is_archived', 0)->get();
if($user_role == $auth_branch){
  $branches = Modules\Cargo\Entities\Branch::where('id', $userBranch->id)->get();
  $clients  = Modules\Cargo\Entities\Client::where('branch_id', $userBranch->id )->get();
}elseif(auth()->user()->can('create-shipments') && $user_role == $auth_staff){
  $branches = Modules\Cargo\Entities\Branch::where('id', $userStaff->branch_id )->get();
  $clients  = Modules\Cargo\Entities\Client::where('branch_id', $userStaff->branch_id )->get();
}

$countries = Modules\Cargo\Entities\Country::where('covered',1)->get();
$packages = Modules\Cargo\Entities\Package::all();
$deliveryTimes = Modules\Cargo\Entities\DeliveryTime::all();

    // is_def_mile_or_fees if result 1 for mile if result 2 for fees
$is_def_mile_or_fees = Modules\Cargo\Entities\ShipmentSetting::getVal('is_def_mile_or_fees');
if(!$is_def_mile_or_fees){
  $is_def_mile_or_fees = 0;
}

$googleSettings = resolve(\app\Models\GoogleSettings::class)->toArray();
$googleMap = json_decode($googleSettings['google_map'], true);
$google_map_key = '';
if($googleMap){
  $google_map_key = $googleMap['google_map_key'];
}

$paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
@endphp

@if(auth()->user()->can('shipping-rates') || $user_role == $admin )
@if( Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost') == null)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_configure_shipping_rates_in_creation_will_be_zero_without_configuration') }},
    <a class="alert-link" href="{{ route('shipments.settings.fees') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if(auth()->user()->can('add-covered-countries') || $user_role == $admin )
@if(count($countries) == 0 || Modules\Cargo\Entities\State::where('covered', 1)->count() == 0)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_configure_your_covered_countries_and_regions') }},
    <a class="alert-link" href="{{ route('countries.index') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if(auth()->user()->can('manage-areas') || $user_role == $admin )
@if(Modules\Cargo\Entities\Area::count() == 0)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_add_areas_before_creating_your_first_shipment') }},
    <a class="alert-link" href="{{ route('areas.create') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if(auth()->user()->can('manage-packages') || $user_role == $admin )
@if(count($packages) == 0)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_add_package_types_before_creating_your_first_shipment') }},
    <a class="alert-link" href="{{ route('packages.create') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if(auth()->user()->can('manage-branches') || $user_role == $admin )
@if($branches->count() == 0)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_add_branches_types_before_creating_your_first_shipment') }},
    <a class="alert-link" href="{{ route('branches.create') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if(auth()->user()->can('manage-clients') || $user_role == $admin )
@if($clients->count() == 0)
<div class="row">
  <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_add_clients_types_before_creating_your_first_shipment') }},
    <a class="alert-link" href="{{ route('clients.create') }}">{{ __('cargo::view.configure_now') }}</a>
  </div>
</div>
@endif
@endif

@if($user_role == $auth_branch || $user_role == $auth_staff || $user_role == $auth_client )
@if( Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipping_cost') == null || count($countries) == 0 || Modules\Cargo\Entities\State::where('covered', 1)->count() == 0 || Modules\Cargo\Entities\Area::count() == 0 || count($packages) == 0 || $branches->count() == 0 || $clients->count() == 0)
<div class="row">
  <div class="text-center alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
    {{ __('cargo::view.please_ask_your_administrator_to_configure_shipment_settings_first_before_you_can_create_a_new_shipment') }}
  </div>
</div>
@endif
@endif
{{--  <a href="https://fontawesome.com/search" target="_blank" class="btn btn-primary">Choose Icon</a>  --}}
    <div class="row">
        <h4 class="bl">Vault info</h4>

      <div class="col-lg-12">
        <input type="hidden" name="Shipment[type]" value="3">
        @if($typeForm == 'edit')
        <input type="hidden" name="ship_id" value="{{ $model->id }}" class="form-control">

        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label fw-bold fs-6 required">Tracking no.</label>
                  <input type="text" value="{{ old('Shipment.vault_number', isset($model) ? $model->vault_number : '') }}" placeholder="Vault Number" name="vault_number" required class="form-control @error('Shipment.vault_number') is-invalid @enderror" />
                  @error('Shipment.vault_number')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
            </div>


          <div class="col-md-6">
            <div class="form-group client-select">
              <label class="col-form-label fw-bold fs-6 required">{{ __('Name of Depositor') }}</label>
              @if($user_role == $auth_client)
              <input type="text" placeholder="" class="form-control" name="" value="{{$userClient->name}}" disabled>
              <input type="hidden" name="Shipment[client_id]" value="{{$userClient->id}}">
              @else
              <select
              id="client-id" onchange="selectIdTriggered('sender')"
              class="form-control select-client  @error('Shipment.client_id') is-invalid @enderror"
              data-control="select2"
              data-placeholder="{{ __('cargo::view.choose_client') }}"
              data-allow-clear="true"
              name="Shipment[client_id]"
              >
              <option></option>
              @foreach($clients as $client)
              <option
              value="{{$client->id}}"
              data-phone="{{$client->responsible_mobile}}"
              {{ old('Shipment.client_id') == $client->id ? 'selected' : '' }}
              @if($typeForm == 'edit')
              {{ $model->client_id == $client->id ? 'selected' : '' }}
              @endif
              > {{$client->name}}</option>
              @endforeach

            </select>
            @error('Shipment.client_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            @endif

          </div>
        </div>

        {{--  <div class="col-md-6">
          <div class="form-group">
            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.client_phone') }}</label>

            @if($user_role == $auth_client)
            <input placeholder="{{ __('cargo::view.client_phone') }}" name="Shipment[client_phone]" id="client_phone" value="{{$userClient->responsible_mobile}}" class="form-control @error('Shipment.client_phone') is-invalid @enderror" />
            @else
            <input placeholder="{{ __('cargo::view.client_phone') }}" name="Shipment[client_phone]" id="client_phone" value="{{ old('Shipment.client_phone', isset($model) ? $model->client_phone : '' ) }}" class="form-control @error('Shipment.client_phone') is-invalid @enderror" />
            @endif

            @error('Shipment.client_phone')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror

          </div>
        </div>  --}}
        {{--  uuiuiuiuiui  --}}
        {{--  <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label fw-bold fs-6 required">{{ __('Item Description') }}</label>

            @if($user_role == $auth_client)
            <input type="text" placeholder="{{ __('Item Description') }}" name="item_des" id="item_des" value="{{$userClient->item_des}}" class="form-control @error('Shipment.item_des') is-invalid @enderror" />
            @else
            <input type="text" placeholder="{{ __('Item Description') }}" name="item_des" id="item_des" value="{{ old('Shipment.item_des', isset($model) ? $model->item_des : '' ) }}" class="form-control @error('Shipment.item_des') is-invalid @enderror" />
            @endif

            @error('Shipment.item_des')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror

        </div>
        </div>  --}}


        {{--  <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label fw-bold fs-6 required">{{ __('Icon') }}</label>

            @if($user_role == $auth_client)
            <input placeholder="<i class=fa-solid> </i>" name="vault_icon" id="vault_icon" value="{{ old('Shipment.vault_icon', isset($model) ? $model->vault_icon : '' ) }}" class="form-control @error('Shipment.vault_icon') is-invalid @enderror" />
            @else
            <input placeholder="<i class=fa-solid> </i>" name="vault_icon" id="vault_icon" value="{{ old('Shipment.vault_icon', isset($model) ? $model->vault_icon : '' ) }}" class="form-control @error('Shipment.vault_icon') is-invalid @enderror" />
            @endif

            @error('Shipment.vault_icon')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror

        </div>
        </div>  --}}

        <div class="col-md-6">
        <div class="form-group">
            <label class="col-form-label fw-bold fs-6 required">{{ __('Next of Kin') }}</label>

            @if($user_role == $auth_client)
            <input placeholder="{{ __('Next of Kin') }}" name="next_kin" id="next_kin" value="{{ old('Shipment.next_kin', isset($model) ? $model->next_kin : '' ) }}" class="form-control @error('Shipment.next_kin') is-invalid @enderror" />
            {{--  <input placeholder="{{ __('Next of Kin') }}" name="next_kin" id="next_kin" value="{{$userClient->next_kin}}" class="form-control @error('Shipment.next_kin') is-invalid @enderror" />  --}}

            @else
            <input placeholder="{{ __('Next of Kin') }}" name="next_kin" id="next_kin" value="{{ old('Shipment.next_kin', isset($model) ? $model->next_kin : '' ) }}" class="form-control @error('Shipment.next_kin') is-invalid @enderror" />
            @endif

            @error('Shipment.next_kin')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror

        </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label fw-bold fs-6 required">Shipment Status</label>
              <select class="form-control select2" data-placeholder="Select Status"
                data-allow-clear="true" data-control="select2" name="ship_status" required>
                @if($typeForm == 'edit')
                <option value="Saved Pickup" {{$model->status == 'Saved Pickup' ? 'selected':''}}>Saved Pickup</option>
                <option value="Saved Dropoff" {{$model->status == 'Saved Dropoff' ? 'selected':''}}>Saved Dropoff</option>
                <option value="Requested Pickup" {{$model->status == 'Requested Pickup' ? 'selected':''}}>Requested Pickup</option>
                <option value="Approved" {{$model->status == 'Approved' ? 'selected':''}}>Approved</option>
                <option value="In Transit" {{$model->status == 'In Transit' ? 'selected':''}}>In Transit</option>
                <option value="Closed" {{$model->status == 'Closed' ? 'selected':''}}>Closed</option>
                <option value="Assigned" {{$model->status == 'Assigned' ? 'selected':''}}>Assigned</option>
                <option value="Received" {{$model->status == 'Received' ? 'selected':''}}>Received</option>
                <option value="Delivered" {{$model->status == 'Delivered' ? 'selected':''}}>Delivered</option>
                <option value="Supplied" {{$model->status == 'Supplied' ? 'selected':''}}>Supplied</option>
                <option value="Returned" {{$model->status == 'Returned' ? 'selected':''}}>Returned</option>
                <option value="On Hold" {{$model->status == 'On Hold' ? 'selected':''}}>On Hold</option>
                <option value="In Vault" {{$model->status == 'In Vault' ? 'selected':''}}>In Vault</option>
                @else
                <option value="Saved Pickup">Saved Pickup</option>
                <option value="Saved Dropoff">Saved Dropoff</option>
                <option value="Requested Pickup">Requested Pickup</option>
                <option value="Approved">Approved</option>
                <option value="In Transit">In Transit</option>
                <option value="Closed">Closed</option>
                <option value="Assigned">Assigned</option>
                <option value="Received">Received</option>
                <option value="Delivered">Delivered</option>
                <option value="Supplied">Supplied</option>
                <option value="Returned">Returned</option>
                <option value="On Hold">On Hold</option>
                <option value="In Vault">In Vault</option>
                @endif
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label fw-bold fs-6 required">Quantity</label>
              <input type="text" value="{{ old('Shipment.quantity', isset($model) ? $model->quantity : '') }}" placeholder="Quantity" name="quantity" required class="form-control @error('Shipment.quantity') is-invalid @enderror" />
              @error('Shipment.quantity')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label fw-bold fs-6 required">Arrears to be paid</label>
              <input type="text" value="{{ old('Shipment.arrears', isset($model) ? $model->arrears : '') }}" placeholder="Arrears" name="arrears" required class="form-control @error('Shipment.arrears') is-invalid @enderror" />
              @error('Shipment.arrears')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label fw-bold fs-6 required">Date of Deposit</label>
              <input type="date" value="{{ old('Shipment.d_o_deposit', isset($model) ? $model->d_o_deposit : '') }}" placeholder="Date of Deposit" required name="d_o_deposit" class="form-control @error('Shipment.d_o_deposit') is-invalid @enderror" />
              @error('Shipment.d_o_deposit')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        {{--  <div class="col-md-12 d-none">
          <div class="form-group">
            <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.client_address') }}</label>
            <select
            id="client-addresses"
            name="Shipment[client_address]" class="form-control select-address @error('Shipment.client_id') is-invalid @enderror"
            >
            <option value=""></option>
            @if($typeForm == 'edit')
            @foreach(Modules\Cargo\Entities\ClientAddress::where('client_id', $model->client_id)->where('is_archived',0)->get() as $address)
            <option
            value="{{$address->id}}"
            {{ old('Shipment.client_address') == $address->id ? 'selected' : '' }}
            @if($typeForm == 'edit')
            {{ $model->client_address == $address->id ? 'selected' : '' }}
            @endif
            > {{$address->address}}</option>
            @endforeach
            @endif

          </select>
          @error('Shipment.client_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>  --}}

      {{--  <div class="p-3 mb-4 mt-4 col-md-12" id="show_address_div" style="border: 1px solid #e4e6ef; display:none">
        <div class="row">
          @csrf
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
              <select id="change-country-client-address" name="country_id" class="form-control select-country @error('country_id') is-invalid @enderror">
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
              <select @error('state_id') is-invalid @enderror id="change-state-client-address" name="state_id" class="form-control select-state">
                <option value=""></option>

              </select>
              @error('state_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.area') }}</label>
          <select @error('area_id') is-invalid @enderror name="area_id" style="display: block !important;" class="form-control select-area">
            <option value=""></option>

          </select>
          @error('area_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.address') }}</label>
          <input @error('client_address') is-invalid @enderror type="text" placeholder="{{ __('cargo::view.address') }}" name="client_address" class="form-control" />
          @error('client_address')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary" onclick="AddNewClientAddress()">{{ __('cargo::view.save') }}</button>
          <button type="button" class="btn btn-secondary" onclick="closeAddressDiv()">{{ __('cargo::view.close') }}</button>
        </div>
      </div>  --}}
    </div>

    <div class="vault_hide">

  {{--  <div class="p-3 mb-4 mt-4 col-md-12 d-none" id="show_address_div" style="border: 1px solid #e4e6ef; display:none">
    <div class="row">
      @csrf
      <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.country') }}</label>
          <select id="change-country-client-address" name="country_id" class="form-control select-country @error('country_id') is-invalid @enderror">
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
          <select @error('state_id') is-invalid @enderror id="change-state-client-address" name="state_id" class="form-control select-state">
            <option value=""></option>

          </select>
          @error('state_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.area') }}</label>
      <select @error('area_id') is-invalid @enderror name="area_id" style="display: block !important;" class="form-control select-area">
        <option value=""></option>

      </select>
      @error('area_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.address') }}</label>
      <input @error('client_address') is-invalid @enderror type="text" placeholder="{{ __('cargo::view.address') }}" name="client_address" class="form-control" />
      @error('client_address')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    @if($googleMap)
    <div class="location-client">
      <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.location') }}</label>
      <input type="text" class="form-control address-client " placeholder="{{ __('cargo::view.location') }}" name="client_street_address_map"  rel="client" value="" />
      <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
      <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
      <input type="hidden" class="form-control url" data-client="url" name="client_url" />

      <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
      <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
    </div>
    @endif
    <div class="mt-4">
      <button type="button" class="btn btn-primary" onclick="AddNewClientAddress()">{{ __('cargo::view.save') }}</button>
      <button type="button" class="btn btn-secondary" onclick="closeAddressDiv()">{{ __('cargo::view.close') }}</button>
    </div>
  </div>  --}}
  {{-- Address end --}}

</div>

{{--  <div class="row mb-5 d-none">
  <div class="col-md-6 d-none">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.from_country') }}</label>
      <select id="change-country" name="Shipment[from_country_id]" class="form-control select-country @error('Shipment.from_country_id') is-invalid @enderror">
        <option value=""></option>
        @foreach($countries as $country)
        <option
        value="{{$country->id}}"
        {{ old('Shipment.from_country_id') == $country->id ? 'selected' : '' }}
        @if($typeForm == 'edit')
        {{ $model->from_country_id == $country->id ? 'selected' : '' }}
        @endif
        >{{$country->name}}</option>
        @endforeach
      </select>
      @error('Shipment.from_country_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="col-md-6 d-none">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.to_country') }}</label>
      <select id="change-country-to" name="Shipment[to_country_id]" class="form-control select-country @error('Shipment.to_country_id') is-invalid @enderror">
        <option value=""></option>
        @foreach($countries as $country)
        <option
        value="{{$country->id}}"
        {{ old('Shipment.to_country_id') == $country->id ? 'selected' : '' }}
        @if($typeForm == 'edit')
        {{ $model->to_country_id == $country->id ? 'selected' : '' }}
        @endif
        >{{$country->name}}</option>
        @endforeach
      </select>
      @error('Shipment.to_country_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
</div>
<div class="row mb-5 d-none">
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.from_region') }}</label>
      <select id="change-state-from" name="Shipment[from_state_id]" class="form-control select-state @error('Shipment.from_state_id') is-invalid @enderror">
        <option value=""></option>
        @if($typeForm == 'edit')
        @foreach(Modules\Cargo\Entities\State::where('country_id',$model->from_country_id)->where('covered',1)->get() as $item)
        <option
        value="{{$item->id}}"
        @if($typeForm == 'edit')
        {{ $model->from_state_id == $item->id ? 'selected' : '' }}
        @endif
        >{{$item->name}}</option>
        @endforeach
        @endif
      </select>
      @error('Shipment.from_state_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.to_region') }}</label>
      <select id="change-state-to" name="Shipment[to_state_id]" class="form-control select-state @error('Shipment.to_state_id') is-invalid @enderror">
        <option value=""></option>
        @if($typeForm == 'edit')
        @foreach(Modules\Cargo\Entities\State::where('country_id',$model->to_country_id)->where('covered',1)->get() as $item)
        <option
        value="{{$item->id}}"
        @if($typeForm == 'edit')
        {{ $model->to_state_id == $item->id ? 'selected' : '' }}
        @endif
        >{{$item->name}}</option>
        @endforeach
        @endif
      </select>
      @error('Shipment.to_state_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
</div>
<div class="row mb-5 d-none">
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.from_area') }}</label>
      <select name="Shipment[from_area_id]" id="from_area_id" class="form-control select-area @error('Shipment.from_area_id') is-invalid @enderror">
        <option value=""></option>
        @if($typeForm == 'edit')
        @foreach(Modules\Cargo\Entities\Area::where('state_id',$model->from_state_id)->get() as $item)
        <option
        value="{{$item->id}}"
        @if($typeForm == 'edit')
        {{ $model->from_area_id == $item->id ? 'selected' : '' }}
        @endif
        >{{json_decode($item->name, true)[app()->getLocale()]}}</option>
        @endforeach
        @endif
      </select>
      @error('Shipment.from_area_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.to_area') }}</label>
      <select name="Shipment[to_area_id]" class="form-control select-area @error('Shipment.to_area_id') is-invalid @enderror">
        <option value=""></option>
        @if($typeForm == 'edit')
        @foreach(Modules\Cargo\Entities\Area::where('state_id',$model->to_state_id)->get() as $item)
        <option
        value="{{$item->id}}"
        @if($typeForm == 'edit')
        {{ $model->to_area_id == $item->id ? 'selected' : '' }}
        @endif
        >{{json_decode($item->name, true)[app()->getLocale()]}}</option>
        @endforeach
        @endif
      </select>
      @error('Shipment.to_area_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
</div>  --}}



<div class="vault_show">
  <div class="row">
    <h4 class="bl mt-3">User info</h4>
    {{--  <div class="col-md-12">
      <div class="form-group">
        <label class="col-form-label fw-bold fs-6">Customer Address</label>
        <textarea class="form-control" name="client_address">{{ old('Shipment.client_address', isset($model) ? $model->client_address : '') }}</textarea>
      </div>
    </div>  --}}
    <div class="col-md-6">
      <div class="form-group">
        <label class="col-form-label fw-bold fs-6 required">Username</label>
        <input type="text" value="{{ old('Shipment.vault_username', isset($model) ? $model->vault_username : '') }}" placeholder="Vault Username" id="v_username" name="vault_username" class="form-control @error('Shipment.vault_username') is-invalid @enderror" required />
        @error('Shipment.vault_username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="col-form-label fw-bold fs-6 required">Password</label>
        <input type="password" value="{{ old('Shipment.vault_password', isset($model) ? $model->vault_password : '') }}" placeholder="Vault Password" required name="vault_password" class="form-control @error('Shipment.vault_password') is-invalid @enderror" />
        @error('Shipment.vault_password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>



    <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">Retype Password</label>
          <input type="password" value="{{ old('Shipment.vault_password', isset($model) ? $model->vault_password : '') }}" placeholder="Vault Password" required name="vault_password" class="form-control @error('Shipment.vault_password') is-invalid @enderror" />
          @error('Shipment.vault_password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">Fullname</label>
          <input type="text" value="{{ old('Shipment.user_fullname', isset($model) ? $model->user_fullname : '') }}" placeholder="Fullname" id="v_username" name="user_fullname" class="form-control @error('Shipment.user_fullname') is-invalid @enderror" required />
          @error('Shipment.user_fullname')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label fw-bold fs-6 required">Email</label>
          <input type="Email" value="{{ old('Shipment.user_email', isset($model) ? $model->user_email : '') }}" placeholder="Email" id="v_username" name="user_email" class="form-control @error('Shipment.user_email') is-invalid @enderror" required />
          @error('Shipment.user_email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
    </div>

  </div>
</div>
</div>
</div>

{{-- Inject styles --}}
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.css" integrity="sha512-g4B+TyvVE4aa0Y1SgjMHnT/4M4IRl8jnG3Ha9ebg8VhLyrfaAqL5AHDh7zo0/ZdES57Y1E7wvWwsDzX806b1Gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css" integrity="sha512-0GlDFjxPsBIRh0ZGa2IMkNT54XGNaGqeJQLtMAw6EMEDQJ0WqpnU6COVA91cUS0CeVA5HtfBfzS9rlJR3bPMyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
@endsection

{{-- Inject Scripts --}}
@push('js-component')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js" integrity="sha512-0hFHNPMD0WpvGGNbOaTXP0pTO9NkUeVSqW5uFG2f5F9nKyDuHE3T4xnfKhAhnAZWZIO/gBLacwVvxxq0HuZNqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.js" integrity="sha512-k59zBVzm+v8h8BmbntzgQeJbRVBK6AL1doDblD1pSZ50rwUwQmC/qMLZ92/8PcbHWpWYeFaf9hCICWXaiMYVRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="{{ asset('assets/global/js/jquery.geocomplete.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$google_map_key}}"></script>

<script type="text/javascript">
  $("input[id=1]").change(function(){
    let opt = $("input[id=1]:checked").val();
    if(opt == '1'){

      $('.vault_show').hide();
      $('.vault_hide').show();
      $('button[id=kt_account_profile_details_submit]').attr("type", "button");
      $('button[id=kt_account_profile_details_submit]').attr("onclick", 'get_estimation_cost()');



    } else if(opt == '2'){

      $('.vault_show').hide();
      $('.vault_hide').show();
      $('button[id=kt_account_profile_details_submit]').attr("type", "button");
      $('button[id=kt_account_profile_details_submit]').attr("onclick", 'get_estimation_cost()');



    }else if(opt == '3'){

      $('.vault_hide').hide();
      $('.vault_show').show();
      $('button[id=kt_account_profile_details_submit]').attr("type", "submit");
      $('button[id=kt_account_profile_details_submit]').removeAttr("onclick");
    }
  });
</script>

<script>
        // Map Address For Receiver
        $('.address-receiver').each(function(){
          var address = $(this);
          address.geocomplete({
            map: ".map_canvas.map-receiver",
            mapOptions: {
              zoom: 8,
              center: { lat: -34.397, lng: 150.644 },
            },
            markerOptions: {
              draggable: true
            },
            details: ".location-receiver",
            detailsAttribute: 'data-receiver',
            autoselect: true,
            restoreValueAfterBlur: true,
          });
          address.bind("geocode:dragged", function(event, latLng){
            $("input[data-receiver=lat]").val(latLng.lat());
            $("input[data-receiver=lng]").val(latLng.lng());
          });
        });

        // Map Address For Client
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

        // IF Branches Select Not Have Branches
        @if(auth()->user()->can('create-branches') || $user_role == $admin)
        $('.select-branch').select2().on('select2:open', () => {
          $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('branches.create')}}?redirect=shipments.create"
            class="btn btn-primary" >+ {{ __('cargo::view.create_new_branch') }}</a>
            </li>`);
        });
        @endif

        var inputDate = $(`#kt_datepicker_3`);

        // Trigger date picker for Shipping Date
        inputDate.daterangepicker({
          showDropdowns: true,
          singleDatePicker: true,
          autoUpdateInput: false,
          autoclose: true,
          minYear: parseInt(moment().format('YYYY')) - 10,
          maxYear: parseInt(moment().format('YYYY')) + 10,
          todayHighlight: true,
          startDate: new Date(),
          todayBtn: true,
          locale: {
            format: "DD/MM/YYYY",
            cancelLabel: "{{ __('view.cancel') }}",
            applyLabel: "{{ __('view.apply') }}",
            "fromLabel": "{{ __('view.from') }}",
            "toLabel": "{{ __('view.to') }}",
            "customRangeLabel": "{{ __('datepicker.custom_range') }}",
            "weekLabel": "{{ __('datepicker.week_label') }}",
            "daysOfWeek": [
            "{{ __('datepicker.days_of_week.sunday') }}",
            "{{ __('datepicker.days_of_week.monday') }}",
            "{{ __('datepicker.days_of_week.tuesday') }}",
            "{{ __('datepicker.days_of_week.wednesday') }}",
            "{{ __('datepicker.days_of_week.thursday') }}",
            "{{ __('datepicker.days_of_week.friday') }}",
            "{{ __('datepicker.days_of_week.saturday') }}",
            ],
            "monthNames": [
            "{{ __('datepicker.month_names.january') }}",
            "{{ __('datepicker.month_names.february') }}",
            "{{ __('datepicker.month_names.march') }}",
            "{{ __('datepicker.month_names.april') }}",
            "{{ __('datepicker.month_names.may') }}",
            "{{ __('datepicker.month_names.june') }}",
            "{{ __('datepicker.month_names.july') }}",
            "{{ __('datepicker.month_names.august') }}",
            "{{ __('datepicker.month_names.september') }}",
            "{{ __('datepicker.month_names.october') }}",
            "{{ __('datepicker.month_names.november') }}",
            "{{ __('datepicker.month_names.december') }}",
            ],
          }
        }, cb);

        // call back after choose date
        function cb(start) {
          var apiDate = start ? start.format("YYYY-MM-DD H:m") : '';
          var inputShowDate = start ? (start.format("YYYY-MM-DD")) : '';
          if (start) {
            inputDate.val(inputShowDate);
          }
        }

        // Trigger time picker for Collection Time
        $('#kt_timepicker_3').daterangepicker({
          timePicker: true,
          singleDatePicker:true,
          timePicker24Hour: false,
          timePickerIncrement: 1,
          timePickerSeconds: true,
          startDate: moment(),
          locale: {
            format: 'HH:mm:ss A'
          }
        }).on('show.daterangepicker', function (ev, picker) {
          picker.container.find(".calendar-table").hide();
        });


        // IF Clients Select Not Have Clients
        @if(auth()->user()->can('create-clients') || $user_role == $admin || $user_role == $auth_branch)
        $('.select-client').select2().on('select2:open', () => {
          $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('clients.create')}}?redirect=shipments.create"
            class="btn btn-primary" >+ {{ __('cargo::view.create_new_client') }}</a>
            </li>`);
        });
        @endif

        // IF Payments Select Not Have Clients
        @if(auth()->user()->can('payments-settings') || $user_role == $admin)
        $('.payment-method').select2().on('select2:open', () => {
          $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('payments.index')}}?redirect=shipments.create"
            class="btn btn-primary" >+ {{ __('cargo::view.add_payment') }}</a>
            </li>`);
        });
        @endif

        // Set Client Phone After Select Client
        $('.select-client').change(function(){
          var client_phone = $(this).find(':selected').data('phone');
          document.getElementById("client_phone").value = client_phone;
        })
        $('.select-client-receiver').change(function(){
          var client_phone = $(this).find(':selected').data('phone');
          document.getElementById("client_phone_receiver").value = client_phone;
        })

        // Get Client Id
        function selectIdTriggered(type)
        {
          if(type == 'sender')
            getClientAddresses(document.getElementById("client-id").value,type);
          else if(type == 'receiver')
            getClientAddresses(document.getElementById("reciver_id").value,type);
        }

        $('.select-address').select2({
          placeholder: "{{ __('cargo::view.choose_client_first') }}",
        })

        // Ajax Get Client Addresses By Id
        function getClientAddresses(client_id,type)
        {
          var id = client_id;

          $.get("{{route('ajax-get-client-addresses-ajax')}}?client_id=" + id, function(data) {
            if(data.length != 0){

              $('select[name ="Shipment[client_address]"]').empty();
              $('select[name ="Shipment[client_address]"]').append('<option value=""></option>');
              for (let index = 0; index < data.length; index++) {
                const element = data[index];
                var old_client_address = {{old('Shipment.client_address') ? old('Shipment.client_address') : 'null'}};
                var edit_client_address = {{ isset($model) ? $model->client_address : 'null'}};
                if(element['is_default'] == 1 || old_client_address == element['id'] || edit_client_address == element['id']){
                  $('select[name ="Shipment[client_address]"]').append('<option selected value="' + element['id'] + '">' + element['address'] + '</option>');
                }else{
                  $('select[name ="Shipment[client_address]"]').append('<option value="' + element['id'] + '">' + element['address'] + '</option>');
                }

              }

              $('.select-address').select2({
                placeholder: "{{ __('cargo::view.choose_address') }}",
              })
              @if($user_role == $admin || $user_role == $auth_client || $user_role == $auth_branch || auth()->user()->can('manage-clients') )
              .on('select2:open', () => {

                $('.toRemoveLi').remove();

                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;' class='toRemoveLi'><a style="width: 100%" onclick="openAddressDiv()"
                  class="btn btn-primary" >+ {{ __('cargo::view.create_new_address') }}</a>
                  </li>`);
              });
              @endif
            }else{
              $('select[name ="Shipment[client_address]"]').empty();
              $('.select-address').select2({
                placeholder: "{{ __('cargo::view.no_addresses_found') }}",
              })
              @if($user_role == $admin || $user_role == $auth_client || auth()->user()->can('manage-clients') )
              .on('select2:open', () => {

                $('.toRemoveLi').remove();

                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;' class='toRemoveLi'><a style="width: 100%" onclick="openAddressDiv()"
                  class="btn btn-primary" >+ {{ __('cargo::view.create_new_address') }}</a>
                  </li>`);
              });
              @endif
            }
          });
        }

        @if(old('Shipment.client_id'))
        getClientAddresses({{old('Shipment.client_id')}});
        @endif
        // Ajax Get Address With Client logged in
        @if($user_role == $auth_client)
        getClientAddresses({{$userClient->id}});
        @endif

        // Ajax Add New Address For Client
        function AddNewClientAddress()
        {
          @if($user_role == $auth_client)
          var id                    = {{$userClient->id}};
          @else
          var id                    = document.getElementById("client-id").value;
          @endif
          var address                   = document.getElementsByName("client_address")[0].value;
          var country = $('select[name ="country_id"]').val();
          var state = $('select[name ="state_id"]').val();
          var area = $('select[name ="area_id"]').val();

          @if($googleMap)
          var client_street_address_map = document.getElementsByName("client_street_address_map")[0].value;
          var client_lat                = document.getElementsByName("client_lat")[0].value;
          var client_lng                = document.getElementsByName("client_lng")[0].value;
          var client_url                = document.getElementsByName("client_url")[0].value;
          if(address != "" && country != "" && state != "" && address != null && country != null && state != null )
          {
            $.post( "{{route('client.add.new.address')}}",
            {
              _token: "{{ csrf_token() }}",
              client_id: parseInt(id),
              address: address,
              client_street_address_map: client_street_address_map,
              client_lat: client_lat,
              client_lng: client_lng,
              client_url: client_url,
              country: country,
              state: state,
              area: area
            } , function(data){
              $('select[name ="Shipment[client_address]"]').empty();
              for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[client_address]"]').append('<option value="' + element['id'] + '">' + element['address'] + '</option>');
              }
              document.getElementsByName("client_address")[0].value            = "";
              document.getElementsByName("client_street_address_map")[0].value = "";
              document.getElementsByName("client_lat")[0].value = "";
              document.getElementsByName("client_lng")[0].value = "";
              document.getElementsByName("client_url")[0].value = "";
            });
          }else{
            Swal.fire("{{__('cargo::view.please_enter_all_reqired_fields') }}", "", "error");
          }
          @else
          if(address != "" && country != "" && state != "" && address != null && country != null && state != null )
          {
            $.post( "{{route('client.add.new.address')}}",
            {
              _token: "{{ csrf_token() }}",
              client_id: parseInt(id),
              address: address,
              country: country,
              state: state,
              area: area
            } , function(data){
              $('select[name ="Shipment[client_address]"]').empty();
              for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[client_address]"]').append('<option value="' + element['id'] + '">' + element['address'] + '</option>');
              }
              document.getElementsByName("client_address")[0].value  = "";
              var country = $('select[name ="country_id"]').val();
              var state = $('select[name ="state_id"]').val();
              var area = $('select[name ="area_id"]').val();
            });
          }else{
            Swal.fire("{{ __('cargo::view.please_enter_all_reqired_fields') }}", "", "error");
          }
          @endif
        }

        function openAddressDiv()
        {
          $( "#show_address_div" ).slideDown( "slow", function() {
                // Animation complete.
              });
        }
        function closeAddressDiv()
        {
          $( "#show_address_div" ).slideUp( "slow", function() {
                // Animation complete.
              });
        }


        $('#change-country-client-address').change(function() {
          var id = $(this).val();
          $.get("{{route('ajax.getStates')}}?country_id=" + id, function(data) {
            $('select[name ="state_id"]').empty();
            $('select[name ="state_id"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];

              $('select[name ="state_id"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }
          });
          @if(auth()->user()->can('add-covered-countries') || $user_role == $admin)
          $('.select-state').on('select2:open', () => {
            $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('countries.index')}}?redirect=shipments.create"
              class="btn btn-primary" >{{ __('cargo::view.manage')}} {{__('cargo::view.covered_countries') }}</a>
              </li>`);
          });
          @endif
        });
        $('#change-state-client-address').change(function() {
          var id = $(this).val();
          $.get("{{route('ajax.getAreas')}}?state_id=" + id, function(data) {
            $('select[name ="area_id"]').empty();
            $('select[name ="area_id"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];
              $('select[name ="area_id"]').append('<option value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
            }
          });

          @if(auth()->user()->can('create-areas') || $user_role == $admin)
          $('.select-area').on('select2:open', () => {
            $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('areas.create')}}?redirect=shipments.create"
              class="btn btn-primary" >{{ __('cargo::view.areas_management') }}</a>
              </li>`);
          });
          @endif
        });

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

        function changeCountry(id){
          $.get("{{route('ajax.getStates')}}?country_id=" + id, function(data) {
            $('select[name ="Shipment[from_state_id]"]').empty();
            $('select[name ="Shipment[from_state_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];

              var old_from_state = {{old('Shipment.from_state_id') ? old('Shipment.from_state_id') : 'null'}};
              if(old_from_state == element['id'] ){
                $('select[name ="Shipment[from_state_id]"]').append('<option selected value="' + element['id'] + '">' + element['name'] + '</option>');
              }else{
                $('select[name ="Shipment[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
              }
            }
          });
        }
        $('#change-country').change(function() {
          var id = $(this).val();
          changeCountry(id)
        });
        @if(old('Shipment.from_country_id'))
        changeCountry({{old('Shipment.from_country_id')}})
        @endif

        function changeCountryTo(id){
          $.get("{{route('ajax.getStates')}}?country_id=" + id, function(data) {
            $('select[name ="Shipment[to_state_id]"]').empty();
            $('select[name ="Shipment[to_state_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];
              var old_to_state = {{old('Shipment.to_state_id') ? old('Shipment.to_state_id') : 'null'}};
              if(old_to_state == element['id'] ){
                $('select[name ="Shipment[to_state_id]"]').append('<option selected value="' + element['id'] + '">' + element['name'] + '</option>');
              }else{
                $('select[name ="Shipment[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
              }
            }
          });
        }
        $('#change-country-to').change(function() {
          var id = $(this).val();
          changeCountryTo(id);
        });
        @if(old('Shipment.to_country_id'))
        changeCountryTo({{old('Shipment.to_country_id')}})
        @endif

        function changeStateFrom(id){
          $.get("{{route('ajax.getAreas')}}?state_id=" + id, function(data) {
            $('select[name ="Shipment[from_area_id]"]').empty();
            $('select[name ="Shipment[from_area_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];
              var old_from_area = {{old('Shipment.from_area_id') ? old('Shipment.from_area_id') : 'null'}};
              if(old_from_area == element['id'] ){
                $('select[name ="Shipment[from_area_id]"]').append('<option selected value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
              }else{
                $('select[name ="Shipment[from_area_id]"]').append('<option value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
              }
            }
          });
        }
        $('#change-state-from').change(function() {
          var id = $(this).val();
          changeStateFrom(id);
        });
        @if(old('Shipment.from_state_id'))
        changeStateFrom({{old('Shipment.from_state_id')}})
        @endif

        function changeStateTo(id){
          $.get("{{route('ajax.getAreas')}}?state_id=" + id, function(data) {
            $('select[name ="Shipment[to_area_id]"]').empty();
            $('select[name ="Shipment[to_area_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
              const element = data[index];
              var old_to_area = {{old('Shipment.to_area_id') ? old('Shipment.to_area_id') : 'null'}};
              if(old_to_area == element['id'] ){
                $('select[name ="Shipment[to_area_id]"]').append('<option selected value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
              }else{
                $('select[name ="Shipment[to_area_id]"]').append('<option value="' + element['id'] + '">' + JSON.parse(element['name'], true)[`{{app()->getLocale()}}`] + '</option>');
              }
            }
          });
        }
        $('#change-state-to').change(function() {
          var id = $(this).val();
          changeStateTo(id);
        });
        @if(old('Shipment.to_state_id'))
        changeStateTo({{old('Shipment.to_state_id')}})
        @endif

        //Package Types Repeater

        $('#kt_repeater_1').repeater({
          initEmpty: false,

          show: function() {
            $(this).slideDown();

            $('.dimensions_r').TouchSpin({
              buttondown_class: 'btn btn-secondary',
              buttonup_class: 'btn btn-secondary',

              min: 1,
              max: 1000000000,
              stepinterval: 50,
              maxboostedstep: 10000000,
              initval: 1,
            });

            $('.kt_touchspin_weight').TouchSpin({
              buttondown_class: 'btn btn-secondary',
              buttonup_class: 'btn btn-secondary',

              step: 0.5,
              min: 0.5,
              boostat: 5,
              min: 1,
              max: 1000000000,
              stepinterval: 50,
              maxboostedstep: 50,
              initval: 1,
              prefix: 'Kg'
            });
            $('.kt_touchspin_qty').TouchSpin({
              buttondown_class: 'btn btn-secondary',
              buttonup_class: 'btn btn-secondary',

              min: 1,
              max: 1000000000,
              stepinterval: 50,
              maxboostedstep: 10000000,
              initval: 1,
            });
            calcTotalWeight();
          },

          hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
          },

          isFirstItemUndeletable: true
        });

        $('body').on('click', '.delete_item', function(){
          $('.total-weight').val("{{ __('cargo::view.calculated') }}");
          setTimeout(function(){ calcTotalWeight(); }, 500);
        });

        $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
          buttondown_class: 'btn btn-secondary',
          buttonup_class: 'btn btn-secondary',

          min: -1000000000,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 10000000,
          prefix: '%'
        });
        $('#kt_touchspin_3, #kt_touchspin_3_shipping_cost, #kt_touchspin_3_3').TouchSpin({
          buttondown_class: 'btn btn-secondary',
          buttonup_class: 'btn btn-secondary',

          min: 0,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 10000000,
          prefix: '$'
        });
        $('.kt_touchspin_weight').TouchSpin({
          buttondown_class: 'btn btn-secondary',
          buttonup_class: 'btn btn-secondary',

          step: 0.5,
          decimals: 1,
          boostat: 5,
          min: 0.5,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 50,
          initval: 1,
          prefix: 'Kg'
        });
        $('.kt_touchspin_qty').TouchSpin({
          buttondown_class: 'btn btn-secondary',
          buttonup_class: 'btn btn-secondary',

          min: 1,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 10000000,
          initval: 1,
        });
        $('.dimensions_r').TouchSpin({
          buttondown_class: 'btn btn-secondary',
          buttonup_class: 'btn btn-secondary',

          min: 1,
          max: 1000000000,
          stepinterval: 50,
          maxboostedstep: 10000000,
          initval: 1,
        });

        $('.delivery-time').select2({ placeholder: "{{ __('cargo::view.delivery_time') }}" })
        @if(auth()->user()->can('create-delivery-time') || $user_role == $admin)
        .on('select2:open', () => {
          $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('deliveryTime.create')}}?redirect=shipments.create"
            class="btn btn-primary" >{{ __('cargo::view.manage')}} {{__('cargo::view.delivery_time') }}</a>
            </li>`);
        });
        @endif

        function calcTotalWeight() {
          var elements = $('.weight-listener');
          var sumWeight = 0;
          elements.map(function() {
            sumWeight += parseFloat($(this).val());
          }).get();
          $('.total-weight').val(sumWeight);
        }

        function get_estimation_cost() {
          var total_weight = document.getElementById('kt_touchspin_4').value;
          var select_packages = document.getElementsByClassName('package-type-select');

          var from_country_id = document.getElementsByName("Shipment[from_country_id]")[0].value;
          var to_country_id = document.getElementsByName("Shipment[to_country_id]")[0].value;
          var from_state_id = document.getElementsByName("Shipment[from_state_id]")[0].value;
          var to_state_id = document.getElementsByName("Shipment[to_state_id]")[0].value;
          var from_area_id = document.getElementsByName("Shipment[from_area_id]")[0].value;
          var to_area_id = document.getElementsByName("Shipment[to_area_id]")[0].value;
          @if($user_role == $auth_client)
          var client_id = {{$userClient->id}};
          @else
          var client_id = document.getElementById("client-id").value;
          console.log(client_id);
          @endif

          var package_ids = [];
          for (let index = 0; index < select_packages.length; index++) {
                //if(select_packages[index].value){
                  package_ids[index] = new Object();
                  package_ids[index]["package_id"] = 0;

                //}else{
                //    Swal.fire("{{ __('cargo::view.please_select_package_type')}}" + (index+1), "", "error");
                //    return 0;
                //}
              }

              var request_data = { _token : '{{ csrf_token() }}',
              package_ids : package_ids,
              total_weight : total_weight,
              from_country_id : from_country_id,
              to_country_id : to_country_id,
              from_state_id : from_state_id,
              to_state_id : to_state_id,
              from_area_id : from_area_id,
              to_area_id : to_area_id,
              client_id : client_id,
            };
            $.post('{{ route('shipments.get-estimation-cost') }}', request_data, function(response){

              if({{$is_def_mile_or_fees}} =='2')
              {
                document.getElementById("shipping_cost").innerHTML = response.shipping_cost;
                document.getElementById("return_cost").innerHTML = response.return_cost;
              }else if({{$is_def_mile_or_fees}} =='1')
              {
                document.getElementById("mile_cost").innerHTML = response.shipping_cost;
                document.getElementById("return_mile_cost").innerHTML = response.return_cost;
              }
              document.getElementById("tax_duty").innerHTML = response.tax;
              document.getElementById("insurance").innerHTML = response.insurance;
              document.getElementById("total_cost").innerHTML = response.total_cost;
              document.getElementById('modal_open').click();
                //console.log(document);
              });
          }

        </script>
        @endpush
