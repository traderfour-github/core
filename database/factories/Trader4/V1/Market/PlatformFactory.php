<?php

namespace Database\Factories\Trader4\V1\Market;

use App\Enums\V1\Market\Platform\Status;
use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Market\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Market\Platform>
 */
class PlatformFactory extends Factory
{
    protected $model = Platform::class;

    public function definition()
    {
        return [
            'market_id'         => Market::factory(),
            'broker_id'         => Broker::factory(),
            'title'             => $this->faker->word(),
            'slug'              => $this->faker->slug(),
            'icon'              => null,
            'cover'             => null,
            'description'       => $this->faker->sentence(10),
            'content'           => $this->faker->sentence(20),
            'url'               => $this->faker->url(),
            'email'             => $this->faker->email(),
            'privacy_policy'    => $this->faker->sentence(10),
            'api_documentation' => $this->faker->sentence(10),
            'terms_of_use'      => $this->faker->sentence(10),
            'address'           => $this->faker->sentence(10),
            'permissions'       => $this->faker->sentence(10),
            'oss'               => $this->faker->sentence(10),
            'status'            => Status::ACTIVE,
        ];
    }
}
