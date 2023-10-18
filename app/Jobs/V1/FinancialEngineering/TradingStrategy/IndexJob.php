<?php

namespace App\Jobs\V1\FinancialEngineering\TradingStrategy;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\ITradingStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
{
    private ITradingStrategyRepository $tradingStrategyRepository;

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
        $this->tradingStrategyRepository = app()->make(ITradingStrategyRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->tradingStrategyRepository->indexByUser($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
