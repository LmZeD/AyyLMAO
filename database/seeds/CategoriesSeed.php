<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'parent_id' => null,
            'title' => 'cat 1'
        ]);

        Category::create([
            'parent_id' => null,
            'title' => 'cat 2'
        ]);

        Category::create([
            'parent_id' => null,
            'title' => 'cat 3'
        ]);

        Category::create([
            'parent_id' => 1,
            'title' => 'cat 1.1'
        ]);

        Category::create([
            'parent_id' => 1,
            'title' => 'cat 1.2'
        ]);

        Category::create([
            'parent_id' => 1,
            'title' => 'cat 1.3'
        ]);

        Category::create([
            'parent_id' => 4,
            'title' => 'cat 1.1.1'
        ]);

        Category::create([
            'parent_id' => 4,
            'title' => 'cat 1.1.2'
        ]);

        Category::create([
            'parent_id' => 7,
            'title' => 'cat 1.1.1.1'
        ]);

        Category::create([
            'parent_id' => 7,
            'title' => 'cat 1.1.1.2'
        ]);

        Category::create([
            'parent_id' => 3,
            'title' => 'cat 3.1'
        ]);

        Category::create([
            'parent_id' => 3,
            'title' => 'cat 3.2'
        ]);

        Category::create([
            'parent_id' => 12,
            'title' => 'cat 3.2.1'
        ]);
    }
}
