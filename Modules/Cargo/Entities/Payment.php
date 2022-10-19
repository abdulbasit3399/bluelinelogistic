<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'payments';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\PaymentFactory::new();
    }

    public function shipment(){
        return $this->belongsTo('Modules\Cargo\Entities\Shipment', 'shipment_id');
    }
    public function client(){
        return $this->belongsTo('Modules\Cargo\Entities\Client', 'seller_id');
    }
}
