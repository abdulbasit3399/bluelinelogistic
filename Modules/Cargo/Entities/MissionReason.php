<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MissionReason extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'mission_reasons';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\MissionReasonFactory::new();
    }
}
