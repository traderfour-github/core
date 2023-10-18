<?php

namespace Tests\Feature\Market;

use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Market\Server;
use Tests\FeatureTestCase;

class BrokerTest extends FeatureTestCase
{
    private function createBrokers(int $count = 10)
    {
        if ($count == 1) {
            return Broker::factory()->create();
        }

        return Broker::factory($count)->create();
    }

    public function test_broker_list_can_be_loaded()
    {
        $this->createBrokers();

        $response = $this->get(route('brokers.index'));

        $response->assertOk();
    }

    public function test_broker_details_can_be_loaded()
    {
        $broker = $this->createBrokers(1);

        $response = $this->get(route('brokers.show', [$broker->id]));

        $response->assertOk();
    }

    public function test_a_non_existing_broker_can_not_be_loaded()
    {
        $this->createBrokers(1);

        $response = $this->get(route('brokers.show', ['test']));

        $response->assertNotFound();
    }

    public function test_broker_platforms_can_be_loaded()
    {
        $broker = $this->createBrokers(1);
        Platform::factory(3)->for($broker, 'broker')->create();

        $response = $this->get(route('brokers.platforms', [$broker->id]));

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

    public function test_broker_servers_can_be_loaded()
    {
        $broker = $this->createBrokers(1);
        $platform = Platform::factory()->for($broker, 'broker')->create();
        Server::factory()
              ->for($broker, 'broker')
              ->for($platform, 'platform')
              ->create();

        $response = $this->get(route('brokers.servers', ['uuid' => $broker->id, 'platform_id' => $platform->id]));

        $response->assertOk();
        $response->assertSee(['uuid', 'title']);
    }
}
