@extends('cargo::adminLte.layouts.master')

@php 
    $paymentSettings  = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
    $razorpay_payment = json_decode($paymentSettings['razorpay'], true);
@endphp

@section('content')

    <form action="{!!route('payment.rozer')!!}" method="POST" id='rozer-pay' style="display: none;">
        <!-- Note that the amount is in paise = 50 INR -->
        <!--amount need to be in paisa-->
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ $razorpay_payment['RAZOR_KEY'] }}"
                data-amount={{round($shipment->tax + $shipment->shipping_cost + $shipment->insurance) * 100}}
                data-buttontext=""
                data-name="{{ env('APP_NAME') }}"
                data-description="Cart Payment"
                data-image="{{ asset(get_setting('header_logo')) }}"
                data-prefill.name= {{ $shipment->client->name }}
                data-prefill.email= {{ $shipment->client->email }}
                data-theme.color="#ff7529">
        </script>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">
    </form>

@endsection

@push('js-component')
    <script type="text/javascript">
        $(document).ready(function(){
            console.log('ss');
            $('#rozer-pay').submit()
        });
    </script>
@endpush
