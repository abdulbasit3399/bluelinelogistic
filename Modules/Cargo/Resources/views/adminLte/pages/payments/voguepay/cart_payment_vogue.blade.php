<script src="//pay.voguepay.com/js/voguepay.js"></script>
<script src="//voguepay.com/js/voguepay.js"></script>
@php 
    $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
    $voguepay_payment = json_decode($paymentSettings['voguepay'], true);
@endphp
<script>
    closedFunction=function() {
        location.href = '{{ env('APP_URL') }}'
    }

    successFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/success/'+transaction_id
    }
    failedFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/failure/'+transaction_id
    }
</script>
@if ($voguepay_payment['voguepay_sandbox'] == 1)
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="{{ $voguepay_payment['VOGUE_MERCHANT_ID'] }}">
@else
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="{{ $voguepay_payment['VOGUE_MERCHANT_ID'] }}">
@endif

<script>

        window.onload = function(){
            console.log(document.getElementById("merchant_id").value);
            pay3();
            console.log('salman');
        }

        function pay3() {
         Voguepay.init({
             v_merchant_id: document.getElementById("merchant_id").value,
             total: '{{round($shipment->tax + $shipment->shipping_cost + $shipment->insurance * 100)}}',
             cur: 'NGN',
             merchant_ref: 'ref123',
             memo: 'Payment for shipping',
             developer_code: '5a61be72ab323',
             loadText:'Custom load text',

            customer: {
                name: '{{ $shipment->client->name }}',
                address: '{{ $shipment->from_address->address }}',
                city: '{{ $shipment->to_country->name }}',
                state: '{{ $shipment->to_state->name }}',
                zipcode: '1234',
                email: '{{ $shipment->client->email }}',
                phone: '{{ $shipment->client->responsible_mobile }}'
            },
             closed:closedFunction,
             success:successFunction,
             failed:failedFunction
         });
        }
</script>

