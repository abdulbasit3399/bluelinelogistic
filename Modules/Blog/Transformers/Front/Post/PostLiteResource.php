<?php

namespace Modules\Blog\Transformers\Front\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostLiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $creator = $this->creator;
        $category = $this->category;
        $timestamp = strtotime($this->publish_on ?? $this->created_at);
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'creator' => $creator ? [
                'id' => $creator->id,
                'name' => $creator->name,
                'email' => $creator->email,
                'role' => $creator->role,
                'avatar_image' => $creator->getFirstMediaUrl('avatar'),
                'author_page' => fr_route('author-page', ['username' => $creator->name])
            ] : null,
            'category' => $category ? [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'category_page' => fr_route('category-page', ['slug' => $category->slug])
            ] : null,
            // post content
            'title' => $this->title,
            'content' => $this->content,
            'content_text' => Str::limit(trim(strip_tags($this->content)), 100),
            'slug' => $this->slug,
            'image' => $this->image,
            'post_page' => fr_route('post-page', ['slug' => $this->slug]),
            'image_url' => $this->getFirstMediaUrl('featured_image'),
            // // featured image
            // 'featurable_id' => $this->featurable_id,
            // 'featurable_type' => $this->featurable_type,
            // post config
            'visibility' => $this->visibility,
            'date' => date('F j, Y, g:i a', $timestamp),
            'date_not_formated' => $this->publish_on ?? $this->created_at,
            'date_timestamp' => $timestamp,
            'date_format' => [
                'M' => date('M', $timestamp),
                'Y' => date('Y', $timestamp),
                'j' => date('j', $timestamp),
                'F' => date('F', $timestamp),
            ],
            'comments_count' => $this->comments_count,
            'count_visitors' => 0,
        ];
    }
}
