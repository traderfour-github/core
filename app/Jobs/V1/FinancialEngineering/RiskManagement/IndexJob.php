<?php

namespace App\Jobs\V1\FinancialEngineering\RiskManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
{
    private IRiskManagementRepository $riskManagementRepository;

    /**
     * Create a new job instance.
     *
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $userId,
        public array $data
    ) {
        $this->riskManagementRepository = app()->make(IRiskManagementRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->riskManagementRepository->indexByUser($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
