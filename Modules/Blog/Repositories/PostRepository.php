<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Post;
use Modules\Blog\Transformers\Front\Post\PostLiteResource;
use Modules\Blog\Transformers\Front\Post\PostLiteWithoutRelationsResource;

class PostRepository {


    public function getPosts($orderBy = 'latest', $limit = 10, array $with = [])
    {
        $get_latest_posts = Post::showInFront()->withCount('comments')->limit($limit);
        if (count($with)) {
            $get_latest_posts->with($with);
        }
        if ($orderBy == 'latest') {
            $get_latest_posts->latest();
        } else if ($orderBy == 'most_commented') {
            $get_latest_posts->orderBy('comments_count', 'desc');
        } else if ($orderBy == 'random') {
            $get_latest_posts->inRandomOrder();
        } else {
            $get_latest_posts->latest();
        }
        $get_latest_posts = $get_latest_posts->get();
        if (count($with)) {
            $post_collection = PostLiteResource::collection($get_latest_posts);
        } else {
            $post_collection = PostLiteWithoutRelationsResource::collection($get_latest_posts);
        }
        return collect($post_collection)->toArray();
    }

    /**
     * 
     * $options [
     *  limit @int
     *  related_categories -> ids @array
     *  related_tags -> ids @array
     *  category -> id @int
     *  tag -> id @int
     *  order_by -> @string 'latest' | 'most_commented' | 'random'
     * ]
     * 
     * @return PostLiteResource
     */

    public function getSectionPosts($options = [])
    {
        $limit = array_key_exists('limit', $options) ? $options['limit'] : 10;
        $related_categories = array_key_exists('related_categories', $options) && is_array($options['related_categories']) ? $options['related_categories'] : [];
        $related_tags = array_key_exists('related_tags', $options) && is_array($options['related_tags']) ? $options['related_tags'] : [];
        $category = array_key_exists('category', $options) ? $options['category'] : null;
        $tag = array_key_exists('tag', $options) ? $options['tag'] : null;
        $order_by = array_key_exists('order_by', $options) ? $options['order_by'] : null;
        $posts_query = Post::showInFront()->with('creator')->withCount('comments')->limit($limit);
        
        $posts_query->where(function ($query) use ($related_categories, $related_tags, $category, $tag) {
            if ($category) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('id', $category);
                });
            }
            if ($tag) {
                $query->whereHas('tags', function ($q) use ($tag) {
                    $q->where('id', $tag);
                });
            }

            if (count($related_categories)) {
                $query->orWhereHas('categories', function ($q) use ($related_categories) {
                    $q->whereIn('id', $related_categories);
                });
            }
            if (count($related_tags)) {
                $query->orWhereHas('tags', function ($q) use ($related_tags) {
                    $q->whereIn('id', $related_tags);
                });
            }
        });
        // order by
        if ($order_by == 'latest') {
            $posts_query->latest();
        } else if ($order_by == 'most_commented') {
            $posts_query->orderBy('comments_count', 'desc');
        } else if ($order_by == 'random') {
            $posts_query->inRandomOrder();
        }
        $get_posts = $posts_query->get();
        $post_collection = PostLiteResource::collection($get_posts);
        return collect($post_collection)->toArray();
    }


}