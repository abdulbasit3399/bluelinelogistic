<?php

namespace Modules\Cargo\Entities;

use Modules\Cargo\Entities\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientAddress extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'client_addresses';

    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ClientAddressFactory::new();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }


    static public function getClientAddresses($query , $request = null){


        $user_role = auth()->user()->role;

        if(isset($user_role)){
            if($user_role == 4){
                $user = Client::where('user_id',auth()->user()->id)->pluck('id')->first();
                $query = $query->where('client_id', $user);
            }
        }
        return $query;
    }


    public function country(){
        return $this->hasOne('Modules\Cargo\Entities\Country', 'id', 'country_id');
    }

    public function  area(){
        return $this->hasOne('Modules\Cargo\Entities\Area', 'id', 'area_id');
    }

    public function state(){
        return $this->hasOne('Modules\Cargo\Entities\State', 'id', 'state_id');
    }





}