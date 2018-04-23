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
     * Gets data needed for index view in controller.
     *
     * @return array
     */
    public function getDataForIndex(): array
    {
        $flattenedRecursive = $this->getRecursiveSolution();
        $parents = $this->categoryRepository->getTopLevelParents();
        $mergedIterative = $this->getIterativeSolution();
        $allCategories = $this->categoryRepository->all();

        return [$parents, $flattenedRecursive, $mergedIterative, $allCategories];
    }

    /**
     * Fetches iterative solution. Not private because needed for console command. Could be split to its own service
     * on bigger project.
     *
     * @return array
     */
    public function getIterativeSolution(): array
    {
        $iterativeResults = $this->iterativeChildrenCollectorService->getChildrenIterative();
        $mergedIterative = $this->mergeCollectionsArray($iterativeResults);
        $mergedIterative = $this->unsetGetChildren($mergedIterative);
        asort($mergedIterative);
        return $mergedIterative;

    }

    /**
     * Fetches recursive solution. Not private because needed for console command. Could be split to its own service
     * on bigger project.
     *
     * @return array
     */
    public function getRecursiveSolution(): array
    {
        $recursiveResults = $this->categoryRepository->getChildrenRecursive()->toArray();
        $flattenedRecursive = $this->flatten($recursiveResults);
        $flattenedRecursive = $this->removeParentIds($flattenedRecursive);

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

    /**
     * Removes redundant data from array
     *
     * @param $array
     *
     * @return array
     */
    private function removeParentIds($array): array
    {
        $arrayToReturn = [];
        $i = 0;
        foreach ($array as $a) {
            if ($i % 2 == 1)
                $arrayToReturn[$i] = $a;
            $i++;
        }
        return $arrayToReturn;
    }
}