<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Operating;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\ICashFlowOperatingRepository;

class ShowJob extends SyncJob
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
     */
    public function handle()
    {
        try {
            return $this->cashFlowOperatingRepository->singleByUser($this->userId, $this->id);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
