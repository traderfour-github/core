<?php

namespace App\Jobs\V1\FinancialEngineering\TradingPlan;

use App\Events\V1\TradingPlan\DeleteEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ITradingPlanRepository $tradingPlanRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $trading_plan_id
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
            $trading_plan = $this->tradingPlanRepository->singleByUser($this->user_id, $this->trading_plan_id);

            if ($this->tradingPlanRepository->deleteModel($trading_plan)) {
                event(new DeleteEvent($trading_plan));
            }

            return $trading_plan->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
