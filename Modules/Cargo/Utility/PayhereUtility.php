<?php

namespace Modules\Cargo\Utility;

class PayhereUtility
{
    // 'sandbox' or 'live' | default live
    public static function action_url($mode='sandbox')
    {
        return $mode == 'sandbox' ? 'https://sandbox.payhere.lk/pay/checkout' :'https://www.payhere.lk/pay/checkout';
    }

    // 'sandbox' or 'live' | default live
    public static function get_action_url()
    {
        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        $payhere_payment = json_decode($paymentSettings['payhere'], true);
        if($payhere_payment['payhere_sandbox'] == 1){
            $sandbox = 1;
        }
        else {
            $sandbox = 0;
        }
        return $sandbox ? PayhereUtility::action_url('sandbox') : PayhereUtility::action_url('live');
    }

    public static  function create_checkout_form($order_id, $amount, $first_name, $last_name, $phone, $email,$address,$city)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.payments.payhere.checkout_form',compact('order_id', 'amount', 'first_name', 'last_name', 'phone', 'email','address','city'));
    }

    public static  function create_wallet_form($user_id,$order_id, $amount, $first_name, $last_name, $phone, $email,$address,$city)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.payments.payhere.wallet_form',compact('user_id','order_id', 'amount', 'first_name', 'last_name', 'phone', 'email','address','city'));
    }

    public static  function create_customer_package_form($user_id,$package_id,$order_id, $amount, $first_name, $last_name, $phone, $email,$address,$city)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.payments.payhere.customer_package_form',compact('user_id','package_id','order_id', 'amount', 'first_name', 'last_name', 'phone', 'email','address','city'));
    }


    public static function getHash($order_id, $payhere_amount)
    {
        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        $payhere_payment = json_decode($paymentSettings['payhere'], true);
        $hash = strtoupper (md5 ( $payhere_payment['PAYHERE_MERCHANT_ID'] . $order_id . $payhere_amount . $payhere_payment['PAYHERE_CURRENCY'] . strtoupper(md5( $payhere_payment['PAYHERE_SECRET'] )) ) );
        return $hash;
    }





}
