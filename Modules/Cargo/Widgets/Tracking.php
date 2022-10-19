<?php

namespace Modules\Cargo\Widgets;

use Illuminate\Support\Facades\Validator;
use App\Core\Widget\Template\Widget;
use Modules\Cargo\Entities\Shipment as ShipmentModel;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;

class Tracking extends Widget {

    /**
     * Visibility in widget list
     */
    public $publish = true; // if *true* will be show in widget list in admin page

    /**
     * widget id to save in database.
     */
    public $type = 'shipment'; // Example:  heading, table, paragraph, gallery, ads, list, video

    /**
     * widget id to save in database.
     */
    public $group = 'Cargo'; // Example:  text, media

    /**
     * widget name to view in admin page.
     */
    public $name = 'shipment'; // Example: Heading, Table, Paragraph, Gallery, Ads, List, Video

    /**
     * widget icon to view in admin page.
     * Fontawesome 5 icons supported.
     * soild icon only
     */
    public $icon = 'newspaper'; // Example: heading, paragraph, list

    /**
     * widget description to view in admin page.
     */
    public $description = 'This widget traking dynamic.';
    

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
            'en' => 'Tracking Shipment',
            'ar' => 'Tracking Shipment'
        ];

        // you must be define name before run parent construct
        parent::__construct();

        $this->viewStyles = [
            [
                'id' => 'style_1',
                'name' => __('cargo::view.widget_tracking.style_1'),
            ],
            [
                'id' => 'style_2',
                'name' => __('cargo::view.widget_tracking.style_2'),
            ],
            // [
            //     'id' => 'half_width',
            //     'name' => __('cargo::view.widget_tracking.half_width'),
            // ],
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
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.widgets.shipment.tracking-form')->with([
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
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.widgets.shipment.view-styles-tracking.' . $viewStyle)->with([
            'id' => $id,
            'data' => $data,
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
        $required = 'nullable';
        if(isset($data['display_Widget_title']) && $data['display_Widget_title'] == 1 ){
            $required = 'required';
        }

        $lang = \LaravelLocalization::getCurrentLocale();
        $validation = Validator::make($data, [
            'section_title' => $required.'|array',
            'section_title.'.$lang => $required.'|string|max:40',
        ]);

        // validate data
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            return true;
        }
    }
    


}
