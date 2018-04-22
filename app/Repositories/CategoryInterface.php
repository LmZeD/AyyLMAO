<?php

namespace App\Repositories;

interface CategoryInterface
{
    public function getChildrenIterative();

    public function getChildrenRecursive();

    public function getTopLevelParents();
}