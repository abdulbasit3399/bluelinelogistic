<?php

namespace Modules\Blog\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Transformers\Front\Comment\CommentNewResource;
use Modules\Blog\Transformers\Front\Post\PostResource;

class PostController extends Controller
{

    private $categoryRepo;


    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }



    /**
     * Show sinlge post
     *
     * @return View
     */
    public function show(Request $request, $slug)
    {
        $withComments = function($query) {
            $query->withCount('comments')->latest()->limit(3);
        };
        // get data
        $withPosts = [
            'creator',
            'tags',
            'comments.creator',
            'comments' => function($query) use($withComments) {
                $withSubComments = [
                    'comments' => $withComments,
                    'comments.comments' => $withComments,
                    'comments.creator',
                    'comments.comments.creator',
                ];
                $query->level(1)
                ->with($withSubComments)
                ->withCount('comments')
                ->latest()
                ->limit(10);
            }
        ];
        if (auth()->check() && auth()->user()->can('view-posts')) {
            $post = Post::where('slug', $slug)->withCount([
                'approvedComments',
                'comments' => function ($query) { $query->level(1); }
            ])->with($withPosts)->first();
        }else{
            $post = Post::where('slug', $slug)->withCount([
                'approvedComments',
                'comments' => function ($query) { $query->level(1); }
            ])->with($withPosts)->showInFront()->first();
        }
        if(!$post){
            return view('theme.pages.error')->with([
                'message' => __('blog::messages.posts.dont_have_the_permissions'),
            ]);
        }
        $post_resource = collect(new PostResource($post))->toArray();
        $comments_resource = CommentNewResource::collection($post->comments->reverse());
        $next_post = Post::where('created_at', '>', $post->created_at)->showInFront()->first();
        $prev_post = Post::where('created_at', '<', $post->created_at)->showInFront()->latest()->first();
        $category_post = $post_resource['category'];
        $category_parents = $category_post ? $this->categoryRepo->crumbParents($category_post['id']) : [];

        // get related posts
        $post_tags = $post->tags;
        $post_tag_slugs = $post_tags->map(function($tag) {
            return $tag->slug;
        })->unique()->toArray();
        $count_related = get_settings('count_related_posts', 6);
        $related_posts = Post::with('creator')->where('id', '!=', $post->id)->whereHas('tags', function($query) use($post_tag_slugs) {
            $query->whereIn('slug', $post_tag_slugs);
        })->showInFront()->latest()->limit($count_related)->get();
        $related_posts_resource = collect(PostLiteResource::collection($related_posts))->toArray();

        $locale = app()->getLocale();
        $blog_translation = File::getRequire(module_path('blog', "Resources/lang/{$locale}/front.php"));

        return view('theme.pages.post')->with([
            'post' => $post_resource,
            'comments' => $comments_resource,
            'post_tags' => $post_tags,
            'related_posts' => $related_posts_resource,
            'next_post' => $next_post,
            'prev_post' => $prev_post,
            'category_post' => $category_post,
            'category_parents' => $category_parents,
            'blog_translation' => json_encode($blog_translation),
        ]);
    }


    /**
     * Show random post
     *
     * @return View
     */

    public function showRandomPost(Request $request)
    {
        $post_random = Post::showInFront()->inRandomOrder()->first();
        if ($post_random) {
            return redirect()->route('post-page', ['slug' => $post_random->slug]);
        }
        return redirect()->back();
    }




    public function loadPosts(Request $request)
    {
        $current_count = $request->current_count;
        $options = $request->options ?? [];
        $order_by = array_key_exists('order_by', $options) ? $options['order_by'] : null;
        $limit = array_key_exists('limit', $options) ? $options['limit'] : 10;
        $related_tags = array_key_exists('related_tags', $options) && is_array($options['related_tags']) ? $options['related_tags'] : [];
        $related_categories = array_key_exists('related_categories', $options) && is_array($options['related_categories']) ? $options['related_categories'] : [];

        $posts_query = Post::showInFront()->with('creator')->withCount('comments')->offset($current_count)->limit($limit);

        // if ($category_id) {
        //     $posts_query->whereHas('categories', function ($q) use ($category_id, $categories) {
        //         if ($category_id == 'all') {
        //             $q->whereIn('id', $categories);
        //         } else {
        //             $q->where('id', $category_id);
        //         }
        //     });
        // }

        $posts_query->where(function ($query) use ($related_categories, $related_tags) {
            if (count($related_categories)) {
                $query->orWhereHas('categories', function ($q) use ($related_categories) {
                    $q->whereIn('id', $related_categories);
                });
            }
            if (count($related_tags)) {
                $query->orWhereHas('tags', function ($q) use ($related_tags) {
                    $q->whereIn('id', $related_tags);
                });
            }
        });

        // order by
        if ($order_by == 'latest') {
            $posts_query->latest();
        } else if ($order_by == 'most_commented') {
            $posts_query->orderBy('comments_count', 'desc');
        } else if ($order_by == 'random') {
            $posts_query->inRandomOrder();
        }
        $get_posts = $posts_query->get();
        $post_collection = PostLiteResource::collection($get_posts);
        return response()->json(collect($post_collection)->toArray());
    }



    /**
     * Filter on posts
     *
     * @param Request $request
     * @return View
     */
    public function filterPosts(Request $request)
    {
        $categories = $request->categories;
        $category_id = $request->category_id;
        $options = $request->options ?? [];
        $order_by = array_key_exists('order_by', $options) ? $options['order_by'] : null;
        $limit = array_key_exists('limit', $options) ? $options['limit'] : 10;
        $related_tags = array_key_exists('related_tags', $options) && is_array($options['related_tags']) ? $options['related_tags'] : [];

        $posts_query = Post::showInFront()->with('creator')->withCount('comments')->limit($limit);

        if ($category_id) {
            $posts_query->whereHas('categories', function ($q) use ($category_id, $categories) {
                if ($category_id == 'all') {
                    $q->whereIn('id', $categories);
                } else {
                    $q->where('id', $category_id);
                }
            });
        }

        $posts_query->where(function ($query) use ($related_tags) {
            if (count($related_tags)) {
                $query->orWhereHas('tags', function ($q) use ($related_tags) {
                    $q->whereIn('id', $related_tags);
                });
            }
        });

        // order by
        if ($order_by == 'latest') {
            $posts_query->latest();
        } else if ($order_by == 'most_commented') {
            $posts_query->orderBy('comments_count', 'desc');
        } else if ($order_by == 'random') {
            $posts_query->inRandomOrder();
        }
        $get_posts = $posts_query->get();
        $post_collection = PostLiteResource::collection($get_posts);
        return response()->json(collect($post_collection)->toArray());
    }





    /**
     * Blog page
     * Show all posts
     *
     * @param Request $request
     * @return View
     */
    public function showall(Request $request)
    {
        $query_posts = Post::withCount('comments')
            ->with('creator')
            ->showInFront()
            ->latest();
        $posts = $query_posts->paginate(12);
        $posts_resource = PostLiteResource::collection($posts);
        return view('theme.pages.blog')->with([
            'posts' => $posts_resource
        ]);
    }

    /**
     * Search on posts
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request)
    {
        $search = trim(strip_tags($request->input('q')));
        $search_arr = explode(' ', $search);
        if ($search) {
            $tag_ids = Tag::where(function ($q) use ($search_arr) {
                foreach ($search_arr as $search_word) {
                    $q->orWhere('name', 'like', "%{$search_word}%");
                }
            })->pluck('id')->toArray();
            $category_ids = Category::where(function ($q) use ($search_arr) {
                foreach ($search_arr as $search_word) {
                    $q->orWhere('name', 'like', "%{$search_word}%");
                }
            })->pluck('id')->toArray();
            $query_posts = Post::withCount('comments')
                ->with('creator')
                ->showInFront()
                ->latest()
                ->where(function ($q) use ($category_ids, $tag_ids, $search_arr) {
                    foreach ($search_arr as $search_word) {
                        $q->orWhere('title', 'like', "%{$search_word}%");
                    }
                    $q->orWhereHas('tags', function($qTag) use ($tag_ids) {
                        $qTag->whereIn('id', $tag_ids);
                    })
                    ->orWhereHas('categories', function($qCate) use ($category_ids) {
                        $qCate->whereIn('id', $category_ids);
                    });
                });
            $posts = $query_posts->paginate(12);
            $posts->appends(['q' => $search]);
            $posts_resource = PostLiteResource::collection($posts);
        } else {
            $posts_resource = [];
        }
        return view('theme.pages.search')->with([
            'posts' => $posts_resource,
            'search_value' => $search
        ]);
    }






}