<?php

namespace Tests\Feature\Kafka;

use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\ConsumedMessage;
use Junges\Kafka\Message\Message;
use Tests\TestCase;

class TradingPlatformControllerTest extends TestCase
{

    public $result = null ;

    private $data = [
        'driver'           => 'mql5',
        'trading_account'  => '98ab41a9-3240-44fe-8bfa-56eadb8b8b36',
        'command'          => 'iSAR',
        'arguments'        => [
            "symbol"   => "XAUUSD",
            "period"   => "PERIOD_M5",
            "step"     => "0.54",
            "maximum"   => "0.8"
        ]
    ];


    public function testPublished() : void
    {
        Kafka::fake();

        $message = new Message(
            body: [
                'send_mql_data' => $this->data
            ],
        );

        $producer = Kafka::publishOn(env('KAFKA_TOPIC'))->withMessage($message);

        $producer->send();

        Kafka::assertPublished($producer->getMessage());
    }


    public function testPublishOn() : void
    {
        Kafka::fake();

        $message = new Message(
            body: [
                'send_mql_data' => $this->data
            ],
        );

        $producer = Kafka::publishOn(env('KAFKA_TOPIC'))->withMessage($message);

        $producer->send();

        Kafka::assertPublishedOn(env('KAFKA_TOPIC') , $producer->getMessage() , function (Message $message){
            return $message->getBody();
        });
    }


    public function testGetMqlData():void {
        Kafka::fake();

        Kafka::shouldReceiveMessages([
            new ConsumedMessage(
                topicName: env('KAFKA_TOPIC'),
                partition : 0,
                headers: [],
                body: ['send_mql_data' => $this->data],
                key: null,
                offset: 0,
                timestamp: 0
            )
        ]);

        $consumer = Kafka::createConsumer([env('KAFKA_TOPIC')])
                         ->withHandler(function (KafkaConsumerMessage $message) {
                             $this->result = $message->getBody();
                             return 0;
                         })->build();

        $consumer->consume();


        $this->assertNotNull($this->result);
    }
}
