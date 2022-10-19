<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Modules\Widget\Entities\Widget;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomSetting extends Model implements HasMedia
{
    use InteractsWithMedia;
    use
    Cachable,
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;

    protected $fillable = [
        'creator_id',
        'data',
        'section',
        'place',
        'widget_id',
        'container_id',
        'theme',
        'sort'
    ];

    protected $casts = [
        'data' => 'array',
        'sort' => 'integer'
    ];

    protected $cachePrefix = "custom_settings";


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    public function getDataMapedAttribute()
    {
        $theme = $this->theme;
        $prefix_image = config("theme_{$theme}.prefix_image");
        $data = $this->data;
        if ($prefix_image) {
            $dir_images = config("theme_{$theme}.dir_images");

            foreach ($data as $key => $value) {
                if (is_string($value) && strpos($value, $prefix_image) === 0) {
                    $image_name = substr($value, strlen($prefix_image));
                    $uri = $dir_images . '/' . $image_name;
                    $path = public_path('storage/'. $uri);
                    $data[$key . '_name'] = $image_name;
                    $data[$key . '_url'] = file_exists($path) ? Storage::url($uri) : null;
                }
            }
        }    



        return $data;

        // $uri = self::DIRECTORY_IMAGE . '/' . $this->image;
        // $path = public_path('storage/'. $uri);
        // return is_file($path) && file_exists($path) ? Storage::url($uri) : null;
    }

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

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

}
