<?php

namespace Tests\Feature\Market;

use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use Tests\FeatureTestCase;

class MarketTest extends FeatureTestCase
{
    private function createMarkets(int $count = 10)
    {
        if ($count == 1) {
            return Market::factory()->create();
        }

        return Market::factory($count)->create();
    }

    public function test_market_list_can_be_loaded()
    {
        $this->createMarkets();

        $response = $this->get(route('markets.index'));

        $response->assertOk();
        $response->assertSee(['uuid', 'name', 'slug', 'icon', 'cover', 'status']);
    }

    public function test_market_details_can_be_loaded()
    {
        $market = $this->createMarkets(1);

        $response = $this->get(route('markets.show', [$market->id]));

        $response->assertOk();
        $response->assertSee(['uuid', 'name', 'slug', 'icon', 'cover', 'status', 'parent_id', 'children']);
    }

    public function test_a_non_existing_market_can_not_be_loaded()
    {
        $this->createMarkets(1);

        $response = $this->get(route('markets.show', ['test']));

        $response->assertNotFound();
    }

    public function test_market_platforms_can_be_loaded()
    {
        $market = $this->createMarkets(1);
        Platform::factory(3)->for($market, 'market')->create();

        $response = $this->get(route('markets.platforms', [$market->id]));

        $response->assertOk();
        $response->assertSee([
            'uuid',
            'title',
            'slug',
            'icon',
            'cover',
            'description',
            'content',
            'url',
            'email',
            'privacy_policy',
            'terms_of_use',
            'address',
            'permissions',
            'oss',
            'status',
        ]);
    }
}
