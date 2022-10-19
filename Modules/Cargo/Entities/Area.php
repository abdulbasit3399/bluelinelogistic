<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'areas';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\AreaFactory::new();
    }
    public function state(){
        return $this->hasOne('Modules\Cargo\Entities\State', 'id' , 'state_id');
    }
}
