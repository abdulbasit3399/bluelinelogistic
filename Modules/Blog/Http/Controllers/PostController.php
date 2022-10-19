<?php

namespace Modules\Blog\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Blog\Events\PostCreatedEvent;
use Modules\Blog\Events\PostUpdatedEvent;

use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\PostRequest;
use Modules\Blog\Http\DataTables\PostsDataTable;

use Modules\Blog\Repositories\TagRepository;
use Modules\Blog\Transformers\PostSelectResource;

class PostController extends Controller
{

    /**
     * Helpers of tag model.
     * @return TagRepository
     */
    public $tagRepo;


    public function __construct(TagRepository $tagRepo)
    {

        $this->tagRepo = $tagRepo;

        // check on permissions
        $this->middleware('can:manage-blog');
        $this->middleware('can:view-posts')->only('index');
        $this->middleware('can:create-posts')->only('create', 'store');
        $this->middleware('can:edit-posts')->only('edit', 'update');
        $this->middleware('can:delete-posts')->only('delete', 'multiDestroy');
    }


    /**
     * Display a listing of the resource.
     * @return PostsDataTable
     */
    public function index(PostsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.posts'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(PostsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('blog::'.$adminTheme.'.pages.posts.index', $share_data);
    }


     /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.posts'),
                'path' => fr_route('posts.index')
            ],
            [
                'name' => __('blog::view.create_new_post')
            ]
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('blog::'.$adminTheme.'.pages.posts.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $data = $request->only(['title', 'slug', 'content', 'visibility', 'seo_title', 'seo_description']);
        $data['published'] = $request->publish ? true : false;
        if (!is_null($request->publish_on) && $request->publish_on != '') {
            $data['publish_on'] = $request->publish_on;
        }
        
        $post = Post::create($data);
        $post->addFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');

        $categories = $request->categories;
        $tags = $request->tags;
        if ($tags && is_array($tags) && count($tags)) {
            $tagIds = $this->tagRepo->addNewTags($tags);
            $post->tags()->attach($tagIds);
        }
        if ($categories && is_array($categories) && count($categories)) {
            $post->categories()->attach($categories);
        }
        event(new PostCreatedEvent($post));
        return redirect()->route('posts.index')->with(['message_alert' => __('blog::messages.posts.created')]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.posts'),
                'path' => fr_route('posts.index')
            ],
            [
                'name' => __('blog::view.edit_post')
            ]
        ]);
        $post = Post::with(['tags', 'categories'])->findOrFail($id);
        
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.posts.edit')->with(['model' => $post]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Post
     */
    public function update(PostRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $post = Post::findOrFail($id);
        $data = $request->only(['title', 'slug', 'content', 'visibility', 'published', 'seo_title', 'seo_description']);
        
        $data['published'] = $request->publish ? true : ($request->published ? true : false);
        $data['active'] = $request->active ? true : false;

        $post->syncFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');
        
        if (!is_null($request->publish_on) && $request->publish_on != '') {
            $data['publish_on'] = $request->publish_on;
        }

        $categories = $request->categories;
        $tags = $request->tags;
        if ($tags && is_array($tags) && count($tags)) {
            $tagIds = $this->tagRepo->addNewTags($tags);
            $post->tags()->sync($tagIds);
        }
        if ($categories && is_array($categories) && count($categories)) {
            $post->categories()->sync($categories);
        }

        $post->update($data);
        event(new PostUpdatedEvent($post));
        return redirect()->route('posts.index')->with(['message_alert' => __('blog::messages.posts.saved')]);
    }

    /**
     * Remove one user from database.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        Post::destroy($id);
        return response()->json(['message' => __('blog::messages.posts.deleted')]);
    }




    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Response
     */
    public function multiDestroy(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = $request->ids;
        Post::destroy($ids);
        return response()->json(['message' => __('blog::messages.posts.multi_deleted')]);
    }


    /**
     * Search on posts
     * @param Request $request
     * @return array
     */
    public function searchPosts(Request $request)
    {
        $search = $request->search;
        $query = Post::select('id', 'title')->orderByDesc('id');
        if ($search && $search != '') {
            $query->where('title->' . app()->getLocale(), 'LIKE', "%$search%");
        }
        $posts = $query->limit(30)->get();
        $postsResource = PostSelectResource::collection($posts);
        return response()->json(['posts' => $postsResource]);
    }

    
}
