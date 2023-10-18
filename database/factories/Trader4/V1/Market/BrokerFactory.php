<?php

namespace Database\Factories\Trader4\V1\Market;

use App\Enums\V1\Market\Broker\BrokerStatus;
use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Market\Broker>
 */
class BrokerFactory extends Factory
{
    protected $model = Broker::class;

    public function definition()
    {
        $fields = [
            'market_id' => Market::factory(),
            'name' => $this->faker->word(),
            'logo' => null,
            'website' => $this->faker->url(),
            'description' => $this->faker->sentence(10),
            'country' => $this->faker->countryISOAlpha3(),
            'account_currencies' => $this->faker->currencyCode(),
            'phone' => $this->faker->e164PhoneNumber(),
            'fax' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
            'languages' => $this->faker->languageCode(),
            'spread' => $this->faker->randomNumber(2),
            'status' => BrokerStatus::ACTIVE,
        ];

        foreach (Broker::$booleanFields as $field) {
            $fields[$field] = $this->faker->boolean();
        }

        foreach (Broker::$jsonFields as $field) {
            $fields[$field] = $this->faker->sentence(20);
        }

        return $fields;
    }
}
