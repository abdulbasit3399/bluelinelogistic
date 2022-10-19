<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reason extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'reasons';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ReasonFactory::new();
    }
}
