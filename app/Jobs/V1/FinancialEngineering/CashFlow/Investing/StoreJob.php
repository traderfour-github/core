<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Investing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\ICashFlowInvestingRepository;

class StoreJob extends SyncJob
{
    private ICashFlowInvestingRepository $cashFlowInvestingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data
    ) {
        $this->cashFlowInvestingRepository = app()->make(ICashFlowInvestingRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            return $this->cashFlowInvestingRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
