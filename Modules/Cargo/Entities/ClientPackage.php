<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientPackage extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'client_packages';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ClientPackageFactory::new();
    }
}
