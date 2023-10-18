<?php

namespace App\Jobs\V1\FinancialEngineering\TradingStrategy;

use App\Events\V1\TradingStrategy\UpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\ITradingStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ITradingStrategyRepository $tradingStrategyRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $user_id,
        private array $data,
        private string $id,
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
            $tradingStrategy = $this->tradingStrategyRepository->singleByUser($this->user_id, $this->id);

            if ($tradingStrategy = $this->tradingStrategyRepository->updateModel($tradingStrategy, $this->data)) {
                event(new UpdateEvent($tradingStrategy));
            }

            return $tradingStrategy;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
