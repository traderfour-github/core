<?php

namespace App\Jobs\V1\FinancialEngineering\CashFlow\Financing;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;

class UpdateJob extends SyncJob
{
    private ICashFlowFinancingRepository $cashFlowFinancingRepository;

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
        $this->cashFlowFinancingRepository = app()->make(ICashFlowFinancingRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            $cashFlowFinancing = $this->cashFlowFinancingRepository->singleByUser($this->userId, $this->id);

            return $this->cashFlowFinancingRepository->updateModel($cashFlowFinancing, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
