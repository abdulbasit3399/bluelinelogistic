<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Branch extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'branches';

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
        return \Modules\Cargo\Database\factories\BranchFactory::new();
    }
    public function getBranches($query)
    {
        if(auth()->user()->role == 3){
            $branch = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
            return $query->where('is_archived', 0)->where('id', $branch);
        }
        return $query->where('is_archived', 0);
    }
}
