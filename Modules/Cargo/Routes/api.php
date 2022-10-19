<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/cargo', function (Request $request) {
    return $request->user();
});

// Auth Apis Routes
Route::prefix('v1/auth')->group(function () {

    Route::post('signup', 'Api\AuthController@signup');
    Route::post('login', 'Api\AuthController@login');

});

Route::get('get-wallet', 'Api\AuthController@getWallet');

// Shipments Apis Routes
Route::post('admin/shipments/create', array('uses' => 'ShipmentController@storeAPI'));
Route::get('shipments', array('uses' => 'ShipmentController@getShipmentsAPI'));
Route::get('ConfirmationTypeMission', 'Api\ShipmentController@getConfirmationTypeMission');
Route::get('shipment-by-barcode', 'ShipmentController@ajaxGetShipmentByBarcode');
Route::get('shipmentPackages', 'Api\ShipmentController@getShipmentPackages');
Route::get('shipment-tracking', 'Api\ShipmentController@tracking');
Route::get('shipment-setting', 'Api\ShipmentController@getSetting');

// Missions Apis Routes
Route::post('createMission', 'ShipmentController@createMissionAPI');
Route::post('changeMissionStatus', 'Api\MissionsController@changeMissionApi');
Route::post('remove-shipment-from-mission', 'Api\MissionsController@RemoveShipmetnFromMission');
Route::get('missions', 'Api\MissionsController@getCaptainMissions');

// Get Reasons Api Route
Route::get('reasons', 'Api\MissionsController@getReasons');

Route::get('packages', 'Api\ShipmentController@ajaxGetPackages');
Route::get('DeliveryTimes', 'Api\ShipmentController@ajaxGetDeliveryTimes');
Route::get('MissionShipments', 'Api\ShipmentController@getMissionShipments');
Route::get('countries', 'Api\ShipmentController@countriesApi');
Route::get('states', 'Api\ShipmentController@ajaxGetStates');
Route::get('areas', 'Api\ShipmentController@ajaxGetAreas');
Route::get('notifications', 'Api\ShipmentController@ajaxGetNotifications');
Route::get('payment-types', 'Api\ShipmentController@getPaymentTypes');

// Address Apis Routes
Route::post('addAddress', 'ClientController@addNewAddressAPI');
Route::get('getAddresses', 'ClientController@getAddresses');

// Get Branches Api Route
Route::get('branchs', 'Api\ShipmentController@getBranchs');

// Show Register In Driver App Api Route
Route::get('show-register-in-driver-app', 'Api\ShipmentController@showRegisterInDriverApp');