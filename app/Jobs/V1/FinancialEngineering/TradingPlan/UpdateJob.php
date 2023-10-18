<?php

namespace App\Jobs\V1\FinancialEngineering\TradingPlan;

use App\Events\V1\TradingPlan\UpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ITradingPlanRepository $tradingPlanRepository;

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
        $this->tradingPlanRepository = app()->make(ITradingPlanRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $trading_plan = $this->tradingPlanRepository->singleByUser($this->user_id, $this->id);

            if ($trading_plan = $this->tradingPlanRepository->updateModel($trading_plan, $this->data)) {
                event(new UpdateEvent($trading_plan));
            }

            return $trading_plan;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
