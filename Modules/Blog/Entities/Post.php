<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use App\Models\User;
use App\Helpers\HelperTraits\FileHelper;
use Spatie\Translatable\HasTranslations;
use Modules\Blog\Events\PostDeletedEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
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
        'creator_id', // user id
        // post content
        'title',
        'slug',
        'content',
        'featurable_id',
        'featurable_type',
        // post config
        'published', // boolean - default = false
        'active', // boolean - default = true
        'visibility', // string:  public, auth_user, private (for creator post) - default = public
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



    protected static function booted()
    {
        // when creating post
        static::creating(function ($post) {
            $slug = $post->slug ?? $post->title;
            $post->slug = Str::slug($slug);
            $post->creator_id = auth()->id();
        });

        // when updating post
        static::updating(function ($post) {
            $slug = $post->slug ?? $post->title;
            $post->slug = Str::slug($slug);
        });
        


        // when deleted post
        static::deleted(function ($post) {
            // delete all tags
            $post->tags()->detach();

            // remove image when deleted post
            if ($post->image && $post->image != null) {
                $post->deleteFile($post->image, self::DIRECTORY_IMAGE);
            }

            event(new PostDeletedEvent($post));
        });
    }



    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    
    // public function medias()
    // {
        // return $this->morphToMany(Media::class, 'mediable');
    // }
    

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    

    public function allCategories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category')->where('categories.active', 1);
    }
    

    public function getCategoryAttribute()
    {
        return $this->categories()->first();
    }

    
    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function commentsLevel1()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereIn('approved', [0, 1])->whereNull('parent_id');
    }

    
    public function approvedComments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('approved', 1);
    }


    public function comments()
    {
        $comments = $this->morphMany(Comment::class, 'commentable');
        if (auth()->check()) {
            $comments->where(function ($q) {
                $q->where('approved', 1);
                $q->orWhere(function ($q) {
                    $q->where('approved', 0)->where('creator_id', auth()->id());
                });
            });
        } else if (get_comment_author()) {
            $comments->where(function ($q) {
                $q->where('approved', 1);
                $q->orWhere(function ($q) {
                    $author = get_comment_author();
                    $q->where('approved', 0)->where('author_email', $author->author_email);
                });
            });
        } else {
            $comments->where('approved', 1);
        }
        return $comments;
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
        return $query->where('posts.active', intval($status));
    }

    /**
     * Scope a query to only include published rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query, $status = true)
    {
        return $query->where('posts.published', intval($status));
    }

    /**
     * Scope a query to only include visibility rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibility($query, $type = 'public')
    {
        return $query->where('posts.visibility', $type);
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
            return $query->orWhere('posts.visibility', $type);
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
        $date = is_null($date) ? date('Y-m-d H:i:s') : $date;
        return $query->where(function($sub_query) use ($date) {
            return $sub_query->where('posts.publish_on', '<=', $date)->orWhereNull('publish_on');
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

}
