<?php

namespace Modules\Blog\Transformers\Front\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'creator' => $creator ? [
                'id' => $creator->id,
                'name' => $creator->name,
                'email' => $creator->email,
                'role' => $creator->role,
                'avatar_image' => $creator->getFirstMediaUrl('avatar'),
            ] : null,
            'category' => $category ? [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ] : null,
            // post content
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'content' => $this->content,
            'image_url' => $this->getFirstMediaUrl('featured_image'),
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            // // featured image
            // 'featurable_id' => $this->featurable_id,
            // 'featurable_type' => $this->featurable_type,
            // post config
            'visibility' => $this->visibility,
            'date' => date('F j, Y, g:i a', strtotime($this->publish_on ?? $this->created_at)),
            'comments_count' => $this->comments_count,
            'approved_comments_count' => $this->approved_comments_count,
            'count_visitors' => 0,
        ];
    }
}
