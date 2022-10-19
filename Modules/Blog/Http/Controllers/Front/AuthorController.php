<?php

namespace Modules\Blog\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\Blog\Entities\Post;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;

class AuthorController extends Controller
{


  
    
    /**
     * Show tag page
     * 
     * @return View
     */
    public function show($username)
    {
        // get data
        $user = User::where('name', $username)->firstOrFail();
        $count_posts = get_settings('count_posts_tag_page', 10);
        $get_latest_posts = Post::with('creator')->where('creator_id', $user->id)->showInFront()->latest()->paginate($count_posts); 
        $get_latest_posts_resource = PostLiteResource::collection($get_latest_posts);

        return view('theme.pages.author')->with([
            'author' => $user,
            'posts' => $get_latest_posts_resource
        ]);
    }

}
