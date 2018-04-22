<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class IterativeChildrenCollectorService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Gets all elements from database in iterative manner.
     *
     * @return array
     */
    public function getChildrenIterative(): array
    {
        //not using $this->getTopLevelParents, it would be concerns violation
        $topLevelParents = $this->categoryRepository->getTopLevelParents();
        $results[0] = $topLevelParents;
        $parents = $topLevelParents;

        $results = $this->iterate($results);

        return $results;
    }

    private function iterate($results)
    {
        $level = 1;
        while (true) {
            $merged = collect();
            foreach ($results[$level - 1] as $parent) {
                $temp = collect();
                if (is_array($results)) {
                    $results[$level] = collect();
                }
                if ($parent->getChildren->isEmpty() != true) { // negation (!) at the start is easy to miss
                    $temp = $parent->getChildren;
                }
                $merged = $merged->merge($temp);
            }
            $results[$level] = $merged;
            $merged = collect();//resets merged collection for next level
            if ($results[$level]->isEmpty()) {
                return $results;
            }
            $level++;
        }
    }
}