<?php

namespace Tests\Feature\Market;

use App\Models\Trader4\V1\Market\Instrument;
use App\Models\Trader4\V1\Market\Server;
use Tests\FeatureTestCase;

class ServerTest extends FeatureTestCase
{
    private function createServers(int $count = 10)
    {
        if ($count == 1) {
            return Server::factory()->create();
        }

        return Server::factory($count)->create();
    }

    public function test_server_details_can_be_loaded()
    {
        $server = $this->createServers(1);

        $response = $this->get(route('servers.show', [$server->id]));

        $response->assertOk();
    }

    public function test_a_non_existing_server_can_not_be_loaded()
    {
        $this->createServers(1);

        $response = $this->get(route('servers.show', ['test']));

        $response->assertNotFound();
    }

    public function test_server_instruments_can_be_loaded()
    {
        $server = $this->createServers(1);
        Instrument::factory(3)->for($server, 'server')->create();

        $response = $this->get(route('servers.instruments', [$server->id]));

        $response->assertOk();
    }
}
