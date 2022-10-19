<?php

namespace Modules\Blog\Http\Controllers\Front;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentCreateRequest;
use Modules\Blog\Transformers\Front\Comment\CommentNewResource;

class CommentController extends Controller
{


    /**
     * Add new comment to post in storage.
     * @param Request $request
     * @return Comment
     */
    public function store(CommentCreateRequest $request)
    {
        $data = $request->only(['content', 'author_name', 'author_email', 'author_website', 'parent_id']);
        $post_id = $request->post_id;
        $comment_cookies = $request->comment_cookies;
        $author_data = $request->only(['author_name', 'author_email', 'author_website']);
        if ($comment_cookies) {
            setcookie('comment_cookies_author', json_encode($author_data), time() + (86400 * 30 * 12));
        } else {
            unset($_COOKIE['comment_cookies_author']); 
            setcookie('comment_cookies_author', null, -1);
        }
        $post = Post::find($post_id);
        if (!$post) {
            return response()->json(['message' => __('blog::messages.comments.not_found_post')]);
        }
        $commentCreated = $post->comments()->create($data);
        $comment = Comment::with('creator')->find($commentCreated->id);
        $comment = new CommentNewResource($comment);
        return response()->json(['comment' => $comment, 'message' => __('blog::messages.comments.created')]);
    }



    /**
     * Load more comments with ajax
     * @param Request $request
     * @return Response
     */
    public function loadMore(Request $request)
    {
        $offset = $request->comments_offset;
        $post_id = $request->post_id;

        $withComments = function($q) {
            $q->approvedAndPending()
            ->withCount('comments')
            ->latest()
            ->limit(3);
        };
        // get data
        $with = [
            'creator',
            'parent',
            'comments' => function($query) use($withComments) {
                $withSubComments = [
                    'comments' => $withComments,
                    'creator',
                    'parent',
                    'comments.creator',
                    'comments.parent',
                ];
                $query->approvedAndPending()
                ->with($withSubComments)
                ->withCount('comments')
                ->latest()
                ->limit(3);
            }
        ];

        $comments = Comment::level(1)
                            ->approvedAndPending()
                            ->latest()
                            ->with($with)
                            ->withCount('comments')
                            ->offset($offset)
                            ->limit(10)
                            ->whereHasMorph('commentable', Post::class, function($query) use ($post_id) {
                                $query->where('id', $post_id);
                            })->get();
        $comments_resource = CommentNewResource::collection($comments);
        return response()->json(['comments' => $comments_resource]);
    }



    /**
     * Load more replies for comments with ajax
     * @param Request $request
     * @return Response
     */
    public function loadMoreReplies(Request $request)
    {
        $offset = $request->comments_offset;
        $comment_id = $request->comment_id;
        $level = $request->level;

        if ($level == 2) {
            $with = [
                'creator',
                'parent',
                'comments' => function($query) {
                    $withSubComments = [
                        'creator',
                        'parent',
                    ];
                    $query->with($withSubComments)
                    ->withCount('comments')
                    ->latest()
                    ->limit(3);
                }
            ];
        } else if ($level == 3) {
            $with = [
                'creator',
                'parent'
            ];
        }
        $comments = Comment::where('parent_id', $comment_id)
                            ->latest()
                            ->with($with)
                            ->withCount('comments')
                            ->offset($offset)
                            ->limit(10)
                            ->get();
        
        $comments_resource = CommentNewResource::collection($comments);
        return response()->json(['comments' => $comments_resource]);
    }

}
