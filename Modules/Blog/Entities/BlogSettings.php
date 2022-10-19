<?php

namespace Modules\Blog\Entities;

use Spatie\LaravelSettings\Settings;

class BlogSettings extends Settings
{

    public $count_related_posts;
    public $count_posts_category_page;
    public $count_posts_tag_page;
    public $count_posts_author_page;
    public $auto_comments_approval;

    public static function fields(): array
    {
        $settings = app(BlogSettings::class);

        $fields = [

            // post setting
            'count_related_posts'     =>   [
                'label'         =>  'blog::settings.count_related_posts',
                'translatable'  =>  false,
                'type'          =>  'number',
                'default'       =>  '10',
                'value'         =>  $settings->count_related_posts,
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            'count_posts_category_page'     =>   [
                'label'         =>  'blog::settings.count_posts_category_page',
                'translatable'  =>  false,
                'type'          =>  'number',
                'default'       =>  '10',
                'value'         =>  $settings->count_posts_category_page,
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            'count_posts_tag_page'     =>   [
                'label'         =>  'blog::settings.count_posts_tag_page',
                'translatable'  =>  false,
                'type'          =>  'number',
                'default'       =>  '10',
                'value'         =>  $settings->count_posts_tag_page,
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            'count_posts_author_page'     =>   [
                'label'         =>  'blog::settings.count_posts_author_page',
                'translatable'  =>  false,
                'type'          =>  'number',
                'default'       =>  '10',
                'value'         =>  $settings->count_posts_author_page,
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            // comment setting
            'auto_comments_approval'     =>   [
                'label'         =>  'blog::settings.auto_comments_approval',
                'translatable'  =>  false,
                'default'       =>  true,
                'value'         =>  $settings->auto_comments_approval,
                'type'          =>  'bool',
                'required'      =>  false
            ],
        ];

        return $fields;
    }
    
    public static function group(): string
    {
        return 'blog';
    }
    
    public static function encrypted(): array
    {
        return [
            
        ];
    }
}
