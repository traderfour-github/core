<?php

namespace App\Jobs\V1\FinancialEngineering\MoneyManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\IMoneyManagementRepository;

class IndexJob extends SyncJob
{
    private IMoneyManagementRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $userId, private array $data)
    {
        $this->repository = app()->make(IMoneyManagementRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->repository->all($this->userId, $this->data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
