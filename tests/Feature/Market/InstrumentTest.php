<?php

namespace Tests\Feature\Market;

use App\Models\Trader4\V1\Market\Instrument;
use Tests\FeatureTestCase;

class InstrumentTest extends FeatureTestCase
{
    private function createInstruments(int $count = 10)
    {
        if ($count == 1) {
            return Instrument::factory()->create();
        }

        return Instrument::factory($count)->create();
    }

    public function test_instrument_details_can_be_loaded()
    {
        $instrument = $this->createInstruments(1);

        $response = $this->get(route('instruments.show', [$instrument->id]));

        $response->assertOk();
    }

    public function test_a_non_existing_instrument_can_not_be_loaded()
    {
        $this->createInstruments(1);

        $response = $this->get(route('instruments.show', ['test']));

        $response->assertNotFound();
    }
}
