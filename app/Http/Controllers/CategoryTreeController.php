<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\Category\PrepareDataForPrintingService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;

class CategoryTreeController extends Controller
{
    private $prepareDataForPrintingService;
    private $categoryRepository;

    public function __construct(
        PrepareDataForPrintingService $prepareDataForPrintingService,
        CategoryRepository $categoryRepository
    ) {
        $this->prepareDataForPrintingService = $prepareDataForPrintingService;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Gathers data and displays it onto view.
     *
     * @return view
     */
    public function index(): view
    {
        [$parents, $flattenedRecursive, $mergedIterative, $allCategories] = $this->prepareDataForPrintingService
            ->getDataForIndex();

        return view('index',
            [
                'parents' => $parents,
                'recursiveResults' => $flattenedRecursive,
                'iterativeResults' => $mergedIterative,
                'allCategories' => $allCategories
            ]);
    }

    /**
     * Stores new category to database
     *
     * @param CreateCategoryRequest $request
     *
     * @return redirect
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepository->store($request->toArray());
        return redirect()->route('index')->with('success', 'Successfully created category!');
    }
}
