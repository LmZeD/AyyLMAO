<?php

namespace App\Repositories;

interface CategoryInterface
{
    public function getChildrenRecursive();

    public function getTopLevelParents();
}