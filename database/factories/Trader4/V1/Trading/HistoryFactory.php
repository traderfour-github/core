<?php

namespace Database\Factories\Trader4\V1\Trading;

use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "trading_account_id" => Account::factory() ,
            "balance"            => $this->faker->randomFloat(2 , 100 , 25000),
            "credit"             => $this->faker->randomFloat(2 , 10 , 1500),
            "equity"             => $this->faker->randomFloat(2 , 100 , 12000),
            "margin"             => $this->faker->randomFloat(2 , 200 , 10000),
            "free_margin"        => $this->faker->randomFloat(2 , 100 , 15000),
            "margin_level"       => $this->faker->randomFloat(2 , 10 , 13000),
        ];
    }
}
