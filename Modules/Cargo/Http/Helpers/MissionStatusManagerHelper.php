<?php

namespace Modules\Cargo\Http\Helpers;

use Modules\Cargo\Entities\ClientShipmentLog;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentSetting;
use Modules\Cargo\Entities\Transaction;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Cargo\Http\Helpers\ShipmentPRNG;
use Modules\Cargo\Http\Helpers\TransactionHelper;
use Modules\Cargo\Http\Helpers\StatusManagerHelper;
use Modules\Cargo\Entities\ShipmentMission;
use DB;

class MissionStatusManagerHelper
{


    //Mission Status Manager

    public function change_mission_status($missions_ids, $to, $captain_id = null,$params=array())
    {

        $response = array();
        $response['success'] = 1;
        $response['error_msg'] = '';
        try {
            
            DB::beginTransaction();
            $transaction = new TransactionHelper();
            $INVOICE_PAYMENT = 'invoice_payment';
            $missions = Mission::whereIn('id', $missions_ids)->get();
            foreach ($missions as $mission) {

                
                $helper = new TransactionHelper();
                $mission_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);

                if($mission->status_id == $to)
                {
                    throw new \Exception("Out of status changer scope");
                }
                if ($mission != null) {
                    
                    
                    if(isset($params['amount']))
                    {
                        $mission->amount = $params['amount'];
                    }

                    $oldStatus = $mission->status_id;

                    if ($to == Mission::APPROVED_STATUS) {
                        
                        if ($captain_id != null) {
                            
                            $mission->captain_id = $captain_id;
                            if(isset($params['due_data']))
                            {
                                $mission->due_date = $params['due_data'];
                            }
                        } else {
                            throw new \Exception("Driver is required in this step");
                        }

                    }

                    if ($to == Mission::RECIVED_STATUS) {
                        
                        foreach ($mission->shipment_mission as $shipment_mission)
                        {
                            $shipment_mission->shipment->otp  = ShipmentPRNG::get();
                            $shipment_mission->shipment->save();
                        }


                        if ($mission->getRawOriginal('type') == Mission::RETURN_TYPE) {

                            $client   = Client::where('id',$mission->client_id)->first();
                            $gateways[] = 'sms';
                            $data = array(
                                'phone'   =>  $client->responsible_mobile ,
                                'message'   =>  array(
                                    'subject'   =>  'this is your mission otp '. $mission->otp  ,
                                ),
                            );
                            // $send_sms_otp = new Modules\Cargo\Entities\Notifications\GlobalNotification($data, $gateways);
                            if(session()->has('sms_error'))
                            {
                                flash(__('cargo::view.notification_sms_not_sent_please_check_sms_verification'))->error();
                                Session::forget('sms_error');
                            }
                        }

                        if ($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE) {

                            foreach ($mission->shipment_mission as $shipment_mission)
                            {

                                $shipment   = Shipment::where('id',$shipment_mission->shipment->id)->first();
                                $gateways[] = 'sms';
                                $data = array(
                                    'phone'   =>  $shipment->reciver_phone ,
                                    'message'   =>  array(
                                        'subject'   =>  'this is your shipment otp '. $shipment->otp  ,
                                    ),
                                );
                                // $send_sms_otp = new Modules\Cargo\Entities\Notifications\GlobalNotification($data, $gateways);
                            }
                            if(session()->has('sms_error'))
                            {
                                flash(__('cargo::view.notification_sms_not_sent_please_check_sms_verification'))->error();
                                Session::forget('sms_error');
                            }

                            //Hook shipment backend in Mission status changed
                            if (\Schema::hasTable('shipment_mission') && class_exists("Modules\Cargo\Entities\ShipmentMission") && class_exists("Modules\Cargo\Entities\Shipment") && class_exists("Modules\Cargo\Http\Helpers\StatusManagerHelper")) {

                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::RECIVED_STATUS, $mission->id);
                                }
                            }
                        }

                        if ($mission->getRawOriginal('type') == Mission::PICKUP_TYPE) {

                            if($mission->shipment_mission[0]->shipment->payment_method_id == $INVOICE_PAYMENT)
                            {
                                $client = $mission->client;
                                $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CLIENT,$mission->client_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'ADD PICKUP COST TO WALLET / PICKUP MISSION / INVOICE PAYMENT / MISSION ( '.$mission->code.')', $client->branch_id);
                            }else{
                                $captain = $mission->captain;
                                $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::CREDIT,Transaction::MESSION_TYPE,'ADD PICKUP COST TO WALLET / PICKUP MISSION / MISSION ( '.$mission->code.')', $captain->branch_id);
                            }
                        }

                        if($mission->getRawOriginal('type')  == Mission::SUPPLY_TYPE)
                        {
                            $helper = new TransactionHelper();
                            $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);

                            $captain = $mission->captain;
                            $transaction->create_mission_transaction($mission->id,$shipment_cost ,Transaction::CAPTAIN,$mission->captain_id,Transaction::CREDIT,Transaction::MESSION_TYPE,'ADD AMOUNT TO BE COLLECTED TO WALLET / SUPPLY MISSION / MISSION ( '.$mission->code.')', $captain->branch_id);
                        }
                        
                    }
                    
                    if ($to == Mission::DONE_STATUS) {

                        if ($mission->getRawOriginal('type') == Mission::PICKUP_TYPE) {
                            if($mission->shipment_mission[0]->shipment->payment_method_id != $INVOICE_PAYMENT)
                            {
                                if(ShipmentSetting::getVal('mission_done_with_fees_received')=='1' || ShipmentSetting::getVal('mission_done_with_fees_received') == null ){
                                    $captain = $mission->captain;
                                    $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'DEDUCT PICKUP COST FROM WALLET / PICKUP MISSION / MISSION ( '.$mission->code.')', $captain->branch_id);
                                }
                            }
                        }

                        if($mission->getRawOriginal('type')  == Mission::RETURN_TYPE)
                        {
                            $client = $mission->client;

                            if($mission->shipment_mission[0]->shipment->payment_method_id == $INVOICE_PAYMENT)
                            {
                                $client = $mission->client;
                                $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CLIENT,$mission->client_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'DEDUCT RETURN COST FROM WALLET / RETURN MISSION / INVOICE PAYMENT / MISSION ( '.$mission->code.' )', $client->branch_id);
                            }else{
                                $captain = $mission->captain;
                                $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::CREDIT,Transaction::MESSION_TYPE,'ADD RETURN COST TO WALLET / RETURN MISSION / MISSION ( '.$mission->code.' )', $captain->branch_id);
                            }

                        }

                        if($mission->getRawOriginal('type')  == Mission::SUPPLY_TYPE)
                        {
                            $amount_to_bo_collected = 0 ;
                            foreach ($mission->shipment_mission as $shipment_mission)
                            {
                                $amount_to_bo_collected += $shipment_mission->shipment->amount_to_be_collected;
                            }
                            $client = $mission->client;
                            $captain = $mission->captain;
                            
                            if($mission->shipment_mission[0]->shipment->payment_method_id == $INVOICE_PAYMENT)
                            {
                                $transaction->create_mission_transaction($mission->id,$client->supply_cost,Transaction::CLIENT,$mission->client_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'DEDUCT SUPPLY COST FROM WALLET / SUPPLY MISSION / INVOICE PAYMENT / MISSION ( '.$mission->code.' )', $client->branch_id);
                            }

                            $helper = new TransactionHelper();
                            $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);

                            $transaction->create_mission_transaction($mission->id,$shipment_cost,Transaction::CAPTAIN,$mission->captain_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'DEDUCT FROM WALLET / SUPPLY MISSION / MISSION ( '.$mission->code.' )', $captain->branch_id);
                            $transaction->create_mission_transaction($mission->id,$amount_to_bo_collected,Transaction::CLIENT,$mission->client_id,Transaction::DEBIT,Transaction::MESSION_TYPE,'DEDUCT FROM WALLET / SUPPLY MISSION / MISSION ( '.$mission->code.' )', $client->branch_id);
                        }


                        if ($mission->getRawOriginal('type') == Mission::TRANSFER_TYPE) {
                            foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                $shipment = Shipment::find($shipment_id);
                                $oldClientStatus = $shipment->client_status;
                                $shipment->client_status = Shipment::CLIENT_STATUS_RECEIVED_BRANCH;
                                $log = new ClientShipmentLog();
                                $log->from = $oldClientStatus;
                                $log->to = Shipment::CLIENT_STATUS_RECEIVED_BRANCH;
                                $log->shipment_id = $shipment->id;
                                $log->created_by = \Auth::user()->id;
                                $log->save();
                            }
                        }

                        if ($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE) {

                            $client  = $client = Client::where('id', $params['shipment_id']['client_id'] )->first();
                            $captain = $mission->captain;

                            $captain_amount = $params['shipment_id']['shipping_cost'] + $params['shipment_id']['tax'] + $params['shipment_id']['insurance'] + $params['shipment_id']['amount_to_be_collected'];

                            $transaction->create_mission_transaction($mission->id,$captain_amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::CREDIT,Transaction::MESSION_TYPE,'ADD SHIPPING COST TO WALLET / DELIVERY MISSION / SHIPMENT ( '.$params['shipment_id']['code'].' )', $captain->branch_id);
                            $transaction->create_mission_transaction($mission->id,$params['shipment_id']['amount_to_be_collected'],Transaction::CLIENT,$params['shipment_id']['client_id'],Transaction::CREDIT,Transaction::MESSION_TYPE,'ADD COD TO WALLET / DELIVERY MISSION / SHIPMENT ( '.$params['shipment_id']['code'].' )', $client->branch_id);

                            //change shipment status to DELIVERED
                            $action = new StatusManagerHelper();
                            $response = $action->change_shipment_status([$params['shipment_id']['id']], Shipment::DELIVERED_STATUS, $mission->id);
                        }


                        if (\Schema::hasTable('shipment_mission') && class_exists("Modules\Cargo\Entities\ShipmentMission") && class_exists("Modules\Cargo\Entities\Shipment") && class_exists("Modules\Cargo\Http\Helpers\StatusManagerHelper")) {
                            if ($mission->getRawOriginal('type') == Mission::PICKUP_TYPE) {
                                //Hook shipment backend in Mission status changed

                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::APPROVED_STATUS, $mission->id);
                                }

                            }

                            if ($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE) {
                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    if($shipment->status_id != Shipment::CAPTAIN_ASSIGNED_STATUS)
                                    {
                                        if($shipment->status_id == Shipment::RETURNED_STATUS){
                                            $change_status_to_be_approved = new StatusManagerHelper();
                                            $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::RETURNED_STOCK, $mission->id);
                                        }
                                    }
                                }
                            }

                            if ($mission->getRawOriginal('type') == Mission::TRANSFER_TYPE) {
                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    $oldClientStatus = $shipment->client_status;
                                    $shipment->prev_branch = $shipment->branch_id;
                                    $shipment->branch_id = $mission->to_branch_id;
                                    $shipment->save();
                                    $shipment->client_status = Shipment::CLIENT_STATUS_TRANSFERED;
                                    $log = new ClientShipmentLog();
                                    $log->from = $oldClientStatus;
                                    $log->to = Shipment::CLIENT_STATUS_TRANSFERED;
                                    $log->shipment_id = $shipment->id;
                                    $log->created_by = \Auth::user()->id;
                                    $log->save();
                                }
                            }

                            if ($mission->getRawOriginal('type') == Mission::RETURN_TYPE) {
                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    if($shipment->status_id == Shipment::RETURNED_STOCK){
                                        $change_status_to_be_approved = new StatusManagerHelper();
                                        $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::RETURNED_CLIENT_GIVEN);
                                    }
                                }
                            }

                            if ($mission->getRawOriginal('type') == Mission::SUPPLY_TYPE) {
                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::SUPPLIED_STATUS);
                                }
                            }
                        }

                    }
                    
                    if($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE && $to == Mission::DONE_STATUS )
                    {
                        $mission->status_id = $mission->status_id;
                    }else{
                        $mission->status_id = $to;
                    }

                    if (!$mission->save()) {
                        throw new \Exception("can't change mission status");
                    }

                    //After change action
                    if ($to == Mission::APPROVED_STATUS) {
                        if ($mission->getRawOriginal('type') == Mission::PICKUP_TYPE) {

                        }
                        if ($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE) {

                            //Hook shipment backend in Mission status changed
                            if (\Schema::hasTable('shipment_mission') && class_exists("Modules\Cargo\Entities\ShipmentMission") && class_exists("Modules\Cargo\Entities\Shipment") && class_exists("Modules\Cargo\Http\Helpers\StatusManagerHelper")) {

                                foreach (ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], Shipment::CAPTAIN_ASSIGNED_STATUS, $mission->id);
                                }
                            }
                        }
                    }

                    
                    if ($to == Mission::CLOSED_STATUS || $to == Mission::DONE_STATUS )
                    {
                        
                        if($mission->getRawOriginal('type') == Mission::DELIVERY_TYPE && $to == Mission::DONE_STATUS)
                        {
                            $shipments = Shipment::where('id',$params['shipment_id']['id'])->get();

                            $shipments_mission = Shipment::where('mission_id', $params['shipment_id']['mission_id'])->count();
                            if($shipments_mission == 1 || $shipments_mission == 0)
                            {
                                $mission->status_id = $to;
                                if (!$mission->save()) {
                                    throw new \Exception("can't change mission status");
                                }
                            }

                        }else{
                            $shipments = Shipment::where('mission_id',$mission->id)->get();
                        }

                        foreach ($shipments as $shipment)
                        {
                            $shipment->mission_id = null ;
                            $shipment->save();
                        }


                    }

                } else {
                    throw new \Exception("There is no mission with this Code");
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            //echo $e->getMessage();exit;
            DB::rollback();
            $response['success'] = 0;
            $response['error_msg'] = $e->getMessage();
        }
        return $response;
    }
}
