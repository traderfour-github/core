<?php

namespace Database\Factories\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory
 */
class MoneyManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'            => $this->faker->uuid,
            'title'              => $this->faker->title(),
        ];
    }
}
