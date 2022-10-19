<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;

class Driver extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'drivers';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\DriverFactory::new();
    }

    public function branch(){
        return $this->hasOne('Modules\Cargo\Entities\Branch', 'id', 'branch_id');
    }
    public function getDeivers($query)
    {
        if(auth()->user()->role == 1){
            return $query->where('is_archived', 0);
        }elseif(auth()->user()->role == 3){
            $branch = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
        }elseif(auth()->user()->can('manage-drivers') && auth()->user()->role == 0){
            $branch = Staff::where('user_id',auth()->user()->id)->pluck('branch_id')->first();
        }
        return $query->where('is_archived', 0)->where('branch_id', $branch);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class, 'captain_id');
    }
    public function getTypeAttribute($value)
    {
        if ($value == Self::PICKUP_MISSION) {
        return __('cargo::view.pickup');
        } elseif ($value == Self::DELIVERY_MISSION) {
        return __('cargo::view.delivery');
        } elseif ($value == Self::ALL_MISSIONS) {
        return __('cargo::view.pickup_delivery');
        } else {
        return $value;
        }
    }

}
