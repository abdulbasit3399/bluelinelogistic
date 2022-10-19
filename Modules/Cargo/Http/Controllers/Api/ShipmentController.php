<?php

namespace Modules\Cargo\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Resources\UserCollection;
use app\Http\Helpers\ApiHelper;
use App\Models\User;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Cargo\Entities\ShipmentSetting;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentMission;
use Modules\Cargo\Entities\PackageShipment;
use Modules\Cargo\Entities\Package;
use Modules\Cargo\Entities\DeliveryTime;
use Modules\Currency\Entities\Currency;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Country;
use Modules\Cargo\Entities\State;
use Modules\Cargo\Entities\Area;
use Modules\Cargo\Entities\Branch;

class ShipmentController
{
    public function ajaxGetPackages(Request $request)
    {
        $items = Package::get();
        return response()->json($items);
    }
    public function ajaxGetDeliveryTimes(Request $request)
    {
        $items = DeliveryTime::get();
        return response()->json($items);
    }

    public function getPaymentTypes(Request $request)
    {
      	$paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        return response()->json($paymentSettings);
    }

    public function getSetting(Request $request)
    {
        $ShipmentSetting = ShipmentSetting::whereIn('key',['is_date_required' , 'def_shipping_date' , 'def_shipment_type' , 'def_payment_type' , 'def_payment_method' , 'def_package_type' , 'def_branch'])->get();
        return response()->json($ShipmentSetting);
    }

    public function getMissionShipments(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);
		
        if($user){
            $mission_shipments = ShipmentMission::where('mission_id', $request->mission_id )->with('shipment' , 'shipment.from_address')->get();
            return response()->json($mission_shipments);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function getShipmentPackages(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $shipmentPackages = PackageShipment::where('shipment_id', $request->shipment_id)->with('package')->get();
            return response()->json($shipmentPackages);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function tracking(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $model = Client::where('user_id',$user->id)->first();
            $shipment = Shipment::where('client_id',$model->id)->where('code', $request->code)->with(['logs','from_address'])->first();
            if($shipment){
                return response()->json($shipment);
            }else{
                return response()->json(['message' => 'Invalid shipment code'] );
            }

        }else{
            return response()->json(['message' => 'Not Authorized']);
        }

    }

    public function showRegisterInDriverApp(Request $request)
    {
        $showRegisterInDriverApp = ShipmentSetting::where('key','show_register_in_driver_app')->first();
        return response()->json($showRegisterInDriverApp);
    }

    public function countriesApi()
    {
        $items = Country::select('id', 'name','currency','phonecode')->where('covered',1)->get();
        return response()->json($items);
    }

    public function ajaxGetStates()
    {
        $country_id = $_GET['country_id'];
        if(!Country::find($country_id)){
            return response()->json(['message' => 'Invalid Country']);
        }
        $items = State::where('country_id', $country_id)->where('covered',1)->get();
        return response()->json($items);
    }

    public function ajaxGetAreas()
    {
        $state_id = $_GET['state_id'];
        if(!State::find($state_id)){
            return response()->json(['message' => 'Invalid State']);
        }
        $items = Area::where('state_id', $state_id)->get();
        return response()->json($items);
    }

    public function ajaxGetNotifications(Request $request)
    {

        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $notification = $user->notifications()->select('data','created_at')->where('notifiable_type','App\User')->where('notifiable_id', $user->id)->get();
            return response()->json($notification);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function getConfirmationTypeMission(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $confirmType = ShipmentSetting::where('key', 'def_shipment_conf_type')->first();
            return response()->json($confirmType);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        } 
    }

    public function getBranchs(Request $request)
    {
        $branches = Branch::where('is_archived',0)->get();
        return response()->json($branches);
    }
}

