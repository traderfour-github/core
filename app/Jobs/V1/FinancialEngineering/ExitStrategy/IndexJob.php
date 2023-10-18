<?php

namespace App\Jobs\V1\FinancialEngineering\ExitStrategy;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
{
    private IExitStrategyRepository $exitStrategyRepository;

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
        $this->exitStrategyRepository = app()->make(IExitStrategyRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->exitStrategyRepository->indexByUser($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
