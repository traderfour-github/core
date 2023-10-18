<?php

namespace App\Jobs\V1\FinancialEngineering\MoneyManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\IMoneyManagementRepository;

class StoreJob extends SyncJob
{
    private IMoneyManagementRepository $moneyManagementRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $userId, public array $data)
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
            $this->data['user_id'] = $this->userId;

            return $this->moneyManagementRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
