<?php

namespace Tests\Feature\Category;

use App\Models\Trader4\V1\Category;
use Tests\FeatureTestCase;

class CategoryTest extends FeatureTestCase
{
    public function test_category_list_can_be_loaded()
    {
        Category::factory(10)->create();

        $response = $this->get(route('categories.index'));

        $response->assertOk();
    }

    public function test_category_children_can_be_loaded()
    {
        $category = Category::factory()->has(Category::factory(10), 'children')->create();

        $response = $this->get(route('categories.children', [$category->id]));

        $response->assertOk();
    }

    public function test_children_of_a_non_existing_category_can_not_be_loaded()
    {
        Category::factory()->has(Category::factory(10), 'children')->create();

        $response = $this->get(route('categories.children', ['test']));

        $response->assertNotFound();
    }
}
