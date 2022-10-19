<style>
    canvas#signaturePad {
        background-color: #f7f8fa;
        border: 1px solid #ebedf2;
        width: 100%;
        display: block;
        border-radius: 5px;
        color: #000;
        margin-top:5px;
    }
    #signaturePadImg{
        display:none;
    }
</style>
@php
    $mission = Modules\Cargo\Entities\Mission::where('id', $mission->id)->first();
    $helper = new Modules\Cargo\Http\Helpers\TransactionHelper();
    $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);
@endphp
<form id="kt_form_1" class="kt_form" action="{{route('admin.missions.action',['to'=>Modules\Cargo\Entities\Mission::DONE_STATUS])}}" method="POST">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title h6">{{ __('cargo::view.confirm_mission_done') }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('cargo::view.amount') }}:</label>
                    <input type="hidden" class="form-control mb-4" value="{{$mission->id}}" name="ids[]" />
                    @if($mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::DELIVERY_TYPE  && $mission->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)
                        <input type="hidden" class="form-control mb-4" value="{{$shipment->id}}" name="shipment_id" />
                    @endif


                    @if($mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::DELIVERY_TYPE && $mission->status_id == Modules\Cargo\Entities\Mission::RECIVED_STATUS)
                        @if($shipment->payment_type == Modules\Cargo\Entities\Shipment::POSTPAID)
                            <input type="number" class="form-control mb-4"  value="{{ $shipment->amount_to_be_collected + $shipment->shipping_cost + $shipment->tax + $shipment->insurance }}" name="amount"
                                style="background:#f3f6f9;color:#3f4254;" disabled /> 
                        @elseif($shipment->payment_type == Modules\Cargo\Entities\Shipment::PREPAID)

                            @if($mission->getRawOriginal('type') == Modules\Cargo\Entities\Mission::DELIVERY_TYPE)
                                <input type="number" class="form-control mb-4"  value="{{ $shipment->amount_to_be_collected }}" name="amount"
                                style="background:#f3f6f9;color:#3f4254;" disabled /> 
                            @else
                                <input type="number" class="form-control mb-4"  value="{{ $shipment->shipping_cost + $shipment->tax + $shipment->insurance }}" name="amount"
                                style="background:#f3f6f9;color:#3f4254;" disabled /> 
                            @endif

                        @endif
                    @else
                        <input type="number" class="form-control mb-4" value="{{$shipment_cost}}" name="amount" style="background:#f3f6f9;color:#3f4254;" disabled />
                    @endif
                        
                </div>
            </div>

        </div>
        @if(Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipment_conf_type') == 'seg' && ( $mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::DELIVERY_TYPE || $mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::SUPPLY_TYPE ) )
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('cargo::view.draw_customer_signature') }}:</label>
                        <div class="signature_container">
                            <div class="btn-group" role="group" aria-label="First group">
                                <button type="button" class="btn btn-sm btn-primary" id="undo"><i class="la la-undo"></i> {{'Undo'}}</button>
                                <button type="button" class="btn btn-sm btn-warning" id="clear"><i class="la la-remove"></i> {{'Clear'}}</button>
                            </div>
                            <canvas id="signaturePad"></canvas>
                            <textarea type="hidden" id="signaturePadImg" name="signaturePadImg" class="kt-hide"></textarea>
                        </div>
                        <span class="form-text text-muted">{{'You can use your mouse to draw it, or if you using your mobile then you can use the touch screen to write it by your finger'}}</span>
                    </div>
                </div>
            </div>
        @elseif(Modules\Cargo\Entities\ShipmentSetting::getVal('def_shipment_conf_type') == 'otp' && ( $mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::DELIVERY_TYPE || $mission->getRawOriginal('type') ==  Modules\Cargo\Entities\Mission::SUPPLY_TYPE ) )
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('cargo::view.OTP') }}:</label>

                        <input type="text" name="otp_confirm" class="form-control mb-4" value="" name="otp" />
                    </div>
                </div>

            </div>
        @endif

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cargo::view.close') }}</button>
        <button type="submit" id="confirm" class="btn btn-primary">{{ __('cargo::view.confirm_amount_and_done') }}</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    var canvas = document.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
    });

    document.getElementById('undo').addEventListener('click', function () {
        var data = signaturePad.toData();
            if (data) {
            data.pop(); // remove the last dot or line
            signaturePad.fromData(data);
            }
    });


    $('body').on('click', '#confirm', function(e, clickedIndex, newValue, oldValue){
        e.preventDefault();
        var dataURL = canvas.toDataURL();
        var teet = signaturePad.toDataURL("data:image/png;base64,signature");
        $('#signaturePadImg').val(dataURL);
        $('.kt_form').submit();
    });
    
</script>
