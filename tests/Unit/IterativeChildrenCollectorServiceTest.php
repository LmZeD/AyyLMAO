<?php

namespace Tests\Unit;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Services\Category\IterativeChildrenCollectorService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IterativeChildrenCollectorServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $iterativeChildrenCollectorService;
    private $categoryRepositoryMock;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setUpMocks();
        $this->iterativeChildrenCollectorService = new IterativeChildrenCollectorService($this->categoryRepositoryMock);
    }

    private function setUpMocks()
    {
        $this->categoryRepositoryMock = \Mockery::mock(CategoryRepository::class);
    }

    /**
     * Tests getIterativeChildren method when no top level parents provided
     *
     * Result must be empty
     *
     * @return void
     */
    public function testNoTopLevelParents()
    {
        $this->categoryRepositoryMock->shouldReceive('getTopLevelParents')->once()->andReturn([]);
        $result = $this->iterativeChildrenCollectorService->getChildrenIterative();

        $this->assertEmpty($result[0]);
    }

    /**
     * Tests getIterativeChildren method when one top level parents provided (and has only one child).
     *
     * Result must be equal to child created
     *
     * @return void
     */
    public function testOneTopLevelParentOneChild()
    {
        factory(Category::class, 10)->create();
        //getting last one because database might be not empty
        $parent = Category::orderBy('id', 'desc')->first();
        $child = Category::create(['title' => 'test', 'parent_id' => $parent->id]);
        $this->categoryRepositoryMock->shouldReceive('getTopLevelParents')->once()->andReturn([$parent]);
        $result = $this->iterativeChildrenCollectorService->getChildrenIterative();

        //result array MUST contain second level array (contains top level children)
        $result = $result[1]->toArray();

        //result MUST have only one element
        $this->assertEquals($child->title, $result[0]['title']);
    }

    /**
     * Tests getIterativeChildren method when one top level parents provided (and has many children).
     *
     * Result must be equal to number of children created
     *
     * @return void
     */
    public function testOneTopLevelParentManyChildren()
    {
        $numberOfChildren = 10;
        factory(Category::class, 10)->create();
        //getting last one because database might be not empty
        $parent = Category::orderBy('id', 'desc')->first();
        for ($i = 0; $i < $numberOfChildren; $i++) {
            Category::create(['title' => 'test' . $i, 'parent_id' => $parent->id]);
        }
        $this->categoryRepositoryMock->shouldReceive('getTopLevelParents')->once()->andReturn([$parent]);
        $result = $this->iterativeChildrenCollectorService->getChildrenIterative();

        //result array MUST contain second level array (contains top level children)
        $result = $result[1]->toArray();

        //result MUST have $numberOfChildren elements
        $this->assertCount($numberOfChildren, $result);
    }
}
