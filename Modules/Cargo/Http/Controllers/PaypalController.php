<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Order;
use Modules\Cargo\Entities\BusinessSetting;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
use Omnipay\Omnipay;
use Omnipay\PayPal;

use Modules\Currency\Entities\Currency;

class PaypalController
{

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');


        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        $paypal_payment = json_decode($paymentSettings['paypal_payment'], true);

        $PAYPAL_SANDBOX_CLIENT_ID     = $paypal_payment['PAYPAL_SANDBOX_CLIENT_ID'] ?? '';
        $PAYPAL_SANDBOX_CLIENT_SECRET = $paypal_payment['PAYPAL_SANDBOX_CLIENT_SECRET'] ?? '';
        $PAYPAL_LIVE_CLIENT_ID        = $paypal_payment['PAYPAL_LIVE_CLIENT_ID'] ?? '';
        $PAYPAL_LIVE_CLIENT_SECRET    = $paypal_payment['PAYPAL_LIVE_CLIENT_SECRET'] ?? '';
        $PAYPAL_MODE                  = $paypal_payment['PAYPAL_MODE'] == 1 ? 'sandbox' : 'live';


        $this->gateway->setClientId($PAYPAL_SANDBOX_CLIENT_ID);
        $this->gateway->setSecret($PAYPAL_SANDBOX_CLIENT_SECRET);
        $this->gateway->setTestMode(true);
        
    }

    public function getCheckout($shipment)
    {        
         $price = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
   
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => number_format($price, 2, '.', ''),
                    'currency' => Currency::where('default',1)->first()->code ?? 'USD',
                    'returnUrl' => route('paypal.success'),
                    'cancelUrl' => route('paypal.error'),
                ))->send();

                
                    if($response->isRedirect()) {
                        
                         $response->redirect();
                    } else {
                        return $response->getMessage();
                    }

            } catch (Exception $e) {
                return $e->getMessage();
            }

    }

    public function success(Request $request) 
    {
       
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'          => $request->input('PayerID'),
                'transactionReference'  => $request->input('paymentId'),
            ));

            $response = $transaction->send();


            if($response->getData()) {


                $arr_body = $response->getData();

                $payment = ["status" => "Success"];
    
                // if ($payment_type == 'cart_payment') {
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done( null, $payment, Session::get('order_id'));

            } else {
                return $response->getMessage();
            }

        } else {
            return 'transaction is decliened';
        }
    }

    public function error()
    {
        return 'user cancelled the payment';
    }

}
