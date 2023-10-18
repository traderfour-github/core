<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\ICashFlowRepository;

class DeleteJob extends SyncJob
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
            $cashFlow = $this->cashFlowRepository->singleByUser($this->userId, $this->id);

            $this->cashFlowRepository->deleteModel($cashFlow);

            return $cashFlow->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
