<?php

namespace App\Jobs\V1\FinancialEngineering\MoneyManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\IMoneyManagementRepository;

class ShowJob extends SyncJob
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
            $cashFlow = $this->moneyManagementRepository->findByUser($this->user_id, $this->uuid);

            return $cashFlow ?: null;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
