<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Investing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\ICashFlowInvestingRepository;

class IndexJob extends SyncJob
{
    private ICashFlowInvestingRepository $cashFlowInvestingRepository;

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
        $this->cashFlowInvestingRepository = app()->make(ICashFlowInvestingRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->cashFlowInvestingRepository->indexByUser($this->userId, $this->cashFlowId, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
