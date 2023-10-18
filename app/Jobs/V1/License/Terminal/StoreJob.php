<?php

namespace App\Jobs\V1\License\Terminal;

use App\Events\V1\My\License\Terminal\CreatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Exception;

class StoreJob extends SyncJob
{
    private ITerminalRepository $terminalRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $userId,
        private array $data
    ) {
        $this->terminalRepository = app()->make(ITerminalRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $this->data['user_id'] = $this->userId;

            if ($license = $this->terminalRepository->store($this->data)) {
                event(new CreatedEvent($license));
            }

            return $license->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
