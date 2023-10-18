<?php

namespace Database\Factories\Trader4\V1\Trading;

use App\Enums\V1\Trading\Type;
use App\Models\Trader4\V1\FinancialEngineering\MoneyManagement;
use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use App\Models\Trader4\V1\FinancialEngineering\TradingPlan;
use App\Models\Trader4\V1\Market\Market;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Trading\Trade>
 */
class FrameworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "market_id"          => Market::factory(),
            "trading_account_id" => Account::factory() ,
            "risk_management_id" => RiskManagement::factory(),
            "trading_plan_id"    => TradingPlan::factory(),
            "money_management_id"=> MoneyManagement::factory(),
            'user_id'            => $this->faker->uuid,
            "title"              => $this->faker->title(),
            'public'             => $this->faker->boolean,
        ];
    }
}
