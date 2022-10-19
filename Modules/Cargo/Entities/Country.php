<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'countries';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\CountryFactory::new();
    }
}
