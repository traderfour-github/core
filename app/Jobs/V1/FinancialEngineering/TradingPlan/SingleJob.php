<?php

namespace App\Jobs\V1\FinancialEngineering\TradingPlan;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
{
    private ITradingPlanRepository $tradingPlanRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(public $user_id, public $id)
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
            return $this->tradingPlanRepository->singleByUser($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
