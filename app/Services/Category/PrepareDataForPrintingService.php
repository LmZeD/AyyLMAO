<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Traits\ArrayFormattingTrait;

class PrepareDataForPrintingService
{
    use ArrayFormattingTrait;
    private $categoryRepository;
    private $iterativeChildrenCollectorService;

    public function __construct(
        CategoryRepository $categoryRepository,
        IterativeChildrenCollectorService $iterativeChildrenCollectorService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->iterativeChildrenCollectorService = $iterativeChildrenCollectorService;
    }

    /**
     * Gets all data needed for index view in controller.
     *
     * @return array
     */
    public function getDataForIndex()
    {
        $flattenedRecursive = $this->getRecursiveSolution();
        $parents = $this->categoryRepository->getTopLevelParents();
        $mergedIterative = $this->getIterativeSolution();

        return [$parents, $flattenedRecursive, $mergedIterative];
    }

    /**
     * Fetches iterative solution.
     *
     * @return array
     */
    public function getIterativeSolution(): array
    {
        $iterativeResults = $this->iterativeChildrenCollectorService->getChildrenIterative();
        $mergedIterative = $this->mergeCollectionsArray($iterativeResults);
        asort($mergedIterative);
        $mergedIterative = $this->unsetGetChildren($mergedIterative);
        return $mergedIterative;

    }

    /**
     * Fetches recursive solution.
     *
     * @return array
     */
    public function getRecursiveSolution(): array
    {
        $recursiveResults = $this->categoryRepository->getChildrenRecursive()->toArray();
        $flattenedRecursive = $this->flatten($recursiveResults);

        return $flattenedRecursive;
    }

    /**
     * Removes redundant entries from array (caused by casting collection to array) to match other data return types.
     *
     * @param $array
     *
     * @return array
     */
    private function unsetGetChildren($array): array
    {
        $arrayToReturn = [];
        $i = 0;
        foreach ($array as $a) {
            $arrayToReturn[$i++] = $a['title'];
        }
        return $arrayToReturn;
    }
}