<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipmentReason extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'shipment_reasons';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ShipmentReasonFactory::new();
    }

    public function shipment(){
        return $this->belongsTo('Modules\Cargo\Entities\Shipment', 'shipment_id');
    }

    public function reason(){
        return $this->belongsTo('Modules\Cargo\Entities\Reason', 'reason_id');
    }
}
