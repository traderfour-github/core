<?php

namespace Tests\Feature\Market;

use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Post;
use Tests\FeatureTestCase;

class PlatformTest extends FeatureTestCase
{
    private function createPlatforms(int $count = 10)
    {
        if ($count == 1) {
            return Platform::factory()->create();
        }

        return Platform::factory($count)->create();
    }

    public function test_platform_list_can_be_loaded()
    {
        $this->createPlatforms();

        $response = $this->get(route('platforms.index'));

        $response->assertOk();
    }

    public function test_platform_details_can_be_loaded()
    {
        $platform = $this->createPlatforms(1);

        $response = $this->get(route('platforms.show', [$platform->id]));

        $response->assertOk();
    }

    public function test_a_non_existing_platform_can_not_be_loaded()
    {
        $this->createPlatforms(1);

        $response = $this->get(route('platforms.show', ['test']));

        $response->assertNotFound();
    }

    public function test_platform_products_can_be_loaded()
    {
        $platform = Platform::factory()->hasAttached(Post::factory(10), [], 'products')->create();

        $response = $this->get(route('platforms.products', [$platform->id]));

        $response->assertOk();
    }
}
