<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/paystack/payment/callback', 'PaystackController@handleGatewayCallback');

if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
  Route::group(
    [
      'prefix' => LaravelLocalization::setLocale(),
      'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::middleware('auth')->group(function() {
      Route::get('shipments/shipment-calc', 'ShipmentController@shipmentCalc')->name('shipment-calc');
      Route::get('shipment_status/{id}', 'ShipmentStatusController@shipment_status')->name('shipment-status');
      Route::post('shipment_status/store', 'ShipmentStatusController@shipment_status_store')->name('shipment_status_store');
      Route::get('admin/shipments/payment/{shipment_id}','ShipmentController@pay')->name('admin.shipments.pay');
      Route::get('admin/shipments/vault-create','ShipmentController@vault_create')->name('admin.shipments.vault-create');
      Route::post('admin/shipments/vault_store','ShipmentController@vault_store')->name('admin.shipments.vault-store');

      Route::get('admin/shipments/vault_edit/{id}', 'ShipmentController@vault_edit')->name('admin.shipments.vault-edit');
      Route::post('admin/shipments/vault_update', 'ShipmentController@vault_update')->name('admin.shipments.vault-update');
      Route::get('admin/shipments/vault_delete/{id}','ShipmentController@vault_delete')->name('admin.shipments.vault-delete');

        //ajax validation
      Route::get('user/check-email','ValidationController@ajax_check_email')->name('user.checkEmail');

      //good tracking
      Route::get('shipments/goodtrack','ShipmentController@goodtrack')->name('shipments.goodtrack');
      Route::get('shipments/add_goodtrack','ShipmentController@addgoodtrack')->name('shipments.add.goodtrack');
      Route::post('shipments/add_goodtrack/store', 'ShipmentController@addgoodtrack_store')->name('shipments.add.goodtrack.store');
      Route::get('shipments/edit_goodtrack/{id}','ShipmentController@editgoodtrack')->name('shipments.edit.goodtrack');
      Route::post('shipments/update_goodtrack', 'ShipmentController@updategoodtrack')->name('shipments.update.goodtrack');
      Route::get('shipments/delete_goodtrack/{id}','ShipmentController@deletegoodtrack')->name('shipments.delete.goodtrack');

      Route::get('shipments/tracking/view', 'ShipmentController@trackingView')->name('shipments.view.tracking');
      Route::get('shipments/tracking/{code?}','ShipmentController@tracking')->name('shipments.tracking');

      Route::get('shipments/vault/tracking/view', 'ShipmentController@VaultTrackingView')->name('shipments.vault.view.tracking');
      Route::get('shipments/vault/tracking/{vault_number?}','ShipmentController@VaultTracking')->name('shipments.vault.tracking');
      Route::get('shipments/vault_index', 'ShipmentController@VaultIndex')->name('shipments.vault.index');
    });

      Route::get('shipments/calculator','ShipmentController@calculator')->name('shipments.calculator');
      Route::post('shipments/calculator/store','ShipmentController@calculatorStore')->name('shipments.calculator.store');

      Route::prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
        Route::get('/register', 'ClientController@register')
        ->middleware('guest')
        ->name('register');

        Route::post('/register', 'ClientController@registerStore')
        ->middleware('guest')
        ->name('register.request');

        Route::get('/countries/ajax-get-states','CountryController@ajaxGetStates')->name('ajax.getStates');
        Route::get('/countries/ajax-get-areas','CountryController@ajaxGetAreas')->name('ajax.getAreas');

            // Shipment Estimation Cost Route
        Route::post('shipments/get-estimation-cost','ShipmentController@ajaxGetEstimationCost')->name('shipments.get-estimation-cost');
      });


      Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

        Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
            //Paypal START
        Route::get('/paypal/success', 'PaypalController@success')->name('paypal.success');
        Route::get('/paypal/error', 'PaypalController@error')->name('paypal.error');
            //Paypal END
            // SSLCOMMERZ Start
        Route::get('/sslcommerz/pay', 'PublicSslCommerzPaymentController@index');
        Route::POST('/sslcommerz/success', 'PublicSslCommerzPaymentController@success')->name('sslcommerz.success');
        Route::POST('/sslcommerz/fail', 'PublicSslCommerzPaymentController@fail')->name('sslcommerz.fail');
        Route::POST('/sslcommerz/cancel', 'PublicSslCommerzPaymentController@cancel')->name('sslcommerz.cancel');
        Route::POST('/sslcommerz/ipn', 'PublicSslCommerzPaymentController@ipn');
            //SSLCOMMERZ END
            //Stipe Start
        Route::get('stripe', 'StripePaymentController@stripe');
        Route::post('/stripe/create-checkout-session', 'StripePaymentController@create_checkout_session')->name('stripe.get_token');
        Route::any('/stripe/payment/callback', 'StripePaymentController@callback')->name('stripe.callback');
        Route::get('/stripe/success', 'StripePaymentController@success')->name('stripe.success');
        Route::get('/stripe/cancel', 'StripePaymentController@cancel')->name('stripe.cancel');
            //Stripe END
        Route::get('/instamojo/payment/pay-success', 'InstamojoController@success')->name('instamojo.success');

        Route::post('rozer/payment/pay-success', 'RazorpayController@payment')->name('payment.rozer');

        Route::get('/vogue-pay', 'VoguePayController@showForm');
        Route::get('/vogue-pay/success/{id}', 'VoguePayController@paymentSuccess');
        Route::get('/vogue-pay/failure/{id}', 'VoguePayController@paymentFailure');

            //Iyzico
        Route::any('/iyzico/payment/callback/{payment_type}/{amount?}/{payment_method?}/{combined_order_id?}/{customer_package_id?}/{seller_package_id?}', 'IyzicoController@callback')->name('iyzico.callback')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

            //payhere below
        Route::get('/payhere/checkout/testing', 'PayhereController@checkout_testing')->name('payhere.checkout.testing');
        Route::get('/payhere/wallet/testing', 'PayhereController@wallet_testing')->name('payhere.checkout.testing');
        Route::get('/payhere/customer_package/testing', 'PayhereController@customer_package_testing')->name('payhere.customer_package.testing');

        Route::any('/payhere/checkout/notify', 'PayhereController@checkout_notify')->name('payhere.checkout.notify');
        Route::any('/payhere/checkout/return', 'PayhereController@checkout_return')->name('payhere.checkout.return');
        Route::any('/payhere/checkout/cancel', 'PayhereController@chekout_cancel')->name('payhere.checkout.cancel');

        Route::any('/payhere/wallet/notify', 'PayhereController@wallet_notify')->name('payhere.wallet.notify');
        Route::any('/payhere/wallet/return', 'PayhereController@wallet_return')->name('payhere.wallet.return');
        Route::any('/payhere/wallet/cancel', 'PayhereController@wallet_cancel')->name('payhere.wallet.cancel');

        Route::any('/payhere/seller_package_payment/notify', 'PayhereController@seller_package_notify')->name('payhere.seller_package_payment.notify');
        Route::any('/payhere/seller_package_payment/return', 'PayhereController@seller_package_payment_return')->name('payhere.seller_package_payment.return');
        Route::any('/payhere/seller_package_payment/cancel', 'PayhereController@seller_package_payment_cancel')->name('payhere.seller_package_payment.cancel');
        Route::get('/migrate/products/', 'PayhereController@migrate_seller_package_payment');

        Route::any('/payhere/customer_package_payment/notify', 'PayhereController@customer_package_notify')->name('payhere.customer_package_payment.notify');
        Route::any('/payhere/customer_package_payment/return', 'PayhereController@customer_package_return')->name('payhere.customer_package_payment.return');
        Route::any('/payhere/customer_package_payment/cancel', 'PayhereController@customer_package_cancel')->name('payhere.customer_package_payment.cancel');

            //N-genius
        Route::any('ngenius/cart_payment_callback', 'NgeniusController@cart_payment_callback')->name('ngenius.cart_payment_callback');
        Route::any('ngenius/wallet_payment_callback', 'NgeniusController@wallet_payment_callback')->name('ngenius.wallet_payment_callback');
        Route::get('/migrate/database', 'NgeniusController@migrate_ngenius');
        Route::any('ngenius/customer_package_payment_callback', 'NgeniusController@customer_package_payment_callback')->name('ngenius.customer_package_payment_callback');
        Route::any('ngenius/seller_package_payment_callback', 'NgeniusController@seller_package_payment_callback')->name('ngenius.seller_package_payment_callback');

            //bKash
        Route::post('/bkash/createpayment', 'BkashController@checkout')->name('bkash.checkout');
        Route::post('/bkash/executepayment', 'BkashController@excecute')->name('bkash.excecute');
        Route::get('/bkash/success', 'BkashController@success')->name('bkash.success');

            //Nagad
        Route::get('/nagad/callback', 'NagadController@verify')->name('nagad.callback');

        Route::prefix('shipment-team')->group(function() {
                // Branch Routes
          Route::get('/branches/report','BranchController@branchesReport')->name('branches.report');
          Route::delete('/branches-multi-destroy', 'BranchController@multiDestroy')->name('branches.multi-destroy');
          Route::resource('branches','BranchController');

                //profile  Branch
          Route::get('/branches/profile/{id}', 'BranchController@profile')->name('branches.profile');


                // Client Routes
          Route::get('/clients/report','ClientController@clientsReport')->name('clients.report');
          Route::get('/clients/ajax-get-addresses','ClientController@ajaxGetClientAddresses')->name('ajax-get-client-addresses-ajax');
          Route::post('client/new-address','ClientController@addNewAddress')->name('client.add.new.address');

                //profile  Client
        //   Route::get('/client/addUser', 'ClientController@addUser')->name('client.addUser');
        //   Route::post('/client/showUser','ClientController@showUser')->name('client.showUser');

          Route::get('/clients/profile/{id}', 'ClientController@profile')->name('clients.profile');
                // manage-address
          Route::get('/clients/manage-address', 'ClientController@manageAddress')->name('clients.manage-address');
          Route::POST('/clients/manage-Address-Updata', 'ClientController@manageAddressUpdata')->name('clients.manageAddressUpdata');
          Route::get('/add-new-address/create', 'ClientController@manageAddressUpdata')->name('add-new-address.create');
                // Ationc address
          Route::get('address/delete/{id}', 'ClientController@addressDelete')->name('address.delete');
          Route::get('address/edit/{id}', 'ClientController@addressEdit')->name('address.edit');
          Route::post('address/addressUpdata', 'ClientController@addressUpdata')->name('address.updata');


          Route::get('new_address', 'ClientController@newAddress')->name('new_address');
          Route::post('new_address/store', 'ClientController@newAddressStore')->name('new_address.store');


          Route::delete('/clients-multi-destroy', 'ClientController@multiDestroy')->name('clients.multi-destroy');
          Route::resource('clients','ClientController');

                // Driver Routes
          Route::get('/drivers/report','DriverController@driversReport')->name('drivers.report');
          Route::get('/ajaxed-get-drivers','DriverController@ajaxGetDrivers')->name('get-drivers-ajax');
          Route::delete('/drivers-multi-destroy', 'DriverController@multiDestroy')->name('drivers.multi-destroy');
          Route::resource('drivers','DriverController');

                //profile  Driver
          Route::get('/drivers/profile/{id}', 'DriverController@profile')->name('drivers.profile');
        });

        Route::prefix('shipments')->group(function() {

          Route::get('shipments/print/{shipment}/{type}','ShipmentController@print')->name('shipments.print');

                // Add Shipment By Api & Import Shipmetn Routes
          Route::get('import', 'ShipmentController@import')->name('shipments.import');
          Route::post('import/parse', 'ShipmentController@parseImport')->name('shipments.import_parse');
          Route::get('add-shipment-api','ShipmentController@ShipmentApis')->name('shipments.add.api');

                // barcode scanner Route
          Route::get('barcode-scanner','ShipmentController@BarcodeScanner')->name('shipments.barcode.scanner');
          Route::post('barcode-scanner','ShipmentController@ChangeStatusByBarcode')->name('shipments.barcode.scanner.post');

                // print stickers Route
          Route::post('shipments/print/stickers','ShipmentController@printStickers')->name('shipments.print.stickers');

                //Auto Route Creation Based on Statuses Function in Shipment Model
          foreach(Modules\Cargo\Entities\Shipment::status_info() as $item)
          {
            $params ='';
            if(isset($item['optional_params']))
            {
              $params = $item['optional_params'];
            }
            Route::get('shipments/'.$item['route_url'].'/{status}'.$params,'ShipmentController@index')
            ->name($item['route_name']);
          }

                // Shipments Create Mission Routes
          Route::post('shipments/action/{to}','ShipmentController@change')->name('shipments.action');
          Route::post('shipments/action/pickup_mission/{type}','ShipmentController@createPickupMission')->name('shipments.action.create.pickup.mission');
          Route::post('shipments/action/supply_mission/{type}','ShipmentController@createSupplyMission')->name('shipments.action.create.supply.mission');
          Route::post('shipments/action/delivery_mission/{type}','ShipmentController@createDeliveryMission')->name('shipments.action.create.delivery.mission');
          Route::post('shipments/action/return_mission/{type}','ShipmentController@createReturnMission')->name('shipments.action.create.return.mission');
          Route::post('shipments/action/transfer_mission/{type}','ShipmentController@createTransferMission')->name('shipments.action.create.transfer.mission');
          Route::post('shipments/remove-shipment-from-mission','ShipmentController@removeShipmentFromMission')->name('shipments.delete-shipment-from-mission');

                // Shipment Routes
          Route::get('report','ShipmentController@shipmentsReport')->name('shipments.report');
          Route::get('generate-token','ShipmentController@ajaxGgenerateToken')->name('shipments.generate-token');
          Route::delete('/shipments-multi-destroy', 'ShipmentController@multiDestroy')->name('shipments.multi-destroy');
          Route::resource('shipments','ShipmentController');
        });

            // Manifests Routes
        Route::get('manifests/','MissionController@getManifests')->name('missions.manifests');
        Route::post('manifests/order','MissionController@ajax_change_order')->name('missions.manifests.order');
        Route::post('manifest-profile','MissionController@getManifestProfile')->name('missions.get.manifest');
        Route::prefix('missions')->group(function() {

          foreach(Modules\Cargo\Entities\Mission::status_info() as $item)
          {
            $params ='';
            if(isset($item['optional_params']))
            {
              $params = $item['optional_params'];
            }
            Route::get('missions/'.$item['route_url'].'/{status}'.$params,'MissionController@index')
            ->name($item['route_name']);
          }

                // Missions Routes
          Route::get('report','MissionController@missionsReport')->name('missions.report');
          Route::post('missions/action/{to}','MissionController@change')->name('admin.missions.action');
          Route::post('missions/action/approve/{to}','MissionController@approveAndAssign')->name('admin.mission.action.approve');
          Route::get('missions/action/confirm_amount/{mission_id}','MissionController@getAmountModel')->name('admin.missions.action.confirm_amount');
          Route::post('missions/reschedule','MissionController@reschedule')->name('missions.reschedule');
          Route::resource('missions','MissionController');
        });

        Route::prefix('transactions')->group(function() {

                // Transactions Routes
          Route::get('report','TransactionController@transactionsReport')->name('transactions.report');
          Route::get('clients/transactions/{client_id}','TransactionController@getClientTransaction')->name('admin.client.transactions.show');
          Route::get('captains/transactions/{captain_id}','TransactionController@getCaptainTransaction')->name('admin.captain.transactions.show');

          Route::get('transactions/transactions-report','TransactionController@transactionsReport')->name('admin.transactions.report');
          Route::post('transactions/transactions-report/results','TransactionController@transactionsReport')->name('admin.transactions.export');
          Route::resource('transactions','TransactionController');
        });

            // Delivery Times Routes
        Route::delete('/deliveryTime-multi-destroy', 'DeliveryTimeController@multiDestroy')->name('deliveryTimes.multi-destroy');
        Route::resource('deliveryTime','DeliveryTimeController');

            // Packages Routes
        Route::post('/config/packages/costs','PackageController@post_config_package_costs')->name('post.config.package.costs');
        Route::delete('/packages-multi-destroy', 'PackageController@multiDestroy')->name('packages.multi-destroy');
        Route::resource('packages','PackageController');

            // Countries Routes
        Route::get('/config/countries/costs','CountryController@countries_config_costs')->name('countries.config.costs');
        Route::get('/config/countries/costs/ajax','CountryController@ajax_countries_costs_repeter')->name('countries.config.costs.ajax');
        Route::post('/config/countries/costs','CountryController@post_countries_config_costs')->name('post.countries.config.costs');
        Route::get('/countries/covered_states/{country_id}','CountryController@covered_states')->name('countries.covered_states');
        Route::post('/countries/covered_states/{country_id}','CountryController@post_covered_states')->name('countries.post_covered_states');
        Route::resource('countries','CountryController');

            // Area Routes
        Route::delete('/areas-multi-destroy', 'AreaController@multiDestroy')->name('areas.multi-destroy');
        Route::resource('areas','AreaController');

            // Staff Routes
        Route::delete('/staffs-multi-destroy', 'StaffController@multiDestroy')->name('staffs.multi-destroy');
        Route::resource('staffs','StaffController');

            // profile  Staff
        Route::get('/staffs/profile/{id}', 'StaffController@profile')->name('staffs.profile');


            // Shipment Settings Routes
        Route::get('shipments/settings','ShipmentSettingController@settings')->name('shipments.settings');
        Route::put('shipments/settings','ShipmentSettingController@storeSettings')->name('shipments.settings.store');

        Route::get('shipments/settings/fees','ShipmentSettingController@feesSettings')->name('shipments.settings.fees');
        Route::post('shipments/settings/fees','ShipmentSettingController@storeFeesSettings')->name('shipments.settings.fees.store');

        Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
        Route::post('/google_map', 'BusinessSettingsController@google_map_update')->name('google_map.update');

        Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('email_settings.index');
        Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

        Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
        Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
        Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');

        Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');

        Route::get('/sms-gateways', 'BusinessSettingsController@sms_gateways')->name('sms_gateways.index');

      });
});
}else{
  Route::get('shipments/shipment-calc', 'ShipmentController@shipmentCalc')->name('shipment-calc');
  Route::get('admin/shipments/payment/{shipment_id}','ShipmentController@pay')->name('admin.shipments.pay');

    //ajax validation
  Route::get('user/check-email','ValidationController@ajax_check_email')->name('user.checkEmail');

  Route::get('shipments/tracking/view', 'ShipmentController@trackingView')->name('shipments.view.tracking');

  Route::get('shipments/tracking/view', 'ShipmentController@trackingView')->name('shipments.view.tracking');

  Route::get('shipments/calculator','ShipmentController@calculator')->name('shipments.calculator');
  Route::post('shipments/calculator/store','ShipmentController@calculatorStore')->name('shipments.calculator.store');

  Route::prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {
    Route::get('/register', 'ClientController@register')
    ->middleware('guest')
    ->name('register');

    Route::post('/register', 'ClientController@registerStore')
    ->middleware('guest')
    ->name('register.request');


    Route::get('/countries/ajax-get-states','CountryController@ajaxGetStates')->name('ajax.getStates');
    Route::get('/countries/ajax-get-areas','CountryController@ajaxGetAreas')->name('ajax.getAreas');

        // Shipment Estimation Cost Route
    Route::post('shipments/get-estimation-cost','ShipmentController@ajaxGetEstimationCost')->name('shipments.get-estimation-cost');
  });

  Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {


    Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');

        // SSLCOMMERZ Start
    Route::get('/sslcommerz/pay', 'PublicSslCommerzPaymentController@index');
    Route::POST('/sslcommerz/success', 'PublicSslCommerzPaymentController@success');
    Route::POST('/sslcommerz/fail', 'PublicSslCommerzPaymentController@fail');
    Route::POST('/sslcommerz/cancel', 'PublicSslCommerzPaymentController@cancel');
    Route::POST('/sslcommerz/ipn', 'PublicSslCommerzPaymentController@ipn');
        //SSLCOMMERZ END
        //Stipe Start
    Route::get('stripe', 'StripePaymentController@stripe');
    Route::post('/stripe/create-checkout-session', 'StripePaymentController@create_checkout_session')->name('stripe.get_token');
    Route::any('/stripe/payment/callback', 'StripePaymentController@callback')->name('stripe.callback');
    Route::get('/stripe/success', 'StripePaymentController@success')->name('stripe.success');
    Route::get('/stripe/cancel', 'StripePaymentController@cancel')->name('stripe.cancel');
        //Stripe END
    Route::get('/instamojo/payment/pay-success', 'InstamojoController@success')->name('instamojo.success');

    Route::post('rozer/payment/pay-success', 'RazorpayController@payment')->name('payment.rozer');

    Route::get('/vogue-pay', 'VoguePayController@showForm');
    Route::get('/vogue-pay/success/{id}', 'VoguePayController@paymentSuccess');
    Route::get('/vogue-pay/failure/{id}', 'VoguePayController@paymentFailure');

        //Iyzico
    Route::any('/iyzico/payment/callback/{payment_type}/{amount?}/{payment_method?}/{combined_order_id?}/{customer_package_id?}/{seller_package_id?}', 'IyzicoController@callback')->name('iyzico.callback')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

        //payhere below
    Route::get('/payhere/checkout/testing', 'PayhereController@checkout_testing')->name('payhere.checkout.testing');
    Route::get('/payhere/wallet/testing', 'PayhereController@wallet_testing')->name('payhere.checkout.testing');
    Route::get('/payhere/customer_package/testing', 'PayhereController@customer_package_testing')->name('payhere.customer_package.testing');

    Route::any('/payhere/checkout/notify', 'PayhereController@checkout_notify')->name('payhere.checkout.notify');
    Route::any('/payhere/checkout/return', 'PayhereController@checkout_return')->name('payhere.checkout.return');
    Route::any('/payhere/checkout/cancel', 'PayhereController@chekout_cancel')->name('payhere.checkout.cancel');

    Route::any('/payhere/wallet/notify', 'PayhereController@wallet_notify')->name('payhere.wallet.notify');
    Route::any('/payhere/wallet/return', 'PayhereController@wallet_return')->name('payhere.wallet.return');
    Route::any('/payhere/wallet/cancel', 'PayhereController@wallet_cancel')->name('payhere.wallet.cancel');

    Route::any('/payhere/seller_package_payment/notify', 'PayhereController@seller_package_notify')->name('payhere.seller_package_payment.notify');
    Route::any('/payhere/seller_package_payment/return', 'PayhereController@seller_package_payment_return')->name('payhere.seller_package_payment.return');
    Route::any('/payhere/seller_package_payment/cancel', 'PayhereController@seller_package_payment_cancel')->name('payhere.seller_package_payment.cancel');
    Route::get('/migrate/products/', 'PayhereController@migrate_seller_package_payment');

    Route::any('/payhere/customer_package_payment/notify', 'PayhereController@customer_package_notify')->name('payhere.customer_package_payment.notify');
    Route::any('/payhere/customer_package_payment/return', 'PayhereController@customer_package_return')->name('payhere.customer_package_payment.return');
    Route::any('/payhere/customer_package_payment/cancel', 'PayhereController@customer_package_cancel')->name('payhere.customer_package_payment.cancel');

        //N-genius
    Route::any('ngenius/cart_payment_callback', 'NgeniusController@cart_payment_callback')->name('ngenius.cart_payment_callback');
    Route::any('ngenius/wallet_payment_callback', 'NgeniusController@wallet_payment_callback')->name('ngenius.wallet_payment_callback');
    Route::get('/migrate/database', 'NgeniusController@migrate_ngenius');
    Route::any('ngenius/customer_package_payment_callback', 'NgeniusController@customer_package_payment_callback')->name('ngenius.customer_package_payment_callback');
    Route::any('ngenius/seller_package_payment_callback', 'NgeniusController@seller_package_payment_callback')->name('ngenius.seller_package_payment_callback');

        //bKash
    Route::post('/bkash/createpayment', 'BkashController@checkout')->name('bkash.checkout');
    Route::post('/bkash/executepayment', 'BkashController@excecute')->name('bkash.excecute');
    Route::get('/bkash/success', 'BkashController@success')->name('bkash.success');

        //Nagad
    Route::get('/nagad/callback', 'NagadController@verify')->name('nagad.callback');

    Route::prefix('shipment-team')->group(function() {
            // Branch Routes
      Route::get('/branches/report','BranchController@branchesReport')->name('branches.report');
      Route::delete('/branches-multi-destroy', 'BranchController@multiDestroy')->name('branches.multi-destroy');
      Route::resource('branches','BranchController');

            //profile  Branch
      Route::get('/branches/profile/{id}', 'BranchController@profile')->name('branches.profile');


            // Client Routes
      Route::get('/clients/report','ClientController@clientsReport')->name('clients.report');
      Route::get('/clients/ajax-get-addresses','ClientController@ajaxGetClientAddresses')->name('ajax-get-client-addresses-ajax');
      Route::post('client/new-address','ClientController@addNewAddress')->name('client.add.new.address');

            //profile  Client
      Route::get('/clients/profile/{id}', 'ClientController@profile')->name('clients.profile');
            // manage-address
      Route::get('/clients/manage-address', 'ClientController@manageAddress')->name('clients.manage-address');
      Route::POST('/clients/manage-Address-Updata', 'ClientController@manageAddressUpdata')->name('clients.manageAddressUpdata');
      Route::get('/add-new-address/create', 'ClientController@manageAddressUpdata')->name('add-new-address.create');
            // Ationc address
      Route::get('address/delete/{id}', 'ClientController@addressDelete')->name('address.delete');
      Route::get('address/edit/{id}', 'ClientController@addressEdit')->name('address.edit');
      Route::post('address/addressUpdata', 'ClientController@addressUpdata')->name('address.updata');


      Route::get('new_address', 'ClientController@newAddress')->name('new_address');
      Route::post('new_address/store', 'ClientController@newAddressStore')->name('new_address.store');


      Route::delete('/clients-multi-destroy', 'ClientController@multiDestroy')->name('clients.multi-destroy');
      Route::resource('clients','ClientController');

            // Driver Routes
      Route::get('/drivers/report','DriverController@driversReport')->name('drivers.report');
      Route::get('/ajaxed-get-drivers','DriverController@ajaxGetDrivers')->name('get-drivers-ajax');
      Route::delete('/drivers-multi-destroy', 'DriverController@multiDestroy')->name('drivers.multi-destroy');
      Route::resource('drivers','DriverController');

            //profile  Driver
      Route::get('/drivers/profile/{id}', 'DriverController@profile')->name('drivers.profile');
    });

    Route::prefix('shipments')->group(function() {

      Route::get('shipments/print/{shipment}/{type}','ShipmentController@print')->name('shipments.print');

            // Add Shipment By Api & Import Shipmetn Routes
      Route::get('import', 'ShipmentController@import')->name('shipments.import');
      Route::post('import/parse', 'ShipmentController@parseImport')->name('shipments.import_parse');
      Route::get('add-shipment-api','ShipmentController@ShipmentApis')->name('shipments.add.api');

            // barcode scanner Route
      Route::get('barcode-scanner','ShipmentController@BarcodeScanner')->name('shipments.barcode.scanner');

            // print stickers Route
      Route::post('shipments/print/stickers','ShipmentController@printStickers')->name('shipments.print.stickers');

            //Auto Route Creation Based on Statuses Function in Shipment Model
      foreach(Modules\Cargo\Entities\Shipment::status_info() as $item)
      {
        $params ='';
        if(isset($item['optional_params']))
        {
          $params = $item['optional_params'];
        }
        Route::get('shipments/'.$item['route_url'].'/{status}'.$params,'ShipmentController@index')
        ->name($item['route_name']);
      }

            // Shipments Create Mission Routes
      Route::post('shipments/action/{to}','ShipmentController@change')->name('shipments.action');
      Route::post('shipments/action/pickup_mission/{type}','ShipmentController@createPickupMission')->name('shipments.action.create.pickup.mission');
      Route::post('shipments/action/supply_mission/{type}','ShipmentController@createSupplyMission')->name('shipments.action.create.supply.mission');
      Route::post('shipments/action/delivery_mission/{type}','ShipmentController@createDeliveryMission')->name('shipments.action.create.delivery.mission');
      Route::post('shipments/action/return_mission/{type}','ShipmentController@createReturnMission')->name('shipments.action.create.return.mission');
      Route::post('shipments/action/transfer_mission/{type}','ShipmentController@createTransferMission')->name('shipments.action.create.transfer.mission');
      Route::post('shipments/remove-shipment-from-mission','ShipmentController@removeShipmentFromMission')->name('shipments.delete-shipment-from-mission');

            // Shipment Routes
      Route::get('report','ShipmentController@shipmentsReport')->name('shipments.report');
      Route::get('generate-token','ShipmentController@ajaxGgenerateToken')->name('shipments.generate-token');
      Route::delete('/shipments-multi-destroy', 'ShipmentController@multiDestroy')->name('shipments.multi-destroy');
      Route::resource('shipments','ShipmentController');
    });

        // Manifests Routes
    Route::get('manifests/','MissionController@getManifests')->name('missions.manifests');
    Route::post('manifests/order','MissionController@ajax_change_order')->name('missions.manifests.order');
    Route::post('manifest-profile','MissionController@getManifestProfile')->name('missions.get.manifest');
    Route::prefix('missions')->group(function() {

      foreach(Modules\Cargo\Entities\Mission::status_info() as $item)
      {
        $params ='';
        if(isset($item['optional_params']))
        {
          $params = $item['optional_params'];
        }
        Route::get('missions/'.$item['route_url'].'/{status}'.$params,'MissionController@index')
        ->name($item['route_name']);
      }

            // Missions Routes
      Route::get('report','MissionController@missionsReport')->name('missions.report');
      Route::post('missions/action/{to}','MissionController@change')->name('admin.missions.action');
      Route::post('missions/action/approve/{to}','MissionController@approveAndAssign')->name('admin.mission.action.approve');
      Route::get('missions/action/confirm_amount/{mission_id}','MissionController@getAmountModel')->name('admin.missions.action.confirm_amount');
      Route::post('missions/reschedule','MissionController@reschedule')->name('missions.reschedule');
      Route::resource('missions','MissionController');
    });

    Route::prefix('transactions')->group(function() {

            // Transactions Routes
      Route::get('report','TransactionController@transactionsReport')->name('transactions.report');
      Route::get('clients/transactions/{client_id}','TransactionController@getClientTransaction')->name('admin.client.transactions.show');
      Route::get('captains/transactions/{captain_id}','TransactionController@getCaptainTransaction')->name('admin.captain.transactions.show');

      Route::get('transactions/transactions-report','TransactionController@transactionsReport')->name('admin.transactions.report');
      Route::post('transactions/transactions-report/results','TransactionController@transactionsReport')->name('admin.transactions.export');
      Route::resource('transactions','TransactionController');
    });

        // Delivery Times Routes
    Route::delete('/deliveryTime-multi-destroy', 'DeliveryTimeController@multiDestroy')->name('deliveryTimes.multi-destroy');
    Route::resource('deliveryTime','DeliveryTimeController');

        // Packages Routes
    Route::post('/config/packages/costs','PackageController@post_config_package_costs')->name('post.config.package.costs');
    Route::delete('/packages-multi-destroy', 'PackageController@multiDestroy')->name('packages.multi-destroy');
    Route::resource('packages','PackageController');

        // Countries Routes
    Route::get('/config/countries/costs','CountryController@countries_config_costs')->name('countries.config.costs');
    Route::get('/config/countries/costs/ajax','CountryController@ajax_countries_costs_repeter')->name('countries.config.costs.ajax');
    Route::post('/config/countries/costs','CountryController@post_countries_config_costs')->name('post.countries.config.costs');
    Route::get('/countries/covered_states/{country_id}','CountryController@covered_states')->name('countries.covered_states');
    Route::post('/countries/covered_states/{country_id}','CountryController@post_covered_states')->name('countries.post_covered_states');
    Route::resource('countries','CountryController');

        // Area Routes
    Route::delete('/areas-multi-destroy', 'AreaController@multiDestroy')->name('areas.multi-destroy');
    Route::resource('areas','AreaController');

        // Staff Routes
    Route::delete('/staffs-multi-destroy', 'StaffController@multiDestroy')->name('staffs.multi-destroy');
    Route::resource('staffs','StaffController');

        // profile  Staff
    Route::get('/staffs/profile/{id}', 'StaffController@profile')->name('staffs.profile');

        // Shipment Settings Routes
    Route::get('shipments/settings','ShipmentSettingController@settings')->name('shipments.settings');
    Route::put('shipments/settings','ShipmentSettingController@storeSettings')->name('shipments.settings.store');

    Route::get('shipments/settings/fees','ShipmentSettingController@feesSettings')->name('shipments.settings.fees');
    Route::post('shipments/settings/fees','ShipmentSettingController@storeFeesSettings')->name('shipments.settings.fees.store');

    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
    Route::post('/google_map', 'BusinessSettingsController@google_map_update')->name('google_map.update');

    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('email_settings.index');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');

    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');

    Route::get('/sms-gateways', 'BusinessSettingsController@sms_gateways')->name('sms_gateways.index');

  });
}
