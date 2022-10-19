<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Tag;

/**
 * Heplers for Category model
 */
class TagRepository {


    /**
     * save tags and return only ids.
     * @param array $tags
     * @return array
     */
    public function addNewTags($tags)
    {
        $ids = [];
        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $ids[] = $tag;
            } else {
                if (auth()->user()->can('create-tags')) {
                    $newTag = Tag::create(['name' => $tag]);
                    $ids[] = $newTag->id;
                }
            }
        }
        return $ids;
    }
}