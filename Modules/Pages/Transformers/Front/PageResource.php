<?php

namespace Modules\Pages\Transformers\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            // post content
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_url' => $this->getFirstMediaUrl('featured_image'),
            'content' => $this->content,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            // // featured image
            // 'featurable_id' => $this->featurable_id,
            // 'featurable_type' => $this->featurable_type,
            // post config
            'visibility' => $this->visibility,
            'date' => date('F j, Y, g:i a', strtotime($this->publish_on ?? $this->created_at)),
            'count_visitors' => 0,
        ];
    }
}
