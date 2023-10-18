<?php

namespace App\Jobs\V1\FinancialEngineering\TradingPlan;

use App\Events\V1\TradingPlan\StoreEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreJob extends SyncJob
{
    private ITradingPlanRepository $tradingPlanRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(private string $user_id, public array $data)
    {
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
            $this->data['user_id'] = $this->user_id;

            if ($trading_plan = $this->tradingPlanRepository->create($this->data)) {
                event(new StoreEvent($trading_plan));
            }

            return $trading_plan->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
