<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\ICashFlowRepository;

class StoreJob extends SyncJob
{
    private ICashFlowRepository $cashFlowRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $userId,
        private array $data
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
            $this->data['user_id'] = $this->userId;

            return $this->cashFlowRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
