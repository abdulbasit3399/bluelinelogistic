<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Settings;
// use Modules\Blog\Entities\Category;
// use Modules\Blog\Entities\Post;
// use Modules\Blog\Transformers\Front\Post\PostLiteResource;
use Qirolab\Theme\Theme;
use Session;

class HomeController extends Controller
{
    
    /**
     * Show home page
     * 
     * @return View
     */
    public function index(Request $request)
    {
        return redirect()->away('https://bluelinelogistic.net/');
        $current_version = \app\Models\Settings::where('name','current_version')->first();
        if(!$current_version){
            // Run sql modifications
            $sql_current_version_path = base_path('database/set_current_version.sql');
            if (file_exists($sql_current_version_path)) {
                DB::unprepared(file_get_contents($sql_current_version_path));
            }
            DB::commit();
        }
        
        if(env('DEMO_MODE') == 'On'){
            $theme  = $request->theme;
            $themes = ['easyship','flextock','goshippo','qwintry','shipito','timeglobalshipping'];
            if($theme != null && in_array($theme, $themes)){
                Session::put('demo_theme', $theme);
                Theme::set($theme);
            }
        }
        $data = [];
        // get data

        // // breaking_news
        // if (get_setting('home_page_setting.display_breaking_news')) {
        //     $data['breaking_news'] = Post::select('slug', 'title')->showInFront()->latest()->limit(10)->get();
        // }
        // /******************************************************************************/

        // // wide_posts_cover
        // if (get_setting('home_page_setting.display_wide_posts_cover')) {
        //     $wide_posts_cover =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit(4)->get();
        //     if ($wide_posts_cover->count() == 4) {
        //         $data['wide_posts_cover'] = collect(PostLiteResource::collection($wide_posts_cover))->toArray();
        //     }
        // }
        // /******************************************************************************/

        // // editors_pick
        // if (get_setting('home_page_setting.display_editors_pick')) {
        //     // $editors_pick_posts =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit(4)->get();
        //     // if ($editors_pick_posts->count() == 4) {
        //     //     $data['editors_pick_posts'] = collect(PostLiteResource::collection($editors_pick_posts))->toArray();
        //     // }
        //     $data['editors_pick_posts'] = 'test';
        // }
        // /******************************************************************************/

        // // category_posts_style_1
        // if (get_setting('home_page_setting.display_category_posts_style_1')) {
        //     $first_category_slug = get_setting('home_page_setting.first_category_style_1');
        //     $second_category_slug = get_setting('home_page_setting.second_category_style_1');
        //     $posts_count = get_setting('home_page_setting.posts_count_in_every_category_style_1');
        //     $first_category = Category::where('slug', $first_category_slug)->with(['posts' => function ($query) use ($posts_count) {
        //         $query->showInFront()->withCount('comments')->latest()->limit($posts_count);
        //     }])->active()->first();
        //     $second_category = Category::where('slug', $second_category_slug)->with(['posts' => function ($query) use ($posts_count) {
        //         $query->showInFront()->withCount('comments')->latest()->limit($posts_count);
        //     }])->active()->first();
        //     if ($first_category && $first_category->posts->count()) {
        //         $data['first_category_style_1'] = $first_category;
        //         $data['first_category_posts_style_1'] = collect(PostLiteResource::collection($first_category->posts))->toArray();
        //     }
        //     if ($second_category && $second_category->posts->count()) {
        //         $data['second_category_style_1'] = $second_category;
        //         $data['second_category_posts_style_1'] = collect(PostLiteResource::collection($second_category->posts))->toArray();
        //     }
        // }
        // /******************************************************************************/

        // // dark_background_posts
        // if (get_setting('home_page_setting.display_dark_background_posts')) {
        //     // $dark_background_posts_posts =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit(4)->get();
        //     // if ($dark_background_posts_posts->count() == 4) {
        //     //     $data['dark_background_posts_posts'] = collect(PostLiteResource::collection($dark_background_posts_posts))->toArray();
        //     // }
        //     $data['dark_background_posts_posts'] = 'test';
        // }
        // /******************************************************************************/

        // // most_popular_posts
        // if (get_setting('home_page_setting.display_most_popular_posts')) {
        //     $posts_count_most_popular = get_setting('home_page_setting.posts_count_most_popular');
        //     $most_popular_posts =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit($posts_count_most_popular)->get();
        //     if ($most_popular_posts->count()) {
        //         $data['most_popular_posts'] = collect(PostLiteResource::collection($most_popular_posts))->toArray();
        //     }
        // }
        // /******************************************************************************/

        // // category_posts_style_2
        // if (get_setting('home_page_setting.display_category_posts_style_2')) {
        //     // $category_posts_style_2 =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit($posts_count_most_popular)->get();
        //     // if ($category_posts_style_2->count()) {
        //     //     $data['category_posts_style_2'] = collect(PostLiteResource::collection($category_posts_style_2))->toArray();
        //     // }
        //     $data['category_posts_style_2'] = 'test';
        // }
        // /******************************************************************************/

        // // category_posts_style_3
        // if (get_setting('home_page_setting.display_category_posts_style_3')) {
        //     // $category_posts_style_3 =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit($posts_count_most_popular)->get();
        //     // if ($category_posts_style_3->count()) {
        //     //     $data['category_posts_style_3'] = collect(PostLiteResource::collection($category_posts_style_3))->toArray();
        //     // }
        //     $data['category_posts_style_3'] = 'test';
        // }
        // /******************************************************************************/

        // // three_posts_cover
        // if (get_setting('home_page_setting.display_three_posts_cover')) {
        //     $three_posts_cover =  Post::showInFront()->inRandomOrder()->limit(3)->get();
        //     if ($three_posts_cover->count() == 3) {
        //         $data['three_posts_cover'] = collect(PostLiteResource::collection($three_posts_cover))->toArray();
        //     }
        // }
        // /******************************************************************************/

        // // latest_articles
        // if (get_setting('home_page_setting.display_latest_articles')) {
        //     $latest_articles =  Post::showInFront()->withCount('comments')->latest()->limit(4)->get();
        //     if ($latest_articles->count()) {
        //         $data['latest_articles'] = collect(PostLiteResource::collection($latest_articles))->toArray();
        //     }
        // }
        // /******************************************************************************/

        // // trending_reviews
        // if (get_setting('home_page_setting.display_trending_reviews')) {
        //     $trending_reviews_posts =  Post::showInFront()->withCount('comments')->orderBy('comments_count', 'desc')->limit(5)->get();
        //     if ($trending_reviews_posts->count()) {
        //         $data['trending_reviews_posts'] = collect(PostLiteResource::collection($trending_reviews_posts))->toArray();
        //     }
        // }
        // /******************************************************************************/
        return view('theme.index')->with($data);
    }

}
