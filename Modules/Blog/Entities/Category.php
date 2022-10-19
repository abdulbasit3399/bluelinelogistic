<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use App\Core\Traits\SpatieLogsActivity;
use App\Helpers\HelperTraits\FileHelper;
use Modules\Blog\Events\CategoryDeletedEvent;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{

    use InteractsWithMedia;
    use 
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity,
    // FileHelper for upload files or images
    FileHelper,
    // HasTranslations for add translate for any field
    HasTranslations;


    protected $fillable = [
        'creator_id',
        'parent_id',
        'name',
        'slug',
        'description',
        'active'
    ];
    
    protected $casts = [
        'active' => 'boolean'
    ];
    
    public $translatable = ['name', 'description']; // Columns to translate


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }



    protected static function booted()
    {
        // when creating category
        // static::creating(function ($category) {
        //     $slug = $category->slug ?? $category->name;
        //     $category->slug = Str::slug($slug);
        //     $category->creator_id = auth()->id();
        //     foreach(array_keys(get_langauges_except_current()) as $lang_code)
        //     {
        //         if ($category->description != '') {
        //             $category->setTranslation('description', $lang_code, $category->description);
        //         }
        //         if ($category->name != '') {
        //             $category->setTranslation('name', $lang_code, $category->name);
        //         }
        //     }
        // });


        
        // when deleted category
        static::deleted(function ($category) {
            // unset relation category
            Category::where('parent_id', $category->id)->update(['parent_id' => null]);
            
            event(new CategoryDeletedEvent($category));
        });
    }


    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function categoryChilds()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
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
        return $query->where('categories.active', intval($status));
    }
}
