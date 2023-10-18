<?php

namespace Database\Factories\Trader4\V1\Trading;

use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Market\Server;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Trading\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        foreach (Market::all() as $market) {
            return [
                'user_id'   => Str::uuid(),
                'name'      => $this->faker->name(),
                'broker_id' => Broker::factory(),
                'market_id' => $this->faker->randomElement([$market->id]),
                'platform_id' => Platform::factory(),
                'server_id' => Server::factory(),
                'company'   => $this->faker->company(),
                'identity'  => $this->faker->sha256(),
                'secret'    => $this->faker->sha1()
            ];
        }
    }
}
