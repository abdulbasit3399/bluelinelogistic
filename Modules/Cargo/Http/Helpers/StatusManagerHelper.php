<?php

namespace Modules\Cargo\Http\Helpers;

use Modules\Cargo\Entities\ClientShipmentLog;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentLog;
use Modules\Cargo\Entities\ShipmentMission;
use Modules\Cargo\Entities\Transaction;
use Modules\Cargo\Entities\Client;
use DB;
use App\Models\User;

class StatusManagerHelper{

    public function change_shipment_status($shipments,$to,$mission_id = null)
    {
        $response = array();
		$response['success'] = 1;
		$response['error_msg'] = '';
		try {
			DB::beginTransaction();
            
            $transaction = new TransactionHelper();
            foreach($shipments as $shipment_id)
            {
                
                $shipment = Shipment::find($shipment_id);
                $client   = Client::where('id',$shipment->client_id)->pluck('user_id')->first();
                $user     = User::where('id',$client)->pluck('id')->first(); 
                // if($shipment->status_id == $to)
                // {
                //     throw new \Exception("Out of status changer scope");
                // }
                if($shipment != null)
                {
                    $oldStatus = $shipment->status_id;
                    $oldClientStatus = $shipment->client_status;

                    //Conditions of change status
                    if($to == Shipment::REQUESTED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_READY;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_READY;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();
                        
                        if($shipment->getRawOriginal('type') == Shipment::PICKUP)
                        {
                            if($shipment->payment_type == Shipment::PREPAID)
                            {
                                $shipment_cost = $transaction->calculate_shipment_cost($shipment->id);
                                // $transaction->create_shipment_transaction($shipment->id,$shipment_cost,Transaction::CLIENT,$shipment->client_id,Transaction::DEBIT);
                            }
                        }

                    }elseif($to == Shipment::APPROVED_STATUS)
                    {
                        $shipment_mission = ShipmentMission::where('mission_id',$mission_id)->where('shipment_id',$shipment->id)->first();
                        if($shipment_mission){
                            $shipment_mission->delete();
                            $shipment->mission_id = null;
                            $shipment->captain_id = null;
                        }

                        $shipment->client_status = Shipment::CLIENT_STATUS_IN_PROCESSING;                       
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_IN_PROCESSING;
                        $log->shipment_id = $shipment->id;
                        $log->created_by  = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();

                    }elseif($to == Shipment::SAVED_STATUS)
                    {
                        $shipment_mission = ShipmentMission::where('mission_id',$mission_id)->where('shipment_id',$shipment->id)->first();
                        $shipment_mission->delete();
                        $shipment->captain_id = null;
                        $shipment->mission_id = null;

                    }elseif($to == Shipment::CAPTAIN_ASSIGNED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_OUT_FOR_DELIVERY;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_OUT_FOR_DELIVERY;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();
                        if($mission_id != null)
                        {
                                    $mission = Mission::find($mission_id);
                                    $shipment->captain_id = $mission->captain_id;
                        }
                        
                    }elseif($to == Shipment::RETURNED_STOCK)
                    {
                        $shipment->mission_id = null;
                        $shipment->captain_id = null;

                        $shipment->client_status = Shipment::CLIENT_STATUS_RETURNED_STOCK;                       
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_RETURNED_STOCK;
                        $log->shipment_id = $shipment->id;
                        $log->created_by  = auth()->user() ? auth()->user()->id : $user;
                        $log->save();

                    }elseif($to == Shipment::RETURNED_STATUS)
                    {
                        $shipment->mission_id = null;
                        $shipment->captain_id = null;

                        $shipment->client_status = Shipment::CLIENT_STATUS_RETURNED;                       
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_RETURNED;
                        $log->shipment_id = $shipment->id;
                        $log->created_by  = auth()->user() ? auth()->user()->id : $user;
                        $log->save();

                        $shipments_mission = Shipment::where('mission_id', $mission_id)->count();
                        if($shipments_mission == 1 || $shipments_mission == 0)
                        {
                            $mission = Mission::find($mission_id);
                            $mission->status_id = Mission::DONE_STATUS;
                            if (!$mission->save()) {
                                throw new \Exception("can't change mission status");
                            }
                        }

                    }elseif($to == Shipment::RETURNED_CLIENT_GIVEN){

                        $shipment->client_status = Shipment::CLIENT_STATUS_RETURNED_CLIENT_GIVEN;                       
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_RETURNED_CLIENT_GIVEN;
                        $log->shipment_id = $shipment->id;
                        $log->created_by  = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();

                    }elseif($to == Shipment::DELIVERED_STATUS)
                    {
                        
                        $shipment->client_status = Shipment::CLIENT_STATUS_DELIVERED;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_DELIVERED;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();
                    }elseif($to == Shipment::SUPPLIED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_SUPPLIED;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_SUPPLIED;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = auth()->user() ? auth()->user()->id : $user ;
                        $log->save();
                    }
                    
                    $shipment->status_id = $to;
                    if(!$shipment->save())
                    {
                        throw new \Exception("can't change shipment status");
                    }
                    
                    $log = new ShipmentLog();
                    $log->from = $oldStatus;
                    $log->to = $shipment->status_id;
                    $log->shipment_id = $shipment->id;
                    $log->created_by = auth()->user() ? auth()->user()->id : $user ;
                    $log->save();
                }else
                {
                    throw new \Exception("There is no shipment with this ID");
                }
                
            }
            DB::commit();
        }catch (\Exception $e) {
			//echo $e->getMessage();exit;
			DB::rollback();
			$response['success'] = 0;
			$response['error_msg'] = $e->getMessage();
		}
        return $response;
    }



}