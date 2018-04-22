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


    public function getChildrenIterative()
    {

    }


    public function getChildrenRecursive()
    {
        return $this->categoryModel->where('parent_id', null)->with('getChildrenRecursive')->get();
    }

    public function getTopLevelParents()
    {
        return $this->categoryModel->where('parent_id', null)->get();
    }
}