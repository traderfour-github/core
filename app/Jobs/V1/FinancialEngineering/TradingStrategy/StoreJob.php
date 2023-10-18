<?php

namespace App\Jobs\V1\FinancialEngineering\TradingStrategy;

use App\Events\V1\TradingStrategy\StoreEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\ITradingStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreJob extends SyncJob
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
            $this->data['user_id'] = $this->userId;

            if ($tradingStrategy = $this->tradingStrategyRepository->create($this->data)) {
                event(new StoreEvent($tradingStrategy));
            }

            return $tradingStrategy->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
