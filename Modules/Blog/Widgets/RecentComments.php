<?php

namespace Modules\Blog\Widgets;

use Illuminate\Support\Facades\Validator;
use App\Core\Widget\Template\Widget;
use Modules\Blog\Entities\Comment;

class RecentComments extends Widget {

    /**
     * Visibility in widget list
     */
    public $publish = true; // if *true* will be show in widget list in admin page

    /**
     * widget id to save in database.
     */
    public $type = 'recentcomments'; // Example:  heading, table, paragraph, gallery, ads, list, video

    /**
     * widget id to save in database.
     */
    public $group = ''; // Example:  text, media

    /**
     * widget name to view in admin page.
     */
    public $name = 'Recent Comments'; // Example: Heading, Table, Paragraph, Gallery, Ads, List, Video

    /**
     * widget icon to view in admin page.
     * Fontawesome 5 icons supported.
     * soild icon only
     */
    public $icon = 'comments'; // Example: heading, paragraph, list

    /**
     * widget description to view in admin page.
     */
    public $description = 'This widget recentcomments to show in sidebar in frontend page.';

    function __construct()
    {
        $this->name = [
            'en' => 'Recent Comments',
            'ar' => 'Recent Comments'
        ];
        // you must be define name before run parent construct
        parent::__construct();
    }

    /**
     * View form in admin page.
     *
     * @param array $oldData
     * @return View
     */
    public function form($oldData = [], $id = null)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.widgets.recentcomments.form')->with(['oldData' => $oldData]);
    }

    /**
     * View in frontend page (in sidebar).
     *
     * @return View
     */
    public function view($id, $data)
    {
        $parent_only = isset($data['parent_only']) && $data['parent_only'] == 1;
        $query_comments = Comment::status()->latest()->limit($data['comments_count'])->with(['creator', 'commentable']);
        if ($parent_only) {
            $query_comments->level(1);
        }
        $comments = $query_comments->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.widgets.recentcomments.view')->with(['data' => $data, 'comments' => $comments]);
    }



    /**
     * Maping data
     * map data for passing to validation and store or update method 
     * @param array $request
     * @return array
     */
    public function mapData($request, $id = null)
    {
        $request['parent_only'] = isset($request['parent_only']) ? 1 : 0;
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
        $validation = Validator::make($data, [
            'comments_count' => 'required|integer|max:20',
        ]);
        // validate data
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            return true;
        }
    }
    


}
