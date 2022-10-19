<?php

namespace Modules\Blog\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Repositories\CategoryRepository;

class CategoryController extends Controller
{


    private $categoryRepo;
    
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }
    
    /**
     * Show category page
     * 
     * @return View
     */
    public function show($slug)
    {
        // get data
        $category = Category::where('slug', $slug)->active()->with('creator')->firstOrFail();
        $parents = $this->categoryRepo->crumbParents($category->id);

        $count_posts = trim(get_settings('count_posts_category_page', 10), '"');
      
        $get_latest_posts = $category->posts()->withCount('comments')->with('creator')->showInFront()->latest()->paginate($count_posts); 
        $get_latest_posts_resource = PostLiteResource::collection($get_latest_posts);
        $cover_posts = count($get_latest_posts_resource) > 2 ? collect($get_latest_posts_resource)->take(3)->toArray() : [];
        
        return view('theme.pages.category')->with([
            'category' => $category,
            'posts' => $get_latest_posts_resource,
            'cover_posts' => $cover_posts,
            'categoryParents' => $parents,
        ]);
    }

}