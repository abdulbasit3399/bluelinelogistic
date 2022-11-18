@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('Edit Goods Tracking') }}
@endsection

@section('content')
<div class="container mt-4">
<div class="card">
    <div class="card-header">
        <div class="row">
        <h3 class="pt-3 bl">Edit Goods Tracking #{{ $model->id }}</h3>
        <p class="bl">You Edit tracking from here</p>
    </div>
    </div>
    <form id="" class="form" action="{{ route('shipments.update.goodtrack') }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card-body ">
            <div class="row">
                <h4 class="bl mt-3">User info</h4>
                <div class="col-md-6 py-2">
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
                <div class="col-md-6 py-2">
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

                <div class="col-md-6 py-2">
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
                <div class="col-md-6 py-2">
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
                <div class="col-md-6 py-2">
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
            <div class="row mt-4">
                <h4 class="bl">Tracking info</h4>

                {{--  <input type="hidden" name="Shipment[type]" value="3">  --}}

            <div class="row">
                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Receipt no.</label>
                    <input type="text" value="{{ old('Shipment.receipt_number', isset($model) ? $model->receipt_number : '') }}" readonly placeholder="Receipt no." name="receipt_number" required class="form-control @error('Shipment.receipt_number') is-invalid @enderror" />
                    @error('Shipment.receipt_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Tracking no.</label>
                    <input type="text" value="{{ old('Shipment.code', isset($model) ? $model->code : '') }}" readonly placeholder="Tracking no." name="code" required class="form-control @error('Shipment.code') is-invalid @enderror" />
                    @error('Shipment.code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Tracking Status</label>
                    <input type="text" value="{{ old('Shipment.status', isset($model) ? $model->status : '') }}" placeholder="Status" name="status" id="status" required class="form-control @error('Shipment.status') is-invalid @enderror" />
                    
                    {{--  <select class="form-control select2" data-placeholder="Select Status"
                        data-allow-clear="true" data-control="select2" name="status" required>

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
                    </select>  --}}
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Departure Time</label>
                    <input type="date" value="{{ old('Shipment.depart_time', isset($model) ? $model->depart_time : '') }}" placeholder="Date of Deposit" required name="depart_time" class="form-control @error('Shipment.depart_time') is-invalid @enderror" />
                    @error('Shipment.depart_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Delivered To</label>
                    <input type="text" value="{{ old('Shipment.reciver_name', isset($model) ? $model->reciver_name : '') }}" placeholder="Delivered To" name="reciver_name" required class="form-control @error('Shipment.reciver_name') is-invalid @enderror" />
                    @error('Shipment.reciver_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Items</label>
                    <input type="text" value="{{ old('Shipment.items', isset($model) ? $model->items : '') }}" placeholder="Items" name="items" required class="form-control @error('Shipment.items') is-invalid @enderror" />
                    @error('Shipment.items')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Total Weight</label>
                    <input type="text" value="{{ old('Shipment.total_weight', isset($model) ? $model->total_weight : '') }}" placeholder="Total Weight" name="total_weight" required class="form-control @error('Shipment.total_weight') is-invalid @enderror" />
                    @error('Shipment.total_weight')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Service Type</label>
                    <input type="text" value="{{ old('Shipment.service', isset($model) ? $model->service : '') }}" placeholder="Service Type" name="service" required class="form-control @error('Shipment.service') is-invalid @enderror" />
                    @error('Shipment.service')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Billing Address</label>
                    <input type="text" value="{{ old('Shipment.client_address', isset($model) ? $model->client_address : '') }}" placeholder="Billing Address" name="client_address" required class="form-control @error('Shipment.client_address') is-invalid @enderror" />
                    @error('Shipment.client_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Shipping Address</label>
                    <input type="text" value="{{ old('Shipment.reciver_address', isset($model) ? $model->reciver_address : '') }}" placeholder="Shipping Address" name="reciver_address" required class="form-control @error('Shipment.reciver_address') is-invalid @enderror" />
                    @error('Shipment.reciver_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Country</label>
                    <select class="form-control select4" name="goods_country" id="countries">
                        <option value="option_select">Please Select</option>
                         @foreach($country_data as $country)
                         <option value="{{$country->id}}" {{$country->name == $country->id  ? 'selected' : ''}}>{{$country->name}}</option>
                         @endforeach</select>

                    @error('Shipment.goods_country')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Shipped/Billed on</label>
                    <input type="date" value="{{ old('Shipment.d_o_deposit', isset($model) ? $model->d_o_deposit : '') }}" placeholder="Shipped/Billed on" required name="d_o_deposit" class="form-control @error('Shipment.d_o_deposit') is-invalid @enderror" />
                    @error('Shipment.d_o_deposit')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Payment Status</label>
                    <input type="text" value="{{ old('Shipment.payment_status', isset($model) ? $model->payment_status : '') }}" placeholder="Payment Status" name="payment_status" id="payment_status" required class="form-control @error('Shipment.payment_status') is-invalid @enderror" />
                    
                    {{--  <select class="form-control select2" data-placeholder="Select Status"
                        data-allow-clear="true" data-control="select2" name="payment_status" required>

                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                        <option value="Cancelled">Cancelled</option>

                    </select>  --}}
                    </div>
                </div>

                <div class="col-md-6 py-2">
                    <div class="form-group">
                    <label class="col-form-label fw-bold fs-6 required">Estimated Delivery Date</label>
                    <input type="date" value="{{ old('Shipment.estimated_delivery_date', isset($model) ? $model->estimated_delivery_date : '') }}" placeholder="Estimated Delivery Date" required name="estimated_delivery_date" class="form-control @error('Shipment.estimated_delivery_date') is-invalid @enderror" />
                    @error('Shipment.estimated_delivery_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-start py-6 px-9">
            {{--  <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>  --}}
            <button type="submit" class="btn btn-success text-start" id="">@lang('Edit')</button>
        </div>
    </form>

</div>
</div>
@endsection
