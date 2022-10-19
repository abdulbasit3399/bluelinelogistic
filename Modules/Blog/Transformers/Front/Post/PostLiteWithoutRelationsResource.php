<?php

namespace Modules\Blog\Transformers\Front\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostLiteWithoutRelationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => $this->getFirstMediaUrl('featured_image'),
            'visibility' => $this->visibility,
            'date' => date('F j, Y, g:i a', strtotime($this->publish_on ?? $this->created_at)),
            'comments_count' => $this->comments_count,
            'count_visitors' => 0,
        ];
    }
}
