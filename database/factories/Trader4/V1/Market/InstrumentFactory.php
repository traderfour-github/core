<?php

namespace Database\Factories\Trader4\V1\Market;

use App\Enums\V1\Market\Instrument\InstrumentCalculationMode;
use App\Enums\V1\Market\Instrument\InstrumentChartMode;
use App\Enums\V1\Market\Instrument\InstrumentIndustry;
use App\Enums\V1\Market\Instrument\InstrumentSector;
use App\Enums\V1\Market\Instrument\InstrumentStatus;
use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Instrument;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Market\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Market\Instrument>
 */
class InstrumentFactory extends Factory
{
    protected $model = Instrument::class;

    public function definition()
    {
        return [
            'name'                        => $this->faker->word(),
            'slug'                        => $this->faker->slug(2),
            'logo'                        => null,
            'description'                 => $this->faker->sentence(10),
            'broker_id'                   => Broker::factory(),
            'platform_id'                 => Platform::factory(),
            'server_id'                   => Server::factory(),
            'sector'                      => array_rand(InstrumentSector::toArray()),
            'industry'                    => array_rand(InstrumentIndustry::toArray()),
            'digits'                      => rand(0, 8),
            'contract_size'               => rand(0, 65535),
            'spread'                      => rand(0, 65535),
            'stops_level'                 => rand(0, 65535),
            'margin_currency'             => $this->faker->currencyCode(),
            'profit_currency'             => $this->faker->currencyCode(),
            'calculation_mode'            => array_rand(InstrumentCalculationMode::toArray()),
            'tick_size'                   => $this->faker->randomFloat(2, max: 99),
            'tick_value'                  => rand(0, 65535),
            'chart_mode'                  => array_rand(InstrumentChartMode::toArray()),
            'margin_rate'                 => $this->faker->sentence(10),
            'swap_rate'                   => $this->faker->sentence(10),
            'sessions'                    => $this->faker->sentence(10),
            'max_leverage'                => $this->faker->numberBetween(1, 3000),
            'min_lot_size'                => $this->faker->randomFloat(2),
            'max_lot_size'                => $this->faker->randomFloat(2),
            'commission'                  => $this->faker->randomFloat(2),
            'commission_calculation_mode' => array_rand(['fixed', 'percentage', 'us_dollar']),
            'status'                      => InstrumentStatus::ACTIVE,
        ];
    }
}
