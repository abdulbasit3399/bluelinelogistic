<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientShipmentLog extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = "client_shipment_logs";
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ClientShipmentLogFactory::new();
    }
}
