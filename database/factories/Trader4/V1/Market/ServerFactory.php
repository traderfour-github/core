<?php

namespace Database\Factories\Trader4\V1\Market;

use App\Enums\V1\Market\Server\ServerIPType;
use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Market\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Market\Server>
 */
class ServerFactory extends Factory
{
    protected $model = Server::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->word(),
            'market_id'   => Market::factory(),
            'broker_id'   => Broker::factory(),
            'platform_id' => Platform::factory(),
            'address'     => $this->faker->ipv4(),
            'ip_type'     => ServerIPType::IPV4,
            'port'        => $this->faker->numberBetween(1, 6553),
            'status'      => $this->faker->numberBetween(16500, 16600),
        ];
    }
}
