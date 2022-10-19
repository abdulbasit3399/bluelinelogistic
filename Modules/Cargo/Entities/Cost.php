<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'costs';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\CostFactory::new();
    }
}
