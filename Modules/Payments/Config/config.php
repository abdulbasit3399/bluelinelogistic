<?php

if(env('INSTALLATION', false) == true){
    if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
        $paymentSettings = app(\Modules\Payments\Entities\PaymentSetting::class);
    }else{
        $paymentSettings = new stdClass();
        //define default values for the used properties
        $paymentSettings->paypal_payment = $paymentSettings->paystack = $paymentSettings->sslcommerz_payment = $paymentSettings->instamojo_payment = $paymentSettings->razorpay = $paymentSettings->stripe_payment = $paymentSettings->voguepay = $paymentSettings->payhere = $paymentSettings->ngenius = $paymentSettings->iyzico = $paymentSettings->cash_payment = $paymentSettings->invoice_payment = null;
    }
}else{
    $paymentSettings = new stdClass();
    //define default values for the used properties
    $paymentSettings->paypal_payment = $paymentSettings->paystack = $paymentSettings->sslcommerz_payment = $paymentSettings->instamojo_payment = $paymentSettings->razorpay = $paymentSettings->stripe_payment = $paymentSettings->voguepay = $paymentSettings->payhere = $paymentSettings->ngenius = $paymentSettings->iyzico = $paymentSettings->cash_payment = $paymentSettings->invoice_payment = null;
}


return [
    'name' => 'Payments' ,


    'permissions' => [
        'settings' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'payments-settings',            
        ],
    ],

    'payments' => [

        'paypal_payment'   =>  array(
            'label'         =>  'cargo::view.paypal_payment_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->paypal_payment ? $paymentSettings->paypal_payment : ''),
            'array'         =>  array(
                
                'PAYPAL_LIVE_CLIENT_ID'     =>   [
                    'label'         =>  'Paypal Live Client Id',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paypal_payment ? json_decode($paymentSettings->paypal_payment, true)['PAYPAL_LIVE_CLIENT_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYPAL_LIVE_CLIENT_SECRET'     =>   [
                    'label'         =>  'Paypal Live Client Secret',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paypal_payment ? json_decode($paymentSettings->paypal_payment, true)['PAYPAL_LIVE_CLIENT_SECRET'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYPAL_MODE'     =>   [
                    'label'         =>  'Paypal Sandbox Mode',
                    'default'       =>  false,
                    'type'          =>  'bool',
                    'value'         =>   ($paymentSettings->paypal_payment ? json_decode($paymentSettings->paypal_payment, true)['PAYPAL_MODE'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYPAL_SANDBOX_CLIENT_ID'     =>   [
                    'label'         =>  'Paypal Sandbox Client Id',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paypal_payment ? json_decode($paymentSettings->paypal_payment, true)['PAYPAL_SANDBOX_CLIENT_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYPAL_SANDBOX_CLIENT_SECRET'     =>   [
                    'label'         =>  'Paypal Sandbox Client Secret',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paypal_payment ? json_decode($paymentSettings->paypal_payment, true)['PAYPAL_SANDBOX_CLIENT_SECRET'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'paystack'   =>  array(
            'label'         =>  'cargo::view.payStack_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->paystack ? $paymentSettings->paystack : ''),
            'array'         =>  array(
                'PAYSTACK_PUBLIC_KEY'     =>   [
                    'label'         =>  'PUBLIC KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paystack ? json_decode($paymentSettings->paystack, true)['PAYSTACK_PUBLIC_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYSTACK_SECRET_KEY'     =>   [
                    'label'         =>  'SECRET KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paystack ? json_decode($paymentSettings->paystack, true)['PAYSTACK_SECRET_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYSTACK_MERCHANT_EMAIL'     =>   [
                    'label'         =>  'PAYSTACK MERCHANT EMAIL',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->paystack ? json_decode($paymentSettings->paystack, true)['PAYSTACK_MERCHANT_EMAIL'] ?? '' : ''),
                    'required'      =>  true
                ],
                'NOTE_1'=>   [
                    'label'         =>  'NOTE',
                    'type'          =>  'note',
                    'value'         =>  'Set Currency Of System In PayStack Account',
                    'help_link'     =>  'https://support.paystack.com/hc/en-us/articles/360009973799-Can-I-accept-payments-in-USD-'
                ],
                'NOTE_2'=>   [
                    'label'         =>  'NOTE',
                    'type'          =>  'note',
                    'value'         =>  'Set Callback URL In PayStack Account Ex: https://YOUR_BASE_URL/paystack/payment/callback',
                    'help_link'     =>  'https://support.paystack.com/hc/en-us/articles/360009881600-Paystack-Test-Keys-Live-Keys-and-Webhooks'
                ],
            )
        ),
        'sslcommerz_payment'   =>  array(
            'label'         =>  'cargo::view.sSlCommerz_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->sslcommerz_payment ? $paymentSettings->sslcommerz_payment : ''),
            'array'         =>  array(
                'SSLCZ_STORE_ID'     =>   [
                    'label'         =>  'SSLCZ STORE ID',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->sslcommerz_payment ? json_decode($paymentSettings->sslcommerz_payment, true)['SSLCZ_STORE_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'SSLCZ_STORE_PASSWD'     =>   [
                    'label'         =>  'Sslcz Store Password',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->sslcommerz_payment ? json_decode($paymentSettings->sslcommerz_payment, true)['SSLCZ_STORE_PASSWD'] ?? '' : ''),
                    'required'      =>  true
                ],
                'sslcommerz_sandbox'     =>   [
                    'label'         =>  'Sslcommerz Sandbox Mode',
                    'default'       =>  true,
                    'type'          =>  'bool',
                    'value'         =>   ($paymentSettings->sslcommerz_payment ? json_decode($paymentSettings->sslcommerz_payment, true)['sslcommerz_sandbox'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'instamojo_payment'   =>  array(
            'label'         =>  'cargo::view.instamojo_payment_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->instamojo_payment ? $paymentSettings->instamojo_payment : ''),
            'array'         =>  array(
                'IM_API_KEY'     =>   [
                    'label'         =>  'API KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->instamojo_payment ? json_decode($paymentSettings->instamojo_payment, true)['IM_API_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'IM_AUTH_TOKEN'     =>   [
                    'label'         =>  'AUTH TOKEN',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->instamojo_payment ? json_decode($paymentSettings->instamojo_payment, true)['IM_AUTH_TOKEN'] ?? '' : ''),
                    'required'      =>  true
                ],
                'instamojo_sandbox'     =>   [
                    'label'         =>  'Instamojo Sandbox Mode',
                    'default'       =>  true,
                    'type'          =>  'bool',
                    'value'         =>  ($paymentSettings->instamojo_payment ? json_decode($paymentSettings->instamojo_payment, true)['instamojo_sandbox'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'razorpay'   =>  array(
            'label'         =>  'cargo::view.razor_pay_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->razorpay ? $paymentSettings->razorpay : ''),
            'array'         =>  array(
                'RAZOR_KEY'     =>   [
                    'label'         =>  'RAZOR KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->razorpay ? json_decode($paymentSettings->razorpay, true)['RAZOR_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'RAZOR_SECRET'     =>   [
                    'label'         =>  'RAZOR SECRET',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->razorpay ? json_decode($paymentSettings->razorpay, true)['RAZOR_SECRET'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'stripe_payment'   =>  array(
            'label'         =>  'cargo::view.stripe_payment_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->stripe_payment ? $paymentSettings->stripe_payment : ''),
            'array'         =>  array(
                'STRIPE_KEY'     =>   [
                    'label'         =>  'Stripe Key',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->stripe_payment ? json_decode($paymentSettings->stripe_payment, true)['STRIPE_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'STRIPE_SECRET'     =>   [
                    'label'         =>  'Stripe Secret',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->stripe_payment ? json_decode($paymentSettings->stripe_payment, true)['STRIPE_SECRET'] ?? '' : ''),
                    'required'      =>  true
                ]
            )
        ),
        'voguepay'   =>  array(
            'label'         =>  'cargo::view.voguePay_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->voguepay ? $paymentSettings->voguepay : ''),
            'array'         =>  array(
                'VOGUE_MERCHANT_ID'     =>   [
                    'label'         =>  'MERCHANT ID',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->voguepay ? json_decode($paymentSettings->voguepay, true)['VOGUE_MERCHANT_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'voguepay_sandbox'     =>   [
                    'label'         =>  'VoguePay Sandbox Mode',
                    'default'       =>  true,
                    'type'          =>  'bool',
                    'value'         =>  ($paymentSettings->voguepay ? json_decode($paymentSettings->voguepay, true)['voguepay_sandbox'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'payhere'   =>  array(
            'label'         =>  'cargo::view.payhere_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->payhere ? $paymentSettings->payhere : ''),
            'array'         =>  array(
                'PAYHERE_MERCHANT_ID'     =>   [
                    'label'         =>  'PAYHERE MERCHANT ID',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->payhere ? json_decode($paymentSettings->payhere, true)['PAYHERE_MERCHANT_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYHERE_SECRET'     =>   [
                    'label'         =>  'PAYHERE SECRET',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->payhere ? json_decode($paymentSettings->payhere, true)['PAYHERE_SECRET'] ?? '' : ''),
                    'required'      =>  true
                ],
                'PAYHERE_CURRENCY'     =>   [
                    'label'         =>  'PAYHERE CURRENCY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->payhere ? json_decode($paymentSettings->payhere, true)['PAYHERE_CURRENCY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'payhere_sandbox'     =>   [
                    'label'         =>  'Payhere Sandbox Mode',
                    'default'       =>  true,
                    'type'          =>  'bool',
                    'value'         =>  ($paymentSettings->payhere ? json_decode($paymentSettings->payhere, true)['payhere_sandbox'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'ngenius'   =>  array(
            'label'         =>  'cargo::view.ngenius_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->ngenius ? $paymentSettings->ngenius : ''),
            'array'         =>  array(
                'NGENIUS_OUTLET_ID'     =>   [
                    'label'         =>  'NGENIUS OUTLET ID',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->ngenius ? json_decode($paymentSettings->ngenius, true)['NGENIUS_OUTLET_ID'] ?? '' : ''),
                    'required'      =>  true
                ],
                'NGENIUS_API_KEY'     =>   [
                    'label'         =>  'NGENIUS API KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->ngenius ? json_decode($paymentSettings->ngenius, true)['NGENIUS_API_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'NGENIUS_CURRENCY'     =>   [
                    'label'         =>  'NGENIUS CURRENCY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->ngenius ? json_decode($paymentSettings->ngenius, true)['NGENIUS_CURRENCY'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'iyzico'   =>  array(
            'label'         =>  'cargo::view.iyzico_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->iyzico ? $paymentSettings->iyzico : ''),
            'array'         =>  array(
                'IYZICO_API_KEY'     =>   [
                    'label'         =>  'IYZICO API KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->iyzico ? json_decode($paymentSettings->iyzico, true)['IYZICO_API_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'IYZICO_SECRET_KEY'     =>   [
                    'label'         =>  'IYZICO SECRET KEY',
                    'type'          =>  'string',
                    'value'         =>  ($paymentSettings->iyzico ? json_decode($paymentSettings->iyzico, true)['IYZICO_SECRET_KEY'] ?? '' : ''),
                    'required'      =>  true
                ],
                'iyzico_sandbox'     =>   [
                    'label'         =>  'Iyzico Sandbox Mode',
                    'default'       =>  true,
                    'type'          =>  'bool',
                    'value'         =>  ($paymentSettings->iyzico ? json_decode($paymentSettings->iyzico, true)['iyzico_sandbox'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'cash_payment'   =>  array(
            'label'         =>  'cargo::view.cash_payment_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->cash_payment ? $paymentSettings->cash_payment : ''),
            'array'         =>  array()
        ),
        'invoice_payment'   =>  array(
            'label'         =>  'cargo::view.invoice_payment_activation',
            'type'          =>  'array_boolen',
            'migrate'       =>  true,
            'value'         =>  ($paymentSettings->invoice_payment ? $paymentSettings->invoice_payment : ''),
            'array'         =>  array()
        ),
    ],
];
