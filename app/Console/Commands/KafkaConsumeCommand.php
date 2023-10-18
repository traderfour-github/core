<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\ConsumedMessage;

class KafkaConsumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consumer {topic}';

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
                     if ($event = config('trader4.kafka.topics.'.$message->getTopicName().'.'.$message->getKey())) {
                         event(new $event($message->getBody()));
                     } else {
                         dump("no event found for {$message->getTopicName()}.{$message->getKey()}");
                     }
                 } catch (\Exception $e) {
                     dump('failed to dispatch an event for kafka message', $e);
                 }
             })
             ->build()
             ->consume();
    }
}
