<?php

namespace Tests\Unit;

use App\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $categoryRepository;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        //pointless to mock, database transactions will free our hands
        $this->categoryRepository = new CategoryRepository(new Category());
    }

    /**
     * Test get all categories when table is empty
     *
     * Result must be empty
     *
     * @return void
     */
    public function testAllDatabaseEmpty()
    {
        foreach (Category::all() as $cat)
            Category::destroy($cat->id);
        $result = $this->categoryRepository->all();

        $this->assertEmpty($result);
    }

    /**
     * Test get all categories when table is not empty
     *
     * Result must be not empty
     *
     * @return void
     */
    public function testAllDatabaseNotEmpty()
    {
        factory(Category::class, 10)->create();
        $result = $this->categoryRepository->all();

        $this->assertNotEmpty($result);
    }

    /**
     * Test store when valid data is provided
     *
     * There must be one more row in database
     *
     * @return void
     */
    public function testStoreValidDataProvided()
    {
        $countBeforeInserting = Category::all()->count();
        $this->categoryRepository->store(['title' => 'test', 'parent_id' => null]);

        $this->assertCount($countBeforeInserting + 1, Category::all());
    }

    /**
     * Test store when invalid data is provided
     *
     * There must be no row difference in database
     *
     * @return void
     */
    public function testStoreInvalidDataProvided()
    {
        $countBeforeInserting = Category::all()->count();
        $this->categoryRepository->store(['not_valid_key' => 'test', 'parent_id' => null]);

        $this->assertCount($countBeforeInserting, Category::all());
    }

    /**
     * Test store when no data is provided
     *
     * There must be no row difference in database
     *
     * @return void
     */
    public function testStoreNoDataProvided()
    {
        $countBeforeInserting = Category::all()->count();
        $this->categoryRepository->store([]);

        $this->assertCount($countBeforeInserting, Category::all());
    }

    /**
     * Test getTopLevelParent, when top level parents exists
     *
     * Result must be not empty
     *
     * @return void
     */
    public function testGetTopLevelParents()
    {
        factory(Category::class, 10)->create();
        $result = $this->categoryRepository->getTopLevelParents();

        $this->assertNotEmpty($result);
    }

    /**
     * Test getTopLevelParent, when top level parents don't exist
     *
     * Result must be empty
     *
     * @return void
     */
    public function testGetTopLevelParentsWhenNoParentsAvailable()
    {
        foreach (Category::all() as $cat)
            Category::destroy($cat->id);
        $result = $this->categoryRepository->getTopLevelParents();

        $this->assertEmpty($result);
    }


    /**
     * Test getChildrenRecursive when table is not empty
     *
     * Idea: repository doesn't have to use Eloquent, but results must match
     *
     * Results must match
     */
    public function test()
    {
        $result = $this->categoryRepository->getChildrenRecursive();
        $eloquentResult = Category::where('parent_id', null)->with('getChildrenRecursive')->get();

        $this->assertEquals($eloquentResult, $result);
    }
}
