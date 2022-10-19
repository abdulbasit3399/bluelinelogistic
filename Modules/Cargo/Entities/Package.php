<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'packages';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\PackageFactory::new();
    }
}
