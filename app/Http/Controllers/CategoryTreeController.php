<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;

class CategoryTreeController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $recursiveResults = $this->categoryRepository->getChildrenRecursive();
        $parents = $this->categoryRepository->getTopLevelParents();

        //dd($recursiveResults);

        return view('index', ['parents' => $parents, 'recursiveResults' => $recursiveResults]);
    }

}
