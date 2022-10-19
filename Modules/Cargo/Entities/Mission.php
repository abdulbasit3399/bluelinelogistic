<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\Client;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'missions';

    //Types of Missions
    CONST PICKUP_TYPE = 1;
    CONST DELIVERY_TYPE = 2;
    CONST RETURN_TYPE = 3;
    CONST SUPPLY_TYPE = 4;
    CONST TRANSFER_TYPE = 5;

    //Status of Missions
    CONST REQUESTED_STATUS = 1;
    CONST APPROVED_STATUS = 2;
    CONST DONE_STATUS = 3;
    CONST CLOSED_STATUS = 4;
    CONST RECIVED_STATUS = 5;

    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\MissionFactory::new();
    }

    static public function getMissions($query , $request = null){

        $missions = $query;
        $user_role = auth()->user()->role;
        if(isset($user_role))
        {
            if($user_role == 5){ // User Captain
                $user = Driver::where('user_id',auth()->user()->id)->pluck('id')->first();
                $missions = $missions->where('captain_id',$user);
            }elseif($user_role == 4){ // User Branch
                $user = Client::where('user_id',auth()->user()->id)->pluck('id')->first();
                $missions = $missions->where('client_id',$user);
            }
        }

        if (isset($request) && !empty($request)) {

            if (isset($request->type) && !empty($request->type)) {

                if(is_array($request->type)){
                    $missions = $missions->whereIn('type', $request->type );
                }else {
                    $types = explode(',', $request->type);
                    $missions = $missions->where('type', $types);
                }

            }
            if (isset($request->status) && !empty($request->status)) {

                if(is_array($request->status)){
                    $missions = $missions->whereIn('status_id', $request->status );
                }else{
                    if($request->status == 'all')
                    {
                        $missions = $missions->where('id', '!=' , null);
                    }else{
                        $status = explode(',', $request->status);
                        $missions = $missions->whereIn('status_id', $status );
                    }
                }

            }

        }

        return $missions;

    }

    static public function status_info(){
       $array = [
           [
               'status' => Self::REQUESTED_STATUS,
                'text' => __('cargo::view.requested'),
                'route_name' => 'admin.missions.requested.index',
                'route_url'=>'requested',
                'optional_params'=>'/{type?}',
                'color'=>'info',
                'user_role'=>[1,3,4],
                'permissions'=>'requested-missions'
            ],

            [
                'status' => Self::APPROVED_STATUS,
                'text' => __('cargo::view.assigned_approved'),
                'route_name' => 'admin.missions.approved.index',
                'route_url'=>'approved',
                'optional_params'=>'/{type?}',
                'color'=>'primary',
                'user_role'=>[1,3,4,5],
                'permissions'=>'assigned-approved-missions'
            ],

            [
                'status' => Self::RECIVED_STATUS,
                'text' => __('cargo::view.recived'),
                'route_name' => 'admin.missions.recived.index',
                'route_url'=>'recived',
                'optional_params'=>'/{type?}',
                'color'=>'primary',
                'user_role'=>[1,3,4,5],
                'permissions'=>'recived-missions'
            ],

            [
                'status' => Self::DONE_STATUS,
                'text' => __('cargo::view.done'),
                'route_name' => 'admin.missions.done.index',
                'route_url'=>'done',
                'optional_params'=>'/{type?}',
                'color'=>'success',
                'user_role'=>[1,3,4,5],
                'permissions'=>'done-missions'
            ],

            [
                'status' => Self::CLOSED_STATUS,
                'text' => __('cargo::view.closed'),
                'route_name' => 'admin.missions.closed.index',
                'route_url'=>'closed',
                'optional_params'=>'/{type?}',
                'color'=>'danger',
                'user_role'=>[1,3,4],
                'permissions'=>'closed-missions'
            ],
       ];
       return $array;
    }

    public function captain(){
		return $this->hasOne('Modules\Cargo\Entities\Driver', 'id' , 'captain_id');
	}
    public function client(){
		return $this->hasOne('Modules\Cargo\Entities\Client', 'id' , 'client_id');
	}
    public function to_branch(){
		return $this->hasOne('Modules\Cargo\Entities\Branch', 'id' , 'to_branch_id');
	}

    public function shipment_mission(){
		return $this->hasMany('Modules\Cargo\Entities\ShipmentMission', 'mission_id' , 'id');
	}

    public function shipment_mission_by_shipment_id($shipment_id){
		return $this->hasMany('Modules\Cargo\Entities\ShipmentMission', 'mission_id' , 'id')->where('shipment_id',$shipment_id)->get()->first();
	}

    public function shipment_mission_by_payment_type($payment_integration_id,$payment_type){
		return $this->hasMany('Modules\Cargo\Entities\ShipmentMission', 'mission_id' , 'id')->with('shipment', function ($query) use ($payment_integration_id,$payment_type) {
            $query->where('payment_integration_id',$payment_integration_id)->where('payment_type',$payment_type);
        })->get();
	}

    public function getStatus(){
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }

        return $result;
    }

    static public function getStatusByStatusId($status_id_attr){
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }

        return $result;
    }

    static public function getStatusColor($status_id_attr){
        $result = "text-danger";
        foreach(Self::status_info() as $status)
        {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['color']: null;
            if($result != null){
                return $result;
            }
        }

        return $result;
    }

    static public function getStatusByRoute($route_name){
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $result = (isset($status['route_name']) && $status['route_name'] == $route_name) ?$status['status']: null;
            return $result;
        }
        return $result;
    }

    public function getTypeAttribute($value)
    {
        if($value == Self::DELIVERY_TYPE){
            return __('cargo::view.delivery');
        }elseif($value == Self::PICKUP_TYPE){
            return __('cargo::view.pickup');
        }elseif($value == Self::RETURN_TYPE){
            return __('cargo::view.return');
        }elseif($value == Self::SUPPLY_TYPE){
            return __('cargo::view.supply');
        }elseif($value == Self::TRANSFER_TYPE){
            return __('cargo::view.transfer');
        }
    }

    static public function getType($value)
    {
        if($value == Self::DELIVERY_TYPE){
            return __('cargo::view.delivery');
        }elseif($value == Self::PICKUP_TYPE){
            return __('cargo::view.pickup');
        }elseif($value == Self::RETURN_TYPE){
            return __('cargo::view.return');
        }elseif($value == Self::SUPPLY_TYPE){
            return __('cargo::view.supply');
        }elseif($value == Self::TRANSFER_TYPE){
            return __('cargo::view.transfer');
        }else{
            return null;
        }
    }
}