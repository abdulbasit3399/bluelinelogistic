<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Validator;
use App\Core\Widget\Template\Widget;

class SocialCounters extends Widget {

    /**
     * Visibility in widget list
     */
    public $publish = true; // if *true* will be show in widget list in admin page

    /**
     * widget id to save in database.
     */
    public $type = 'socialcounters'; // Example:  heading, table, paragraph, gallery, ads, list, video

    /**
     * widget id to save in database.
     */
    public $group = 'general'; // Example:  text, media

    /**
     * widget name to view in admin page.
     */
    public $name = 'Social Counters'; // Example: Heading, Table, Paragraph, Gallery, Ads, List, Video

    /**
     * widget icon to view in admin page.
     * Fontawesome 5 icons supported.
     * soild icon only
     */
    public $icon = 'share-alt'; // Example: heading, paragraph, list

    /**
     * widget description to view in admin page.
     */
    public $description = 'This widget view social counters.';


    /**
     * soical list.
     */
    public $platforms;


    public function __construct()
    {
        $this->name = [
            'en' => 'Social Counters',
            'ar' => 'Social Counters'
        ];
        // you must be define name before run parent construct
        parent::__construct();
        
        $this->platforms = [
            [
                'id'            => 'facebook',
                'name'          => 'Facebook',
                'color'         => '#3b5998',
                'count_type'    => __('view.social_counters_data.count_types.fans')
            ],
            [
                'id'            => 'instagram',
                'name'          => 'Instagram',
                'color'         => '#405de6',
                'count_type'    => __('view.social_counters_data.count_types.fans')
            ],
            [
                'id'            => 'twitter',
                'name'          => 'Twitter',
                'color'         => '#00b6f1',
                'count_type'    => __('view.social_counters_data.count_types.followers')
            ],
            [
                'id'            => 'linkedin2',
                'name'          => 'LinkedIn',
                'color'         => '#0077b5',
                'count_type'    => __('view.social_counters_data.count_types.followers')
            ],
            [
                'id'            => 'youtube',
                'name'          => 'Youtube',
                'color'         => '#ff0000',
                'count_type'    => __('view.social_counters_data.count_types.subscribers')
            ],
            [
                'id'            => 'google-plus',
                'name'          => 'Google plus',
                'color'         => '#EB4026',
                'count_type'    => __('view.social_counters_data.count_types.subscribers')
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
        if (!isset($oldData['socials']) || (isset($oldData['socials']) && !count($oldData['socials']))) {
            $oldData['socials'] = [
                [
                    'platform' => '',
                    'count' => ''
                ],
            ];
        }
        return view('widgets.socialcounters.form')->with([
            'id'        => $id,
            'oldData'   => $oldData,
            'platforms' => $this->platforms
        ]);
    }

    /**
     * View in frontend page (in sidebar).
     *
     * @return View
     */
    public function view($id, $data)
    {
        return view('widgets.socialcounters.view')->with([
            'data' => $data,
            'platforms' => $this->platforms
        ]);
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
        $this->mapData($request);
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
        $this->mapData($request);
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
            'socials.*.platform' => 'required|string|in:' . collect($this->platforms)->implode('id', ','),
            'socials.*.count' => 'required|string|max:20',
        ], [], [
            'socials.*.platform' => __('view.social_counters_data.platform'),
            'socials.*.count' => __('view.social_counters_data.count')
        ]);

        // validate data
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            return true;
        }
    }


    /**
     * Maping data
     * map data for passing to validation and store or update method 
     * @param array $request
     * @return array
     */
    public function mapData($request, $id = null)
    {
        $socials = [];
        foreach ($request as $key => $value) {
            $start_key = 'socials.';
            $start = strpos($key, $start_key) + strlen($start_key);
            $end = strrpos($key, '.') - strlen($start_key);
            $indexKey = substr($key, $start, $end);
            $nameKey = substr($key, strpos($key, $indexKey) + strlen($indexKey) + 1);
            $socials[$indexKey][$nameKey] = $value;
        }
        $socials = ['socials' => $socials];
        return $socials;
    }


}
