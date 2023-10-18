<?php

namespace App\Jobs\V1\License\Terminal;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
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
            return $this->terminalRepository->index($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
