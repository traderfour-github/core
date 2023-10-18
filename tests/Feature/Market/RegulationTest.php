<?php

namespace Tests\Feature\Market;

use Tests\FeatureTestCase;

class RegulationTest extends FeatureTestCase
{
    public function test_regulation_list_can_be_loaded()
    {
        $response = $this->get(route('regulations.index'));

        $response->assertOk();
    }
}
