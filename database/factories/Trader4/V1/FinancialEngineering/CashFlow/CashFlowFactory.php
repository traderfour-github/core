<?php

namespace Database\Factories\Trader4\V1\FinancialEngineering\CashFlow;

use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

use function now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\FinancialEngineering\CashFlow\CashFlow>
 */
class CashFlowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //TOdo: edit market_id and trading_account_id
        return [
            'market_id' => "991bc116-6aa0-4def-aa20-7262d348a4d4",
            'user_id' => $this->faker->uuid,
            'trading_account_id' => Account::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'public' => false,
            'from' => now(),
            'till' => now()->addDays(7),
            'status' => 30000,
        ];
    }
}
