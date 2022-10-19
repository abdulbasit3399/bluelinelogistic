<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Mission;

class ShipmentMission extends Model
{
    use HasFactory;

    protected $table = 'shipment_mission';
    protected $guarded = [];
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ShipmentMissionFactory::new();
    }

    static public function check_if_shipment_is_assigned_to_mission($shipment_id,$type){
        $type_missions = Mission::where('type',$type)->pluck('id');
        return Self::where('shipment_id',$shipment_id)->whereIn('mission_id',$type_missions)->count();
    }
    public function shipment(){
      return $this->belongsTo('Modules\Cargo\Entities\Shipment','shipment_id');
    }

    public function mission(){
      return $this->hasOne('Modules\Cargo\Entities\Mission', 'id' , 'mission_id');
    }
}
