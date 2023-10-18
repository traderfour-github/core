<?php

namespace App\Jobs\V1\FinancialEngineering\RiskManagement;

use App\Events\V1\RiskManagement\RiskManagementDeletedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private IRiskManagementRepository $riskManagementRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $risk_management_id
    ) {
        $this->riskManagementRepository = app()->make(IRiskManagementRepository::class);
    }

    /**
     * @throws Exception
     */
    public function handle()
    {
        try {
            $risk_management = $this->riskManagementRepository->singleByUser($this->user_id, $this->risk_management_id);

            if ($this->riskManagementRepository->deleteModel($risk_management)) {
                event(new RiskManagementDeletedEvent($risk_management));
            }

            return $risk_management->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
