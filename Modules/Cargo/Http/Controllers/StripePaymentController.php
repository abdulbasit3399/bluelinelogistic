<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Currency\Entities\Currency;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
use Stripe\Stripe;
use Modules\Cargo\Entities\Shipment;

class StripePaymentController
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.payments.stripe');
    }

    public function create_checkout_session(Request $request) {
        $amount = 0;
        //if($request->session()->has('payment_type')){
            //if($request->session()->get('payment_type') == 'cart_payment'){
                $shipment = Shipment::findOrFail(Session::get('order_id'));
                $amount = round( ($shipment->tax + $shipment->shipping_cost + $shipment->insurance) * 100);
            // }
            // elseif ($request->session()->get('payment_type') == 'wallet_payment') {
            //     $amount = round($request->session()->get('payment_data')['amount'] * 100);
            // }
            // elseif ($request->session()->get('payment_type') == 'customer_package_payment') {
            //     $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
            //     $amount = round($customer_package->amount * 100);
            // }
            // elseif ($request->session()->get('payment_type') == 'seller_package_payment') {
            //     $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
            //     $amount = round($seller_package->amount * 100);
            // }
        //}
        
        
          $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
  $stripe_payment  = json_decode($paymentSettings['stripe_payment'], true);

        \Stripe\Stripe::setApiKey($stripe_payment['STRIPE_SECRET']);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => Currency::where('default',1)->first()->code,
                        'product_data' => [
                            'name' => "Payment"
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    public function success() {
        try{
            $payment = ["status" => "Success"];

            $payment_type = Session::get('payment_type');

            // if ($payment_type == 'cart_payment') {
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done( null, $payment, Session::get('order_id'));
            // }

            // if ($payment_type == 'wallet_payment') {
            //     $walletController = new WalletController;
            //     return $walletController->wallet_payment_done(session()->get('payment_data'), json_encode($payment));
            // }

            // if ($payment_type == 'customer_package_payment') {
            //     $customer_package_controller = new CustomerPackageController;
            //     return $customer_package_controller->purchase_payment_done(session()->get('payment_data'), json_encode($payment));
            // }
            // if($payment_type == 'seller_package_payment') {
            //     $seller_package_controller = new SellerPackageController;
            //     return $seller_package_controller->purchase_payment_done(session()->get('payment_data'), json_encode($payment));
            // }
        }
        catch (\Exception $e) {
            flash('Payment failed')->error();
    	    return redirect()->route('home');
        }
    }

    public function cancel(Request $request){
        flash('Payment is cancelled')->error();
        return redirect()->route('shipments.show', Session::get('order_id'));
    }
}
