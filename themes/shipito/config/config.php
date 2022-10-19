<?php

use Illuminate\Http\Request;
use App\Models\CustomSetting;

$dir_images = 'theme_shipito_images';
$prefix_image = 'theme___images___';

$sidebars = [
    'main_sidebar' => [
        'id' => 'main_sidebar',
        'name' => 'Main sidebar',
        'description' => 'Main sidebar description',
        'before_sidebar' => '<aside id="main_sidebar" class="sidebar-main">',
        'after_sidebar'  => '</aside>',
        'before_widget' => '<section class="my-widget">',
        'after_widget'  => '</section>'
    ]
];

$footer_setting = theme_setting('footer.footer');

if(!$footer_setting){
    $footer_setting = array();
}

if (array_key_exists('display_widgets', $footer_setting) && array_key_exists('widgets_count', $footer_setting) && $footer_setting['display_widgets']) {
    $sidebars['footer_sidebar_1'] = [
        'id' => 'footer_sidebar_1',
        'name' => 'Footer sidebar 1',
        'description' => 'Footer sidebar description',
        'before_sidebar' => '<aside id="footer_sidebar_1" class="sidebar-footer">',
        'after_sidebar'  => '</aside>',
        'before_widget' => '<section class="my-widget">',
        'after_widget'  => '</section>'
    ];

    if($footer_setting['widgets_count'] > 1) {
        $sidebars['footer_sidebar_2'] = [
            'id' => 'footer_sidebar_2',
            'name' => 'Footer sidebar 2',
            'description' => 'Footer sidebar description',
            'before_sidebar' => '<aside id="footer_sidebar_2" class="sidebar-footer">',
            'after_sidebar'  => '</aside>',
            'before_widget' => '<section class="my-widget">',
            'after_widget'  => '</section>'
        ];
    }

    if($footer_setting['widgets_count'] > 2) {
        $sidebars['footer_sidebar_3'] = [
            'id' => 'footer_sidebar_3',
            'name' => 'Footer sidebar 3',
            'description' => 'Footer sidebar description',
            'before_sidebar' => '<aside id="footer_sidebar_3" class="sidebar-footer">',
            'after_sidebar'  => '</aside>',
            'before_widget' => '<section class="my-widget">',
            'after_widget'  => '</section>'
        ];
    }
    if($footer_setting['widgets_count'] > 3) {
        $sidebars['footer_sidebar_4'] = [
            'id' => 'footer_sidebar_4',
            'name' => 'Footer sidebar 4',
            'description' => 'Footer sidebar description',
            'before_sidebar' => '<aside id="footer_sidebar_4" class="sidebar-footer">',
            'after_sidebar'  => '</aside>',
            'before_widget' => '<section class="my-widget">',
            'after_widget'  => '</section>'
        ];
    }
}

return [

    'dir_images' => $dir_images,
    'prefix_image' => $prefix_image,

    'menu_places' => [
        'header',
        'footer',
    ],

    'container_width' => [
        'full_width' => __('theme_shipito::view.full_width'),
        'half_width' => __('theme_flextock::view.half_width'),
        'two_thirds' => __('theme_shipito::view.two_thirds'),
        'one_third' => __('theme_shipito::view.one_third'),
    ],

    'sidebars' => $sidebars,

    'posts_order' => [
        'latest' => __('theme_shipito::view.latest'),
        'most_commented' => __('theme_shipito::view.most_commented'),
        'random' => __('theme_shipito::view.random'),
    ],

    'image_place' => [
        'start' => __('theme_shipito::view.start'),
        'end' => __('theme_shipito::view.end'),
    ],

    'ad_types' => [
        'html' => __('theme_shipito::view.html'),
        'image' => __('theme_shipito::view.image'),
        'category' => __('theme_shipito::view.category'),
        'post' => __('theme_shipito::view.post'),
        'tag' => __('theme_shipito::view.tag'),
    ],


    'theme_setting' => [
        'homepage' => [ // tab
            'name' => __('theme_shipito::view.theme_settings.homepage'),
            'sortable' => true,
            'sections' => [
                'slides' => [
                    'name' => __('theme_shipito::view.slides'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'contact-us' => [
                    'name' => __('theme_shipito::view.contact-us'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'top-steps' => [
                    'name' => __('theme_shipito::view.top-steps'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'help' => [
                    'name' => __('theme_shipito::view.help'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],


                'Join_us' => [
                    'name' => __('theme_shipito::view.Join_us'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'how_works' => [
                    'name' => __('theme_shipito::view.how_works'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'shipping_steps' => [
                    'name' => __('theme_shipito::view.shipping_steps'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],


                'promotions' => [
                    'name' => __('theme_shipito::view.promotions'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'popular_items' => [
                    'name' => __('theme_shipito::view.popular_items'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'evaluation' => [
                    'name' => __('theme_shipito::view.evaluation'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

                'features' => [
                    'name' => __('theme_shipito::view.features'),
                    'validation' => [
                        'rules' => [],
                        'messages' => [],
                        'attributes' => [],
                    ],
                    'map_before_validation' => function ($request, $id) {
                        $request['display'] = array_key_exists('display', $request) ? true : false;
                        return $request;
                    },
                ],

            ]
        ],
            //  End homepage
        'header' => [ // tab
            'name' => __('theme_shipito::view.theme_settings.header'),
            'sortable' => false,
            'sections' => [
                'header' => [
                    'validation' => [
                        'rules' => [
                        ]
                    ],
                    'map_after_validation' => function ($request, $id) use($dir_images, $prefix_image){
                        $laravelRequest = new Request($request);
                        $oldData = $id ? CustomSetting::find($id) : null;
                        if ($oldData !== null) {
                            $oldData = $oldData->dataMaped;
                            if (array_key_exists('header_logo', $oldData)) {
                                $oldData['header_logo'] = isset($oldData['header_logo_name']) ? $oldData['header_logo_name'] : $oldData['header_logo'];
                            }
                            if (array_key_exists('ad_image', $oldData)) {
                                $oldData['ad_image'] = isset($oldData['ad_image_name']) ? $oldData['ad_image_name'] : $oldData['ad_image'];
                            }
                            if (array_key_exists('menu_sticky_logo', $oldData)) {
                                $oldData['menu_sticky_logo'] = isset($oldData['menu_sticky_logo_name']) ? $oldData['menu_sticky_logo_name'] : $oldData['menu_sticky_logo'];
                            }
                        }
                        $header_logo_name = uploader($laravelRequest)->path($dir_images)->fieldName('header_logo')->model($oldData)->singleUpload();
                        $request['header_logo'] = $header_logo_name ? $prefix_image . $header_logo_name : null;


                        // menu
                        $request['display_home_icon'] = array_key_exists('display_home_icon', $request) ? true : false;
                        $request['display_sign_in'] = array_key_exists('display_sign_in', $request) ? true : false;
                        $request['display_tracking_search'] = array_key_exists('display_tracking_search', $request) ? true : false;

                        return $request;
                    },
                ]
            ]
        ],

        'footer' => [ // tab
            'name' => __('theme_shipito::view.theme_settings.footer'),
            'sections' => [
                'footer' => [
                    'validation' => [
                        'rules' => [
                            'footer_paragraph' => 'nullable|string|max:400',
                            'copyright' => 'nullable|string|max:200',
                        ]
                    ],
                    'map_after_validation' => function ($request, $id)  use($dir_images, $prefix_image){
                        $laravelRequest = new Request($request);
                        $oldData = $id ? CustomSetting::find($id) : null;
                        if ($oldData !== null) {
                            $oldData = $oldData->dataMaped;
                            if (array_key_exists('footer_logo', $oldData)) {
                                $oldData['footer_logo'] = isset($oldData['footer_logo_name']) ? $oldData['footer_logo_name'] : $oldData['footer_logo'];
                            }
                        }
                        $footer_logo_name = uploader($laravelRequest)->path($dir_images)->fieldName('footer_logo')->model($oldData)->singleUpload();
                        $request['footer_logo'] = $footer_logo_name ? $prefix_image.$footer_logo_name : null;

                        $request['display_footer'] = array_key_exists('display_footer', $request) ? true : false;
                        $request['display_widgets'] = array_key_exists('display_widgets', $request) ? true : false;
                        $request['display_footer_top_area'] = array_key_exists('display_footer_top_area', $request) ? true : false;
                        $request['display_copyright'] = array_key_exists('display_copyright', $request) ? true : false;
                        $request['display_footer_logo'] = array_key_exists('display_footer_logo', $request) ? true : false;
                        $request['display_footer_paragraph'] = array_key_exists('display_footer_paragraph', $request) ? true : false;
                        $request['display_social'] = array_key_exists('display_social', $request) ? true : false;
                        $request['display_footer_links'] = array_key_exists('display_footer_links', $request) ? true : false;
                        return $request;
                    },
                ]
            ]
        ],

        'styling' => [ // tab
            'name' => __('theme_shipito::view.theme_settings.styling'),
            'sections' => [
                'styling' => [
                    'validation' => [
                        'rules' => [
                            'footer_paragraph' => 'nullable|string|max:400',
                            'copyright' => 'nullable|string|max:200',
                        ]
                    ],
                    'map_after_validation' => function ($request, $id) use($dir_images, $prefix_image) {
                        $laravelRequest = new Request($request);
                        $oldData = $id ? CustomSetting::find($id) : null;
                        if ($oldData !== null) {
                            $oldData = $oldData->dataMaped;
                            if (array_key_exists('footer_logo', $oldData)) {
                                $oldData['footer_logo'] = isset($oldData['footer_logo_name']) ? $oldData['footer_logo_name'] : $oldData['footer_logo'];
                            }
                        }
                        $footer_logo_name = uploader($laravelRequest)->path($dir_images)->fieldName('footer_logo')->model($oldData)->singleUpload();
                        $request['footer_logo'] = $footer_logo_name ? $prefix_image.$footer_logo_name : null;

                        $request['display_footer'] = array_key_exists('display_footer', $request) ? true : false;
                        $request['display_widgets'] = array_key_exists('display_widgets', $request) ? true : false;
                        $request['display_footer_top_area'] = array_key_exists('display_footer_top_area', $request) ? true : false;
                        $request['display_copyright'] = array_key_exists('display_copyright', $request) ? true : false;
                        $request['display_footer_logo'] = array_key_exists('display_footer_logo', $request) ? true : false;
                        $request['display_footer_paragraph'] = array_key_exists('display_footer_paragraph', $request) ? true : false;
                        $request['display_social'] = array_key_exists('display_social', $request) ? true : false;
                        $request['display_footer_links'] = array_key_exists('display_footer_links', $request) ? true : false;
                        return $request;
                    },
                ]
            ]
        ],

        // 'demos' => [ // tab
        //     'name' => __('theme_shipito::view.theme_settings.demos'),
        //     'sections' => [
        //         'demos' => [
        //             'validation' => [
        //                 'rules' => [
        //                     'active_demo' => 'nullable',
        //                 ]
        //             ],
        //             'map_after_validation' => function ($request, $id) {
        //                 return $request;
        //             },
        //         ]
        //     ]
        // ],

        'additional_css' => [ // tab
            'name' => __('theme_shipito::view.theme_settings.additional_css'),
            'sections' => [
                'additional_css' => [
                    'validation' => [
                        'rules' => [
                            'additional_css' => 'nullable',
                        ]
                    ],
                    'map_after_validation' => function ($request, $id) {
                        return $request;
                    },
                ]
            ]
        ],
        'import_demo' => [ // tab
            'name' => __('theme_qwintry::view.theme_settings.import_demo'),
            'sections' => [
                'import_demo' => [
                    'validation' => [
                        'rules' => [
                        ]
                    ],
                    'map_after_validation' => function ($request, $id) {
                        return $request;
                    },
                ]
            ]
        ],
    ],

];