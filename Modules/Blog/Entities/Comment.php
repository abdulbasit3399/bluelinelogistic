<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use Modules\Blog\Events\CommentCreatedEvent;
use Modules\Blog\Events\CommentUpdatedEvent;
use Modules\Blog\Events\CommentDeletedEvent;

use App\Models\User;

class Comment extends Model
{
    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;

    protected $fillable = [
        'creator_id',
        'content',
        'approved',
        'author_name',
        'author_email',
        'author_website',
        'parent_id',
    ];



    protected static function booted()
    {
        // when creating comment
        static::creating(function ($comment) {
            $auto_approval = get_settings('auto_comments_approval', true);
            if (!$auto_approval) {
                $comment->approved = 0;
            }
            $comment->creator_id = auth()->check() ? auth()->id() : null;
        });

        // when updating comment
        static::updating(function ($comment) {
            
        });


        // when updating comment
        static::updated(function ($comment) {
            event(new CommentUpdatedEvent($comment));
        });

        // when created comment
        static::created(function ($comment) {
            event(new CommentCreatedEvent($comment));
        });

        // when deleted comment
        static::deleted(function ($comment) {
            event(new CommentDeletedEvent($comment));
        });
    }


    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id')->whereIn('approved', [0, 1]);
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function comments()
    {
        $comments = $this->hasMany(Comment::class, 'parent_id');
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

    



    /**
     * Get the parent commentable model (post or any).
     */
    public function commentable()
    {
        return $this->morphTo();
    }




    public function getDateAttribute()
    {
        return date('F j, Y', strtotime($this->created_at)) . ' at ' . date('g:i a', strtotime($this->created_at));
    }


    /* ========================================= Scopes ========================================= */

    /**
     * Scope a query to only include approved rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status = 'approved', $andOr = 'and')
    {
        $types = [
            'pending' => 0,
            'approved' => 1,
            'rejected' => 2,
        ];
        if ($andOr == 'and') {
            return $query->where('comments.approved', $types[$status]);
        } else if ($andOr == 'or') {
            return $query->orWhere('comments.approved', $types[$status]);
        }
    }

    /**
     * Scope a query to only include approved rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLevel($query, $level = 1)
    {
        if ($level == 1) {
            return $query->whereNull('parent_id');
        } else if ($level == 2) {
            return $query->whereHas('parent', function($q) {
                $q->whereNull('parent_id');
            });
        } else if ($level == 3) {
            return $query->whereHas('parent', function($q) {
                $q->has('parent');
            });
        }
    }

    /**
     * Scope a query to only include approved and pending rows.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApprovedAndPending($query)
    {
        if (auth()->check()) {
            $query->where(function ($q) {
                $q->status('approved');
                $q->orWhere(function ($q) {
                    $q->status('pending')->where('creator_id', auth()->id());
                });
            });
        } else if (get_comment_author()) {
            $query->where(function ($q) {
                $q->status('approved');
                $q->orWhere(function ($q) {
                    $author = get_comment_author();
                    $q->status('pending')->where('author_email', $author->author_email);
                });
            });
        } else {
            $query->status('approved');
        }
    }



}
