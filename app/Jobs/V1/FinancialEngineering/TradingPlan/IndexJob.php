<?php

namespace App\Jobs\V1\FinancialEngineering\TradingPlan;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
{
    private ITradingPlanRepository $tradingPlanRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(private string $userId, private array $data)
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
            return $this->tradingPlanRepository->indexByUser($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
