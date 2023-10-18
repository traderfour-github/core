<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Operating;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\ICashFlowOperatingRepository;

class DeleteJob extends SyncJob
{
    private ICashFlowOperatingRepository $cashFlowOperatingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private string $id
    ) {
        $this->cashFlowOperatingRepository = app()->make(ICashFlowOperatingRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $cashFlowOperating = $this->cashFlowOperatingRepository->singleByUser($this->userId, $this->id);

            $this->cashFlowOperatingRepository->deleteModel($cashFlowOperating);

            return $cashFlowOperating->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
