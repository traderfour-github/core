<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Investing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\ICashFlowInvestingRepository;

class UpdateJob extends SyncJob
{
    private ICashFlowInvestingRepository $cashFlowInvestingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private array $data,
        private string $id,
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
            $cashFlowInvesting = $this->cashFlowInvestingRepository->singleByUser($this->userId, $this->id);

            return $this->cashFlowInvestingRepository->updateModel($cashFlowInvesting, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
