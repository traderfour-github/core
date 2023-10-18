<?php

namespace App\Jobs\V1\FinancialEngineering\TradingStrategy;

use App\Events\V1\TradingStrategy\DeleteEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\ITradingStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ITradingStrategyRepository $tradingStrategyRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $trading_strategy_id
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
            $tradingStrategy = $this->tradingStrategyRepository->singleByUser($this->user_id, $this->trading_strategy_id);

            if ($this->tradingStrategyRepository->deleteModel($tradingStrategy)) {
                event(new DeleteEvent($tradingStrategy));
            }

            return $tradingStrategy->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
