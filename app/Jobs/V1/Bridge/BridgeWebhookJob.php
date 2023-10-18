<?php

namespace App\Jobs\V1\Bridge;

use App\Events\V1\Bridge\WebhookEvent;
use App\Services\Bridges\Webhooks\TransformerWebhookService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class BridgeWebhookJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     * @param  array  $data
     */
    public function __construct(
        private array $data
    )
    {
    }

    /**
     * Execute the job.
     *
     */
    public function handle(TransformerWebhookService $transformerWebhookService)
    {
        try {

            $webhookData = $transformerWebhookService->perform(
                $this->data
            );

            Kafka::publishOn('commands')
                 ->withMessage(Message::create()
                  ->withKey('bridge-webhook')->withBody($webhookData))
            ->send();

            event(new WebhookEvent($webhookData));

            return $webhookData;

        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }
}
