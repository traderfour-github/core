<?php

namespace Database\Factories\Trader4\V1\Trading;

use App\Enums\V1\Trading\Type;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Trading\Trade>
 */
class TradeFactory extends Factory
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
            "balance"            => $this->faker->numberBetween(100 , 25000),
            "order"              => $this->faker->randomElement(['buy' , 'sell']),
            "type"               => $this->faker->randomElement(Type::getValues()),
            "open"               => $this->faker->dateTimeBetween('-6 month', '+1 week'),
            "size"               => $this->faker->numberBetween(0.01 , 10),
            "symbol"             => $this->faker->randomElement(['USDEUR' , 'GPBUSD' , 'XAUUSD', 'EURJPY','NZDCAD']),
            "open_price"         => $this->faker->randomFloat(2 , 1 , 2000),
            "sl"                 => $this->faker->randomFloat(2 , 1 , 2000),
            "tp"                 => $this->faker->randomFloat(2 , 1 , 2000),
            "close"              => $this->faker->dateTimeBetween('-6 month', '+1 week'),
            "close_price"        => $this->faker->randomFloat(2 , 1 , 2000),
            "swap"               => $this->faker->randomFloat(2 , 0.01 , 1000),
            "commission"         => $this->faker->randomFloat(2 , 0.01 , 1000),
            "tax"                => $this->faker->randomFloat(2 , 0.01 , 1000),
            "profit"              => $this->faker->randomFloat(2 , 1 , 2000),
        ];
    }
}
