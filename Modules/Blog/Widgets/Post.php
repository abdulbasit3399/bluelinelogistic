<?php

namespace Modules\Blog\Widgets;

use Illuminate\Support\Facades\Validator;
use App\Core\Widget\Template\Widget;
use Modules\Blog\Entities\Post as PostModel;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;

class Post extends Widget {

    /**
     * Visibility in widget list
     */
    public $publish = true; // if *true* will be show in widget list in admin page

    /**
     * widget id to save in database.
     */
    public $type = 'post'; // Example:  heading, table, paragraph, gallery, ads, list, video

    /**
     * widget id to save in database.
     */
    public $group = 'blog'; // Example:  text, media

    /**
     * widget name to view in admin page.
     */
    public $name = 'Post'; // Example: Heading, Table, Paragraph, Gallery, Ads, List, Video

    /**
     * widget icon to view in admin page.
     * Fontawesome 5 icons supported.
     * soild icon only
     */
    public $icon = 'newspaper'; // Example: heading, paragraph, list

    /**
     * widget description to view in admin page.
     */
    public $description = 'This widget post dynamic.';
    

    /**
     * Styles for view in front
     * @var array
     */
    public $viewStyles;

    /**
     * Filter post by order
     * @var array
     */
    public $postOrderTypes;

    public function __construct()
    {   
        $this->name = [
            'en' => 'Posts Section',
            'ar' => 'Posts Section'
        ];

        // you must be define name before run parent construct
        parent::__construct();
        
        $this->viewStyles = [
            [
                'id' => 'one_block_and_more_side',
                'name' => __('blog::view.widget_post.one_block_and_more_side'),
            ],
            [
                'id' => 'side_image_blocks',
                'name' => __('blog::view.widget_post.side_image_blocks'),
            ],
            [
                'id' => 'timeline_post_list',
                'name' => __('blog::view.widget_post.timeline_post_list'),
            ],
            [
                'id' => 'half_width_blocks',
                'name' => __('blog::view.widget_post.half_width_blocks'),
            ],
        ];
        
        $this->postOrderTypes = [
            [
                'id' => 'latest',
                'name' => __('blog::view.widget_post.order_post_types.latest'),
            ],
            [
                'id' => 'most_commented',
                'name' => __('blog::view.widget_post.order_post_types.most_commented'),
            ],
            [
                'id' => 'random',
                'name' => __('blog::view.widget_post.order_post_types.random'),
            ],
        ];
    }


    /**
     * View form in admin page.
     *
     * @param array $oldData
     * @return View
     */
    public function form($oldData = [], $id = null)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.widgets.post.form')->with([
            'id'                => $id,
            'oldData'           => $oldData,
            'viewStyles'        => $this->viewStyles,
            'postOrderTypes'    => $this->postOrderTypes,
        ]);
    }

    /**
     * View in frontend page (in sidebar).
     *
     * @return View
     */
    public function view($id, $data)
    {
        $viewStyle = $data['view_style'];
        $query_posts = PostModel::showInFront()->withCount('comments')->with('creator')->limit($data['posts_count']);
        if ($data['posts_order'] == 'most_commented') {
            $query_posts->orderBy('comments_count', 'desc');
        } else if ($data['posts_order'] == 'random') {
            $query_posts->inRandomOrder();
        } else if ($data['posts_order'] == 'latest') {
            $query_posts->orderBy('publish_on', 'desc');
        } else {
            $query_posts->orderBy('publish_on', 'desc');
        }
        $posts = $query_posts->get();
        $collection_posts = collect(PostLiteResource::collection($posts))->toArray();

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.widgets.post.view-styles.' . $viewStyle)->with([
            'id' => $id,
            'data' => $data,
            'posts' => $collection_posts,
        ]);
    }



    /**
     * Maping data
     * map data for passing to validation and store or update method 
     * @param array $request
     * @return array
     */
    public function mapData($request, $id = null)
    {
        $request['display_rating'] = isset($request['display_rating']) ? 1 : 0;
        $request['display_category'] = isset($request['display_category']) ? 1 : 0;
        $request['display_load_posts_button'] = isset($request['display_load_posts_button']) ? 1 : 0;

        return $request;
    }

    /**
     * Handle creating data
     * 
     * Run this method when clicked on save when create new widget
     * here handle and map your data to save in database
     * examples: 
     * upload image.
     *
     * @param collection $widget -> old object data from database 
     * @param array $request -> form data
     * @return array
     */
    public function store($request)
    {
        return $request;
    }

    /**
     * Handle update data
     * 
     * Run this method when clicked on save
     * here handle and map your data to save in database
     * examples: 
     * upload image.
     * @param collection $widget -> old object data from database 
     * @param array $request -> form data
     * @return array
     */
    public function update($widget, $request)
    {
        return $request;
    }

    /**
     * Validation data (Run automatically)
     * 
     * Remove it if you need not apply validations
     * Use it when you need make validation in your data form
     * @param array $data
     * @return array|boolean
     */
    public function validation($data, $id = null)
    {
        $lang = \LaravelLocalization::getCurrentLocale();
        $validation = Validator::make($data, [
            'section_title'                 => 'required|array',
            'section_title.'.$lang          => 'required|string|max:40',
            'view_style'                    => 'required|string|in:' . collect($this->viewStyles)->implode('id', ','),
            'posts_order'                   => 'required|string|in:' . collect($this->postOrderTypes)->implode('id', ','),
            'posts_count'                   => 'required|integer|max:10',
            'display_rating'                => 'nullable|boolean',
            'display_category'              => 'nullable|boolean',
            'display_load_posts_button'     => 'nullable|boolean',
        ]);

        // validate data
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            return true;
        }
    }
    


}
