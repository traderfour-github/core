<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\ICashFlowRepository;

class ShowJob extends SyncJob
{
    private ICashFlowRepository $cashFlowRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private string $id
    ) {
        $this->cashFlowRepository = app()->make(ICashFlowRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->cashFlowRepository->singleByUser($this->userId, $this->id);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
