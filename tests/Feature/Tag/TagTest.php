<?php

namespace Tests\Feature\Tag;

use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Tag;
use Tests\FeatureTestCase;

class TagTest extends FeatureTestCase
{
    private function createTags(int $count = 10)
    {
        if ($count == 1) {
            return Tag::factory()->create();
        }

        return Tag::factory($count)->create();
    }

    public function test_tag_list_can_be_loaded()
    {
        $this->createTags();

        $response = $this->get(route('tags.index'));

        $response->assertOk();
    }

    public function test_tag_details_can_be_loaded()
    {
        $tag = $this->createTags(1);

        $response = $this->get(route('tags.show', [$tag->id]));

        $response->assertOk();
    }

    public function test_a_non_existing_tag_can_not_be_loaded()
    {
        $this->createTags(1);

        $response = $this->get(route('tags.show', ['test']));

        $response->assertNotFound();
    }

    public function test_tag_products_can_be_loaded()
    {
        $tag = Tag::factory()->hasAttached(Post::factory(10), [], 'products')->create();

        $response = $this->get(route('tags.products', [$tag->id]));

        $response->assertOk();
    }
}
