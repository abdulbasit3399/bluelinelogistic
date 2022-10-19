<?php

return [
    'name' => 'Blog',



    'permissions' => [
        'blog' => [
            'manage-blog',
        ],

        'posts' => [
            'view-posts',
            'view-single-posts',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'export-table-posts',
        ],


        'categories' => [
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'export-table-categories',
        ],

        'tags' => [
            'view-tags',
            'create-tags',
            'edit-tags',
            'delete-tags',
            'export-table-tags',
        ],

        'comments' => [
            'view-comments',
            'edit-comments',
            'delete-comments',
            'approval-comments',
            'export-table-comments',
        ],
    ],





    'module_setting' => [
        

        'blog_setting' => [
            'active' => true, // true = seed setting in database, false = not seed and not delete in database if exists in database.
            'name' => [
                'en' => 'Blog setting',
                'ar' => 'إعدادات المدونة'
            ],
            'fields' => [

                // post setting
                'count_related_posts' => [
                    'name' => [
                        'en' => 'Count related posts in post page'
                    ],
                    'type' => 'text',
                    'value' => '6',
                    'validation' => 'required|numeric|min:1'
                ],

                'count_posts_category_page' => [
                    'name' => [
                        'en' => 'Count posts in category page'
                    ],
                    'type' => 'text',
                    'value' => '10',
                    'validation' => 'required|numeric|min:1'
                ],

                'count_posts_tag_page' => [
                    'name' => [
                        'en' => 'Count posts in tag page'
                    ],
                    'type' => 'text',
                    'value' => '10',
                    'validation' => 'required|numeric|min:1'
                ],

                'count_posts_author_page' => [
                    'name' => [
                        'en' => 'Count posts in author page'
                    ],
                    'type' => 'text',
                    'value' => '10',
                    'validation' => 'required|numeric|min:1'
                ],


                // comment setting
                'auto_comments_approval' => [
                    'name' => [
                        'en' => 'Auto comments approval'
                    ],
                    'type' => 'boolean',
                    'value' => true
                ],
            ]
        ],
    
    ],


    'comments_approval_types' => [
        0 => 'pending',
        1 => 'approved',
        2 => 'rejected',
    ],
];
