
<!DOCTYPE html>
@php 
// Creating an environment
$paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
$paypal_payment = json_decode($paymentSettings['paypal_payment'], true);

$PAYPAL_SANDBOX_CLIENT_ID     = $paypal_payment['PAYPAL_SANDBOX_CLIENT_ID'] ?? '';
$PAYPAL_SANDBOX_CLIENT_SECRET = $paypal_payment['PAYPAL_SANDBOX_CLIENT_SECRET'] ?? '';
$PAYPAL_LIVE_CLIENT_ID        = $paypal_payment['PAYPAL_LIVE_CLIENT_ID'] ?? '';
$PAYPAL_LIVE_CLIENT_SECRET    = $paypal_payment['PAYPAL_LIVE_CLIENT_SECRET'] ?? '';
$PAYPAL_MODE                  = $paypal_payment['PAYPAL_MODE'] == 1 ? 'sandbox' : 'live';

if($PAYPAL_MODE == 'sandbox'){
    $client_id = $PAYPAL_SANDBOX_CLIENT_ID;
    $client_secret = $PAYPAL_SANDBOX_CLIENT_SECRET;
}else{
    $client_id = $PAYPAL_LIVE_CLIENT_ID;
    $client_secret = $PAYPAL_LIVE_CLIENT_SECRET;
}

if(Modules\Currency\Entities\Currency::where('default',1)->first()->code){
    $currency = Modules\Currency\Entities\Currency::where('default',1)->first()->code;
}else{
    $currency = 'USD';
}
@endphp
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="{{'https://www.paypal.com/sdk/js?client-id=AdWS7IbBm_7A3pvIKadC1_kDnNSL_mDYHdDklXDtpHsh3ZA4rXjWtAEOZ9qEBy7KtG49ZtAJj-TZa3x8&currency=USD'}}"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Call your server to set up the transaction
            createOrder: function(data, actions) {

                return fetch( 'paypal/order/create/', {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json; charset=UTF-8',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        'value': {{$shipment->tax + $shipment->shipping_cost + $shipment->insurance}},
                        'id': {{$shipment->id}},
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }

        }).render('#paypal-button-container');
    </script>
</body>

</html>
    