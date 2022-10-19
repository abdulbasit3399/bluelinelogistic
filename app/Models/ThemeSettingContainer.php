<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use App\Models\User;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;

class ThemeSettingContainer extends Model implements HasMedia
{
    use InteractsWithMedia;
    use
    Cachable,
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;

    protected $fillable = [
        'creator_id',
        'data',
        'place',
        'theme',
        'sort'
    ];

    protected $casts = [
        'data' => 'array',
        'sort' => 'integer'
    ];

    protected $cachePrefix = "theme_setting_containers";


    protected static function booted()
    {
        // when creating widget
        static::creating(function ($widget) {
            $widget->creator_id = auth()->id();
        });
    }


    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function sections()
    {
        return $this->hasMany(CustomSetting::class, 'container_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

}
