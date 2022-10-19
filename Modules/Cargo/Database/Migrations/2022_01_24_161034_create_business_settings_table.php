<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('value')->nullable();
            $table->string('key')->nullable();
            $table->string('lang')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        $items = array(
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_default_currency",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "system_default_currency",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "currency_format",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "symbol_format",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "no_of_decimals",
                "value" => "3",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "product_activation",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "vendor_system_activation",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "show_vendors",
                "value" => "1",
            ],
            [
                "name"  => "Paypal Payment",
                "key"   => "payment_gateway",
                "type"  => "paypal_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYPAL_CLIENT_ID",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYPAL_CLIENT_SECRET",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "paypal_sandbox",
                "value" => "0",
            ],
            [
                "name"  => "Stripe Payment",
                "key"   => "payment_gateway",
                "type"  => "stripe_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "STRIPE_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "STRIPE_SECRET",
                "value" => null,
            ],
            [
                "name"  => "Cash Payment",
                "key"   => "payment_gateway",
                "type"  => "cash_payment",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "payumoney_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "best_selling",
                "value" => "1",
            ],
            [
                "name"  => "SSlCommerz",
                "key"   => "payment_gateway",
                "type"  => "sslcommerz_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "SSLCZ_STORE_ID",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "SSLCZ_STORE_PASSWD",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "sslcommerz_sandbox",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "vendor_commission",
                "value" => "20",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "verification_form",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "google_analytics",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "facebook_login",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "google_login",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "twitter_login",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "facebook_chat",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "payumoney_sandbox",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "email_verification",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "wallet_system",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "coupon_system",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "current_version",
                "value" => "6.0",
            ],
            [
                "name"  => "Instamojo Payment",
                "key"   => "payment_gateway",
                "type"  => "instamojo_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "IM_API_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "IM_AUTH_TOKEN",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "instamojo_sandbox",
                "value" => "0",
            ],
            [
                "name"  => "Razor Pay",
                "key"   => "payment_gateway",
                "type"  => "razorpay",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "RAZOR_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "RAZOR_SECRET",
                "value" => null,
            ],
            [
                "name"  => "PayStack",
                "key"   => "payment_gateway",
                "type"  => "paystack",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYSTACK_PUBLIC_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYSTACK_SECRET_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYSTACK_MERCHANT_EMAIL",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "pickup_point",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "maintenance_mode",
                "value" => "0",
            ],
            [
                "name"  => "VoguePay",
                "key"   => "payment_gateway",
                "type"  => "voguepay",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "voguepay_sandbox",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "VOGUE_MERCHANT_ID",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "category_wise_commission",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "conversation_system",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "guest_checkout_active",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "facebook_pixel",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "classified_product",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "pos_activation_for_seller",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "shipping_type",
                "value" => "product_wise_shipping",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "flat_rate_shipping_cost",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "shipping_cost_admin",
                "value" => "0",
            ],
            [
                "name"  => "Payhere",
                "key"   => "payment_gateway",
                "type"  => "payhere",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "payhere_sandbox",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYHERE_MERCHANT_ID",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYHERE_SECRET",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "PAYHERE_CURRENCY",
                "value" => null,
            ],
            [
                "name"  => "Ngenius",
                "key"   => "payment_gateway",
                "type"  => "ngenius",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "NGENIUS_OUTLET_ID",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "NGENIUS_API_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "NGENIUS_CURRENCY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "google_recaptcha",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "header_logo",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "show_language_switcher",
                "value" => "on",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "show_currency_switcher",
                "value" => "on",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "header_stikcy",
                "value" => "on",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "footer_logo",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "about_us_description",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "contact_address",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "contact_phone",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "contact_email",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "widget_one_labels",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "widget_one_links",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "widget_one",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "frontend_copyright_text",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "show_social_links",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "facebook_link",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "twitter_link",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "instagram_link",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "youtube_link",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "linkedin_link",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "payment_method_images",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_slider_images",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_slider_links",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_banner1_images",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_banner1_links",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_banner2_images",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_banner2_links",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "home_categories",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "top10_categories",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "top10_brands",
                "value" => "[]",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "website_name",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "site_motto",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "site_icon",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "base_color",
                "value" => "#e62e04",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "base_hov_color",
                "value" => "#e62e04",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "meta_title",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "meta_description",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "meta_keywords",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "meta_image",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "site_name",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "system_logo_white",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "system_logo_black",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "timezone",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "admin_login_background",
                "value" => null,
            ],
            [
                "name"  => "Iyzico",
                "key"   => "payment_gateway",
                "type"  => "iyzico",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "iyzico_sandbox",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "IYZICO_API_KEY",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "IYZICO_SECRET_KEY",
                "value" => null,
            ],
            [
                "name"  => "Invoice Payment",
                "key"   => "payment_gateway",
                "type"  => "invoice_payment",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "decimal_separator",
                "value" => "1",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "nexmo",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "twillo",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "ebernate",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "ssl_wireless",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "fast2sms",
                "value" => "0",
            ],
            [
                "name"  => "New Registeration",
                "key"   => "new_registeration",
                "type"  => "notifications",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "google_map",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "server_key",
                "value" => null,
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "map_activation",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "mapbox",
                "value" => "0",
            ],
            [
                "name"  => null,
                "key"   => null,
                "type"  => "website_mode",
                "value" => "0",
            ],
                        
        );
        DB::table('business_settings')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_settings');
    }
}
