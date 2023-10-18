<?php

namespace Database\Factories\Trader4\V1\FinancialEngineering;

use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory
 */
class RiskManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->uuid,
            'title' => $this->faker->title,
            'max_risk' => $this->faker->text(5),
            'max_risk_mode' => $this->faker->numberBetween(1,10),
            'max_risk_calculation' => $this->faker->numberBetween(1,10),
            'is_max_risk_relative' => $this->faker->boolean,
            'max_daily_risk' => $this->faker->text(5),
            'max_daily_risk_mode' => $this->faker->numberBetween(1,10),
            'max_daily_risk_calculation' => $this->faker->numberBetween(1,10),
            'risk_per_chart' => $this->faker->text(5),
            'risk_per_chart_mode' => $this->faker->numberBetween(1,10),
            'risk_per_chart_calculation' => $this->faker->numberBetween(1,10),
            'risk_per_trade' => $this->faker->text(5),
            'risk_per_trade_mode' => $this->faker->numberBetween(1,10),
            'risk_per_trade_calculation' => $this->faker->numberBetween(1,10),
            'risk_reward_ratio' => $this->faker->numberBetween(1,10),
            'positive_correlation' => json_encode(['key' => $this->faker->randomNumber()]),
            'negative_correlation' => json_encode(['key' => $this->faker->randomNumber()]),
            'low_correlation' => json_encode(['key' => $this->faker->randomNumber()]),
            'hedge' => $this->faker->boolean,
            'required_stop_loss' => $this->faker->boolean,
            'required_target_profit' => $this->faker->boolean,
            'news_trading' => json_encode(['key' => $this->faker->randomNumber()]),
            'allowed_instruments' => json_encode(['key' => $this->faker->randomNumber()]),
            'allowed_times' => json_encode(['key' => $this->faker->randomNumber()]),
            'allowed_order_types' => json_encode(['key' => $this->faker->randomNumber()]),
            'is_public' => $this->faker->boolean,
        ];
    }
}
