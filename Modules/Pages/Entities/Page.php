<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use App\Models\User;
use App\Helpers\HelperTraits\FileHelper;
use Spatie\Translatable\HasTranslations;
use Modules\Pages\Events\PageDeletedEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{

    use InteractsWithMedia;
    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity,
    // FileHelper for upload files or images
    FileHelper,
    // HasTranslations for add translate for any field
    HasTranslations;

    const DIRECTORY_IMAGE = 'page_images';

    protected $fillable = [
        'creator_id', // user id
        'template_id', // template id from config
        'parent_id', // page id (parent)
        // page content
        'title',
        'slug',
        'content',
        'image',
        // featured image
        'featurable_id',
        'featurable_type',
        // page config
        'published', // boolean - default = false
        'active', // boolean - default = true
        'visibility', // string:  public, auth_user, private (for creator page) - default = public
        'publish_on', // date
        'seo_title',
        'seo_description',
    ];


    protected $casts = [
        'published' => 'boolean',
        'active' => 'boolean',
        'publish_on' => 'datetime:Y-m-d H:i:00'
    ];

    public $translatable = ['title', 'content', 'seo_title', 'seo_description']; // Columns to translate
    


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    public function getImageUrlAttribute()
    {
        $uri = self::DIRECTORY_IMAGE . '/' . $this->image;
        $path = public_path('storage/'. $uri);
        return is_file($path) && file_exists($path) ? Storage::url($uri) : null;
    }



    protected static function booted()
    {
        // when creating page
        static::creating(function ($page) {
            $slug = $page->slug ?? $page->title;
            $page->slug = Str::slug($slug);
            $page->creator_id = auth()->id();
        });

        // when updating page
        static::updating(function ($page) {
            $slug = $page->slug ?? $page->title;
            $page->slug = Str::slug($slug);
        });
        


        // when deleted page
        static::deleted(function ($page) {
            // remove image when deleted page
            if ($page->image && $page->image != null) {
                $page->deleteFile($page->image, self::DIRECTORY_IMAGE);
            }
            event(new PageDeletedEvent($page));
        });
    }



    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    
    /* ========================================= Scopes ========================================= */

    /**
     * Scope a query to only include active rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('pages.active', intval($status));
    }

    /**
     * Scope a query to only include published rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query, $status = true)
    {
        return $query->where('pages.published', intval($status));
    }

    /**
     * Scope a query to only include visibility rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibility($query, $type = 'public')
    {
        return $query->where('pages.visibility', $type);
    }

    /**
     * Scope a query to only include visibility rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrVisibility($query, $type)
    {
        if ($type) {
            return $query->orWhere('pages.visibility', $type);
        }
    }

    /**
     * Scope a query to only include publish_on after current date rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublishOn($query, $date = null)
    {
        $date = is_null($date) ? date('Y-m-d H:i') : $date;
        return $query->where(function($sub_query) use ($date) {
            return $sub_query->where('pages.publish_on', '<=', $date)->orWhereNull('publish_on');
        });
    }

    /**
     * Scope a query to only include show in front rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShowInFront($query)
    {
        $q = $query->active()->published()->publishOn()->where(function($sub_query) {
            $sub_query->visibility();
            if (auth()->check()) {
                $sub_query->orVisibility('auth_user');
            }
        });
        return $q;
    }

    public function staticPages()
    {
        $list = array();
        if (check_module('blog')) {
            $list[] = 
            (object) [
                'id'    => '/blog',
                'title' => __('pages::view.blog')
            ];
        }
        if (check_module('cargo')) {
            $list[] = 
            (object) [
                'id'    => '/shipments/tracking/view',
                'title' => __('cargo::view.tracking')
            ];

            $list[] = 
            (object) [
                'id'    => '/shipments/calculator',
                'title' => __('cargo::view.shipment_calculator')
            ];

            $list[] = 
            (object) [
                'id'    => '/admin/register',
                'title' => __('pages::view.register')
            ];
        }

        $list[] = 
            (object) [
                'id'    => '/admin/login',
                'title' => __('pages::view.login')
            ];
        return $list;
    }

}