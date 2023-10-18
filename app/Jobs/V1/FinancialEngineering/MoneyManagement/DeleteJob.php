<?php

namespace App\Jobs\V1\FinancialEngineering\MoneyManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\IMoneyManagementRepository;

class DeleteJob extends SyncJob
{
    private IMoneyManagementRepository $moneyManagementRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $user_id, private string $uuid)
    {
        $this->moneyManagementRepository = app()->make(IMoneyManagementRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            $moneyManagement = $this->moneyManagementRepository->findByUser($this->user_id, $this->uuid);
            $this->moneyManagementRepository->deleteModel($moneyManagement);

            return $moneyManagement->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
