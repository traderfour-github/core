<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Operating;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\ICashFlowOperatingRepository;

class IndexJob extends SyncJob
{
    private ICashFlowOperatingRepository $cashFlowOperatingRepository;

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
        $this->cashFlowOperatingRepository = app()->make(ICashFlowOperatingRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->cashFlowOperatingRepository->indexByUser($this->userId, $this->cashFlowId, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
