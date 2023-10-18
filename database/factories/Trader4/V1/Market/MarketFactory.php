<?php

namespace Database\Factories\Trader4\V1\Market;

use App\Enums\V1\Market\Market\MarketStatus;
use App\Models\Trader4\V1\Market\Market;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Market\Market>
 */
class MarketFactory extends Factory
{
    protected $model = Market::class;

    public function definition()
    {
        return [
            'name'   => $this->faker->word(),
            'slug'   => $this->faker->slug(2),
            'icon'   => null,
            'cover'  => null,
            'url'  => $this->faker->url(),
            'description'  => $this->faker->sentence(10),
            'content'  => $this->faker->sentence(20),
            'status' => MarketStatus::ACTIVE,
            'parent_id' => null,
        ];
    }
}
