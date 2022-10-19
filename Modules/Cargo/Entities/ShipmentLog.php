<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipmentLog extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'shipment_log';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ShipmentLogFactory::new();
    }
}
