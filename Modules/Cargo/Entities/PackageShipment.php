<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageShipment extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'package_shipment';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\PackageShipmentFactory::new();
    }
    
    public function package(){
      return $this->hasOne('Modules\Cargo\Entities\Package', 'id' , 'package_id');
    }
    
}
