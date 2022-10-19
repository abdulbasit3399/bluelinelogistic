<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'delivery_time';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\DeliveryTimeFactory::new();
    }
}
