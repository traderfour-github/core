<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Financing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;

class DeleteJob extends SyncJob
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
     * @return void
     */
    public function handle()
    {
        try {
            $cashFlowFinancing = $this->cashFlowFinancingRepository->singleByUser($this->userId, $this->id);

            $this->cashFlowFinancingRepository->deleteModel($cashFlowFinancing);

            return $cashFlowFinancing->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
