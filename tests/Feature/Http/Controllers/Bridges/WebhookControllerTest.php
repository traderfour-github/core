<?php

namespace Tests\Feature\Http\Controllers\Bridges;

use App\Jobs\V1\Bridge\BridgeWebhookJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\Fluent\AssertableJson;
use Junges\Kafka\Facades\Kafka;
use Tests\TestCase;

class WebhookControllerTest extends TestCase
{

    private const DATA = [
        'app_key'          => "98b9d304-5132-4bf8-b491-cce462a1803b" ,
        "order"            => "OP_BUY",
        "instrument"       => "CADUSD" ,
        "stop_loss"        => "1.234",
        "target_price"     => "1.378" ,
        "risk"             => "5.6",
        "risk_mode"        => "balance",
        "trading_account"  => ""
    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_webhook() : void
    {

        Queue::fake();
        Kafka::fake();

        BridgeWebhookJob::dispatchSync(self::DATA);

        $this->postJson('/v1/my/trading/webhook', [
            "payload" => self::DATA
        ])
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->etc());
    }
}
