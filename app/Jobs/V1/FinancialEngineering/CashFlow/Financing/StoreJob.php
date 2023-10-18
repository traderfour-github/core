<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Financing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;

class StoreJob extends SyncJob
{
    private ICashFlowFinancingRepository $cashFlowFinancingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data
    ) {
        $this->cashFlowFinancingRepository = app()->make(ICashFlowFinancingRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            return $this->cashFlowFinancingRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
