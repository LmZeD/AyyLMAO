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

    public function getDataForIndex()
    {
        $recursiveResults = $this->categoryRepository->getChildrenRecursive()->toArray();
        $parents = $this->categoryRepository->getTopLevelParents();
        $iterativeResults = $this->iterativeChildrenCollectorService->getChildrenIterative();

        $flattenedRecursive = $this->flatten($recursiveResults);
        $mergedIterative = $this->mergeCollectionsArray($iterativeResults);
        asort($mergedIterative);

        return [$parents, $flattenedRecursive, $mergedIterative];
    }
}