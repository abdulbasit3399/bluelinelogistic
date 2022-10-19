<?php

namespace Modules\Blog\Transformers\Front\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentNewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $creator = $this->creator ? [
            'id' => $this->creator->id,
            'name' => $this->creator->name,
            'avatar_image' => $this->creator->getFirstMediaUrl('avatar'),
            'author_page' => fr_route('author-page', ['username' => $this->creator->name])
        ] : null;
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'creator' => $creator,
            'content' => $this->content,
            'approved' => $this->approved,
            'author_name' => $this->author_name,
            'author_email' => $this->author_email,
            'author_website' => $this->author_website,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'date' => $this->date,
            'level' => is_null($this->parent_id) ? 1 : ($this->parent && is_null($this->parent->parent_id) ? 2 : 3),
            'comments' => $this->comments && $this->comments->count() ? CommentNewResource::collection($this->comments) : [],
            'comments_count' => $this->comments_count
        ];
    }
}
