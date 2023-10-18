<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Financing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;

class IndexJob extends SyncJob
{
    private ICashFlowFinancingRepository $cashFlowFinancingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private string $cashFlowId,
        private array $data
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
            return $this->cashFlowFinancingRepository->indexByUser($this->userId, $this->cashFlowId, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
