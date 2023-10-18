<?php

namespace App\Console\Commands\Bridges;

use App\Events\Bridge\BridgeConsumerEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\ConsumedMessage;

class BridgeConsumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bridge:consumer {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Kafka consumer for a topic';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $topic = $this->argument('topic');

        Kafka::createConsumer([$topic])
             ->withHandler(function (ConsumedMessage $message) {
                 try {
                     event(new BridgeConsumerEvent($message->getBody()));
                     $redis = Redis::connection();
                     $redis->set('consumer' , json_encode($message->getBody()));
                     dump($message->getBody());
                 } catch (\Exception $exception) {
                     dump('failed to dispatch an event for kafka message', $exception);
                 }
             })
             ->build()
             ->consume();
    }
}
