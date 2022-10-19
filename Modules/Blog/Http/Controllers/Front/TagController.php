<?php

namespace Modules\Blog\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Tag;

class TagController extends Controller
{


  
    
    /**
     * Show tag page
     * 
     * @return View
     */
    public function show($slug)
    {
        // get data
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $count_posts = get_settings('count_posts_tag_page', 10);
        $get_latest_posts = $tag->posts()->withCount('comments')->with('creator')->showInFront()->latest()->paginate($count_posts); 
        $get_latest_posts_resource = PostLiteResource::collection($get_latest_posts);

        return view('theme.pages.tag')->with([
            'tag' => $tag,
            'posts' => $get_latest_posts_resource
        ]);
    }

}
