<?php

namespace Modules\Cargo\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\UserCollection;
use Modules\Cargo\Http\Controllers\MissionController;
use Modules\Cargo\Http\Controllers\ShipmentController;
use app\Http\Helpers\ApiHelper;
use App\Models\User;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\Reason;
use Modules\Cargo\Entities\MissionLocation;
use Modules\Acl\Repositories\AclRepository;

class MissionsController extends Controller
{
    public function getCaptainMissions(Request $request)
    {
        
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);
        if($user){

            $driver = Driver::where('user_id',$user->id)->first();
            $missions = new Mission;
            $missions = $missions->where('captain_id', $driver->id);

            if($request->status_id){
                $missions = $missions->where('status_id', $request->status_id );
            }
            if($request->id){
                $missions = $missions->where('id', $request->id );
            }

            $missions = $missions->get();
            return response()->json($missions);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function changeMissionApi(Request $request)
    {
        $apihelper = new ApiHelper();
        $missionsController = new MissionController(new AclRepository);
        $user = $apihelper->checkUser($request);
        if($user){
            $request->validate([
                'ids' => 'required',
                'to'  => 'required',
            ]);
            $status = $missionsController->change($request,$request->to,true);
            if($status){
                return response()->json(['message' => 'Status Changed Successfully!']);
            }else
                return response()->json($status);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function RemoveShipmetnFromMission(Request $request)
    {
        
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);
        if($user){
            $request->validate([
                'mission_id'  => 'required',
                'shipment_id' => 'required',
                'reason'      => 'required',
            ]);

            $shipmentController = new ShipmentController(new AclRepository);
            $status = $shipmentController->removeShipmentFromMission($request, true);
            if($status){
                return response()->json(['message' => 'Shipment Removed Successfully']);
            }else{
                return response()->json($status);
            }
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }

    public function getReasons(Request $request)
    {
        
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);
        if($user){
            $reasons = Reason::get();
            return response()->json($reasons);
        }else{
            return response()->json(['message' => 'Not Authorized']);
        }
    }
    
}