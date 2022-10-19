<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentStatus extends Model
{
    use HasFactory;

    protected $table = 'shipment_status';
}
