<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Blog\Entities\Category;
use Modules\Cargo\Http\Controllers\PaypalController;
use Modules\Cargo\Http\Controllers\InstamojoController;
use Modules\Cargo\Http\Controllers\StripePaymentController;
use Modules\Cargo\Http\Controllers\PublicSslCommerzPaymentController;
use Modules\Cargo\Http\Controllers\ShipmentController;
use Modules\Cargo\Entities\BusinessSetting;
use App\Models\User;
use Modules\Cargo\Entities\Address;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\Payment;
use Session;
use Carbon\Carbon;
use Modules\Cargo\Utility\PayhereUtility;
use Modules\Cargo\Entities\Coupon;
use Modules\Cargo\Entities\CouponUsage;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
        ]);
        $shipment = Shipment::find($request->shipment_id);
        // return \App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get();
        if ($shipment->paid == 0 && $shipment->payment_method_id != "cash_payment") {
            // return convert_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance);
            $payment = Payment::where("shipment_id",$shipment->id)->get()->first();
            if(!$payment){
                $payment = new Payment();
                $payment->shipment_id = $shipment->id;
                $payment->seller_id = $shipment->client_id;
                $payment->amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
                $payment->payment_method = $shipment->payment_method_id;
                $payment->save();
            }
            if ($shipment->payment_method_id == 'paypal_payment') {
                Session::put('order_id', $shipment->id);
                $paypal = new PaypalController;
                return $paypal->getCheckout($shipment);
            } elseif ($shipment->payment_method_id == 'stripe_payment') {
                Session::put('order_id', $shipment->id);
                $stripe = new StripePaymentController;
                return $stripe->stripe();
            } elseif ($shipment->payment_method_id == 'sslcommerz_payment') {
                $sslcommerz = new PublicSslCommerzPaymentController;
                return $sslcommerz->index($shipment);
            } elseif ($shipment->payment_method_id == 'instamojo_payment') {
                $instamojo = new InstamojoController;
                return $instamojo->pay($shipment);
            } elseif ($shipment->payment_method_id == 'razorpay') {
                $razorpay = new RazorpayController;
                return $razorpay->payWithRazorpay($shipment);
            } elseif ($shipment->payment_method_id == 'paystack') {   
                
                $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
                $paystack_payment  = json_decode($paymentSettings['paystack'], true);

                setEnvValue('PAYSTACK_PUBLIC_KEY', $paystack_payment['PAYSTACK_PUBLIC_KEY'] ?? '' );
                setEnvValue('PAYSTACK_SECRET_KEY', $paystack_payment['PAYSTACK_SECRET_KEY'] ?? '');
                setEnvValue('MERCHANT_EMAIL', $paystack_payment['PAYSTACK_MERCHANT_EMAIL'] ?? '');
                $paystack = new PaystackController;
                return $paystack->redirectToGateway($request,$shipment);
            } elseif ($shipment->payment_method_id == 'voguepay') {
                $voguePay = new VoguePayController;
                return $voguePay->customer_showForm($shipment);
            } elseif ($shipment->payment_method_id == 'payhere') {
                // $order = Shipment::findOrFail($request->session()->get('order_id'));
                Session::put('order_id', $shipment->id);
                $order_id = $shipment->id;
                $amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
                $first_name = $shipment->client->name;
                $last_name = 'X';
                $phone = $shipment->client->responsible_mobile;
                $email = $shipment->client->email;
                $address = $shipment->from_address->address;
                $city = $shipment->to_state->name;

                return PayhereUtility::create_checkout_form($order_id, $amount, $first_name, $last_name, $phone, $email, $address, $city);
            } elseif ($shipment->payment_method_id == 'ngenius') {
                Session::put('order_id', $shipment->id);
                $ngenius = new NgeniusController();
                return $ngenius->pay($shipment);
            } elseif ($shipment->payment_method_id == 'iyzico') {
                $iyzico = new IyzicoController();
                return $iyzico->pay($shipment);
            } elseif ($shipment->payment_method_id == 'nagad') {
                $nagad = new NagadController;
                return $nagad->getSession();
            } elseif ($shipment->payment_method_id == 'bkash') {
                $bkash = new BkashController;
                return $bkash->pay();
            } elseif ($shipment->payment_method_id == 'flutterwave') {
                $flutterwave = new FlutterwaveController();
                return $flutterwave->pay();
            } elseif ($shipment->payment_method_id == 'mpesa') {
                $mpesa = new MpesaController();
                return $mpesa->pay();
            } elseif ($shipment->payment_method_id == 'cash_on_delivery') {
                $request->session()->put('cart', Session::get('cart')->where('owner_id', '!=', Session::get('owner_id')));
                $request->session()->forget('owner_id');
                $request->session()->forget('delivery_info');
                $request->session()->forget('coupon_id');
                $request->session()->forget('coupon_discount');
                $request->session()->forget('club_point');

                flash(translate("Your order has been placed successfully"))->success();
                return redirect()->route('order_confirmed');
            } elseif ($shipment->payment_method_id == 'wallet') {
                $user = Auth::user();
                $order = Shipment::findOrFail($request->session()->get('order_id'));
                if ($user->balance >= $order->grand_total) {
                    $user->balance -= $order->grand_total;
                    $user->save();
                    return $this->checkout_done($request->session()->get('order_id'), null);
                }
            }

        }
        flash('Invalid Link.')->warning();
        return back();
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($payment_integration_id, $payment_details, $shipment_id = null)
    {
        if($shipment_id)
        {
            $shipment = Shipment::where("id",$shipment_id)->first();
        }else{
            $shipment = Shipment::where("payment_integration_id",$payment_integration_id)->first();
        }
        $shipment->paid = 1;
        // $order->payment_details = $payment;
        $shipment->save();
        $payment = $shipment->payment;
        $payment->payment_details = $payment_details;
        $payment->payment_date = Carbon::now()->toDateTimeString();;
        $payment->save();

        if($shipment->current_mission){
            $mission = $shipment->current_mission;
            $mission->amount -= ($shipment->tax + $shipment->shipping_cost + $shipment->insurance);
            $mission->save();
        }
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.thanks-pay')->with(['shipment' => $shipment]);
    }

    public function get_shipping_info(Request $request)
    {
        if (Session::has('cart') && count(Session::get('cart')) > 0) {
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {
        if (Auth::check()) {
            if ($request->address_id == null) {
                flash(translate("Please add shipping address"))->warning();
                return back();
            }
            $address = Address::findOrFail($request->address_id);
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country;
            $data['city'] = $address->city;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
            $data['checkout_type'] = $request->checkout_type;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country'] = $request->country;
            $data['city'] = $request->city;
            $data['postal_code'] = $request->postal_code;
            $data['phone'] = $request->phone;
            $data['checkout_type'] = $request->checkout_type;
        }

        $shipping_info = $data;
        $request->session()->put('shipping_info', $shipping_info);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        foreach (Session::get('cart') as $key => $cartItem) {
            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];

            if(isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                foreach(json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
                    if($shipping_info['city'] == $shipping_region) {
                        $shipping += (double)($val) * $cartItem['quantity'];
                    }
                }
            } else {
                if (!$cartItem['shipping']) {
                    $shipping += 0;
                }
//                $shipping += $cartItem['shipping'] * $cartItem['quantity'];

            }
        }

        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }

        return view('frontend.delivery_info');
        // return view('frontend.payment_select', compact('total'));
    }

    public function store_delivery_info(Request $request)
    {
        $request->session()->put('owner_id', $request->owner_id);

        if (Session::has('cart') && count(Session::get('cart')) > 0) {
            $cart = $request->session()->get('cart', collect([]));
            $cart = $cart->map(function ($object, $key) use ($request) {
                if (\App\Product::find($object['id'])->user_id == $request->owner_id) {
                    if ($request['shipping_type_' . $request->owner_id] == 'pickup_point') {
                        $object['shipping_type'] = 'pickup_point';
                        $object['pickup_point'] = $request['pickup_point_id_' . $request->owner_id];
                    } else {
                        $object['shipping_type'] = 'home_delivery';
                    }
                }
                return $object;
            });

            $request->session()->put('cart', $cart);

            $cart = $cart->map(function ($object, $key) use ($request) {
                if (\App\Product::find($object['id'])->user_id == $request->owner_id) {
                    if ($object['shipping_type'] == 'home_delivery') {
                        $object['shipping'] = getShippingCost($key);
                    }
                    else {
                        $object['shipping'] = 0;
                    }
                } else {
                    $object['shipping'] = 0;
                }
                return $object;
            });

            $request->session()->put('cart', $cart);
            $shipping_info = $request->session()->get('shipping_info');
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            foreach (Session::get('cart') as $key => $cartItem) {
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                if(isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                    foreach(json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
                        if($shipping_info['city'] == $shipping_region) {
                            $shipping += (double)($val) * $cartItem['quantity'];
                        }
                    }
                } else {
                    if (!$cartItem['shipping']) {
                        $shipping += 0;
                    }
                }

            }

            $total = $subtotal + $tax + $shipping;

            if (Session::has('coupon_discount')) {
                $total -= Session::get('coupon_discount');
            }

            return view('frontend.payment_select', compact('total', 'shipping_info'));
        } else {
            flash(translate('Your Cart was empty'))->warning();
            return redirect()->route('home');
        }
    }

    public function get_payment_info(Request $request)
    {
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $shipping_info = $request->session()->get('shipping_info');
        foreach (Session::get('cart') as $key => $cartItem) {
            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];
            if(isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                foreach(json_decode($cartItem['shipping'], true) as $shipping_region => $val) {
                    if($shipping_info['city'] == $shipping_region) {
                        $shipping += (double)($val) * $cartItem['quantity'];
                    }
                }
            } else {
                if (!$cartItem['shipping']) {
                    $shipping += 0;
                }
            }
        }

        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }

        return view('frontend.payment_select', compact('total', 'shipping_info'));
    }

    public function apply_coupon_code(Request $request)
    {
        //dd($request->all());
        $coupon = Coupon::where('code', $request->code)->first();

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                if (CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null) {
                    $coupon_details = json_decode($coupon->details);

                    if ($coupon->type == 'cart_base') {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach (Session::get('cart') as $key => $cartItem) {
                            $subtotal += $cartItem['price'] * $cartItem['quantity'];
                            $tax += $cartItem['tax'] * $cartItem['quantity'];
                            $shipping += $cartItem['shipping'] * $cartItem['quantity'];
                        }
                        $sum = $subtotal + $tax + $shipping;

                        if ($sum >= $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            flash(translate('Coupon has been applied'))->success();
                        }
                    } elseif ($coupon->type == 'product_base') {
                        $coupon_discount = 0;
                        foreach (Session::get('cart') as $key => $cartItem) {
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if ($coupon_detail->product_id == $cartItem['id']) {
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                                    } elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        flash(translate('Coupon has been applied'))->success();
                    }
                } else {
                    flash(translate('You already used this coupon!'))->warning();
                }
            } else {
                flash(translate('Coupon expired!'))->warning();
            }
        } else {
            flash(translate('Invalid coupon!'))->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request)
    {
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }

    public function apply_club_point(Request $request) {
        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null &&
                \App\Addon::where('unique_identifier', 'club_point')->first()->activated){

            $point = $request->point;

//            if(Auth::user()->club_point->points >= $point) {
            if(Auth::user()->point_balance >= $point) {
                $request->session()->put('club_point', $point);
                flash(translate('Point has been redeemed'))->success();
            }
            else {
                flash(translate('Invalid point!'))->warning();
            }
        }
        return back();
    }

    public function remove_club_point(Request $request) {
        $request->session()->forget('club_point');
        return back();
    }

    public function order_confirmed()
    {
        $order = Order::findOrFail(Session::get('order_id'));
        return view('frontend.order_confirmed', compact('order'));
    }
}
