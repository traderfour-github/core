<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Financing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;

class ShowJob extends SyncJob
{
    private ICashFlowFinancingRepository $cashFlowFinancingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private string $id
    ) {
        $this->cashFlowFinancingRepository = app()->make(ICashFlowFinancingRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->cashFlowFinancingRepository->singleByUser($this->userId, $this->id);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
