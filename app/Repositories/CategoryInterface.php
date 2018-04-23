<?php

namespace App\Repositories;

interface CategoryInterface
{
    public function getChildrenRecursive();

    public function getTopLevelParents();

    public function store(array $args);

    public function all();
}