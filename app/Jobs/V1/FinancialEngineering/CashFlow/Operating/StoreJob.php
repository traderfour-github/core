<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Operating;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\ICashFlowOperatingRepository;

class StoreJob extends SyncJob
{
    private ICashFlowOperatingRepository $cashFlowOperatingRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data
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
            return $this->cashFlowOperatingRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
