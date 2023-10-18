<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaProduceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:producer {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Kafka producer for a topic';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $topic = $this->argument('topic');

        try {
            // for now, it is just working with static data for testing purposes.
            Kafka::publishOn($topic)
                ->withMessage(Message::create()
                    ->withKey('live-trading-account-update')
                    ->withBody([
                        'id' => '98ac0647-5131-4e1a-9ea8-4f9ab2230fe8',
                        'balance' => '4841',
                        'credit' => '58455',
                    ]))
                ->send();

            dump('--- message sent ---');
        } catch (\Exception $e) {
            dump('*** message was not sent ***');
        }
    }
}
