<?php

namespace Tests\Unit;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Services\Category\IterativeChildrenCollectorService;
use App\Services\Category\PrepareDataForPrintingService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PrepareDataForPrintingTest extends TestCase
{
    use DatabaseTransactions;

    private $prepareDataForPrintingService;
    private $categoryRepositoryMock;
    private $iterativeChildrenCollectorServiceMock;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setUpMocks();
        $this->prepareDataForPrintingService =
            new PrepareDataForPrintingService($this->categoryRepositoryMock, $this->iterativeChildrenCollectorServiceMock);
    }

    private function setUpMocks()
    {
        $this->categoryRepositoryMock = \Mockery::mock(CategoryRepository::class);
        $this->iterativeChildrenCollectorServiceMock = \Mockery::mock(IterativeChildrenCollectorService::class);
    }

    /**
     * Tests empty array returned when calling getChildrenIterative
     *
     * Result must be empty array
     *
     * @return void
     */
    public function testIterativeSolutionEmptyArrayReturned()
    {
        $this->iterativeChildrenCollectorServiceMock->shouldReceive('getChildrenIterative')->once()->andReturn([]);
        $result = $this->prepareDataForPrintingService->getIterativeSolution();

        $this->assertEmpty($result);
    }

    /**
     * Tests non empty array returned when calling getChildrenIterative
     *
     * Result array must contain number of elements received from mock (this case 2)
     *
     * @return void
     */
    public function testIterativeSolutionNonEmptyOneDimensionArrayReturned()
    {
        $array = [
            collect([
                new Category(['title' => 'cat 1', 'parent_id' => null]),
                new Category(['title' => 'cat 2', 'parent_id' => null]),
            ]),
        ];
        $this->iterativeChildrenCollectorServiceMock->shouldReceive('getChildrenIterative')->once()->andReturn($array);
        $result = $this->prepareDataForPrintingService->getIterativeSolution();

        $this->assertCount(2, $result);
    }

    /**
     * Tests non empty array returned when calling getChildrenIterative
     *
     * Result array must contain number of elements received from mock (this case 8)
     *
     * @return void
     */
    public function testIterativeSolutionNonEmptyManyDimensionsArrayReturned()
    {
        $array = [
            collect([
                new Category(['title' => 'cat 1', 'parent_id' => null]),
                new Category(['title' => 'cat 2', 'parent_id' => null]),
            ]),
            collect([
                new Category(['title' => 'cat 1.1', 'parent_id' => null]),
                new Category(['title' => 'cat 2.1', 'parent_id' => null]),
            ]),
            collect([
                new Category(['title' => 'cat 1.1.1', 'parent_id' => null]),
                new Category(['title' => 'cat 2.1.1', 'parent_id' => null]),
                new Category(['title' => 'cat 1.1.2', 'parent_id' => null]),
                new Category(['title' => 'cat 2.1.2', 'parent_id' => null]),
            ])
        ];
        $this->iterativeChildrenCollectorServiceMock->shouldReceive('getChildrenIterative')->once()->andReturn($array);
        $result = $this->prepareDataForPrintingService->getIterativeSolution();

        $this->assertCount(8, $result);
    }

    /**
     * Tests empty collection returned when calling getChildrenRecursive
     *
     * Result must be empty
     *
     * @return void
     */
    public function testRecursiveSolutionEmptyArrayReturned()
    {
        $this->categoryRepositoryMock->shouldReceive('getChildrenRecursive')->once()->andReturn(collect());
        $result = $this->prepareDataForPrintingService->getRecursiveSolution();

        $this->assertEmpty($result);


    }

    /**
     * Tests non empty collection returned when calling getChildrenRecursive
     *
     * Result must be equal count to collection provided to (received from) getChildrenRecursive
     *
     * @return void
     */
    public function testRecursiveSolutionNonEmptyArrayReturned()
    {
        factory(Category::class, 10)->create();
        $collection = Category::all();
        $this->categoryRepositoryMock->shouldReceive('getChildrenRecursive')->once()->andReturn($collection);
        $result = $this->prepareDataForPrintingService->getRecursiveSolution();

        $this->assertCount(count($collection), $result);
    }

    /**
     * Tests empty arrays returned when calling all methods for getDataForIndex
     *
     * Result arrays must be empty, so merged results should be empty too
     *
     * @return void
     */
    public function test()
    {
        $this->categoryRepositoryMock->shouldReceive('getChildrenRecursive')->once()->andReturn(collect());
        $this->categoryRepositoryMock->shouldReceive('getTopLevelParents')->once()->andReturn([]);
        $this->categoryRepositoryMock->shouldReceive('all')->once()->andReturn([]);
        $this->iterativeChildrenCollectorServiceMock->shouldReceive('getChildrenIterative')->once()->andReturn([]);
        [$result1, $result2, $result3, $result4]= $this->prepareDataForPrintingService->getDataForIndex();

        $this->assertEmpty(array_merge($result1, $result2, $result3, $result4));
    }
}
