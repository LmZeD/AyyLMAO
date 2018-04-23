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

    /**
     * Stores new category to database
     *
     * @param array $args
     *
     * @return bool
     */
    public function store(array $args): bool
    {
        $this->categoryModel->create($args);
        return true;
    }

    /**
     * Gets all repositories
     *
     * @return array
     */
    public function all()
    {
        return $this->categoryModel->all();
    }
}