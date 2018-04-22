<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Traits\FlattenArrayTrait;
use Illuminate\Contracts\View\View;

class CategoryTreeController extends Controller
{
    use FlattenArrayTrait;
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Gathers data and displays it onto view.
     *
     * @return view
     */
    public function index() : view
    {
        $recursiveResults = $this->categoryRepository->getChildrenRecursive()->toArray();
        $parents = $this->categoryRepository->getTopLevelParents();

        $flattenedRecursive = $this->flatten($recursiveResults);

        //dd();

        return view('index', ['parents' => $parents, 'recursiveResults' => $flattenedRecursive]);
    }
}
