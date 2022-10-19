<?php

namespace Modules\Localization\Entities;

use Modules\Localization\Events\LanguageDeletedEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\Traits\SpatieLogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Language extends Model implements HasMedia
{
    use InteractsWithMedia,
        // SpatieLogsActivity for save log activity
        SpatieLogsActivity,
        SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'code',
        'dir',
        'script',
        'native',
        'regional',
        'is_default',
        'creator_id',
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    protected static function booted()
    {
        // when creating language
        static::creating(function ($language) {
            $language->creator_id = auth()->id();
        });


        // when deleted language
        static::deleted(function ($language) {

            // remove image when deleted category
            if ($language->image && $language->image != null) {
                $language->deleteFile($language->image, config('module_localization.dir_images'));
            }

            event(new LanguageDeletedEvent($language));
        });
    }



    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


    /* ========================================= Scopes ========================================= */

    /**
     * Scope a query to only include default lang.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', 1)->first();
    }

    /**
     * Scope a query to only include current lang.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        $locale = app()->getLocale() ? app()->getLocale() : 'en';
        return $query->where('code', $locale)->first();
    }

}