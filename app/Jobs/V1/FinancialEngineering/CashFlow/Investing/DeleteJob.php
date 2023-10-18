<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Investing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\ICashFlowInvestingRepository;

class DeleteJob extends SyncJob
{
    private ICashFlowInvestingRepository $cashFlowInvestingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private string $id
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
            $cashFlowInvesting = $this->cashFlowInvestingRepository->singleByUser($this->userId, $this->id);

            $this->cashFlowInvestingRepository->deleteModel($cashFlowInvesting);

            return $cashFlowInvesting->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
