<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use Modules\Blog\Events\TagDeletedEvent;
use Illuminate\Support\Str;
use App\Models\User;

class Tag extends Model
{
    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;

    protected $fillable = [
        'creator_id',
        'name',
        'slug',
        'description'
    ];



    protected static function booted()
    {
        // when creating tag
        static::creating(function ($tag) {
            $slug = $tag->slug ?? $tag->name;
            $tag->slug = Str::slug($slug);
            $tag->creator_id = auth()->id();
        });

        // when updating tag
        static::updating(function ($tag) {
            $slug = $tag->slug ?? $tag->name;
            $tag->slug = Str::slug($slug);
        });
        

        // when deleted tag
        static::deleted(function ($tag) {
            event(new TagDeletedEvent($tag));
        });
    }


    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }



    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

}
