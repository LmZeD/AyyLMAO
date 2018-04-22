<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository implements CategoryInterface
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * Gets all elements from database in recursive manner.
     *
     * @return mixed
     */
    public function getChildrenRecursive()
    {
        return $this->categoryModel->where('parent_id', null)->with('getChildrenRecursive')->get();
    }

    /**
     * Gets top level parents from database
     *
     * @return mixed
     */
    public function getTopLevelParents()
    {
        return $this->categoryModel->where('parent_id', null)->get();
    }
}