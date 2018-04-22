<?php

namespace App\Http\Controllers;

use App\Services\Category\PrepareDataForPrintingService;
use Illuminate\Contracts\View\View;

class CategoryTreeController extends Controller
{
    private $prepareDataForPrintingService;

    public function __construct(PrepareDataForPrintingService $prepareDataForPrintingService)
    {
        $this->prepareDataForPrintingService = $prepareDataForPrintingService;
    }


    /**
     * Gathers data and displays it onto view.
     *
     * @return view
     */
    public function index(): view
    {
        [$parents, $flattenedRecursive, $mergedIterative] = $this->prepareDataForPrintingService->getDataForIndex();

        return view('index',
            [
                'parents' => $parents,
                'recursiveResults' => $flattenedRecursive,
                'iterativeResults' => $mergedIterative
            ]);
    }
}
