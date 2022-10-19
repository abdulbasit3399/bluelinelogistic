<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Category;

/**
 * Heplers for Category model
 */
class CategoryRepository {


    /**
     * Get id and name for show in select form
     * @return Category
     */
    public function category_list_for_select($name = null, $limit = 100)
    {
        $query = Category::select('id', 'name')->orderByDesc('id');
        if ($name && $name != '') {
            $query->where('name->' . app()->getLocale(), 'LIKE', "%$name%");
        }
        return $query->limit($limit)->get();
    }


    /**
     * Get id and name for show in select form
     * @return Category
     */
    public function parents_list_for_select($id = null, $limit = 100)
    {
        $query = Category::select('id', 'name')->orderByDesc('id');
        if ($id && $id != '') {
            $query->where('id', '!=', $id);
        }
        return $query->limit($limit)->get();
    }



    private $parents = [];

    public function crumbParents($category_id)
    {
        $category = Category::with('categoryParent')->find($category_id);
        if ($category && $category->categoryParent) {
            $this->getParent($category->categoryParent);
        }
        return collect($this->parents)->reverse();
    }



    private function getParent($categoryParent)
    {
        if ($categoryParent->active) {
            $this->parents[] = $categoryParent;
        }
        if ($categoryParent->categoryParent) {
            $this->getParent($categoryParent->categoryParent);
        }
    }

    
}