<?php

namespace App\Jobs\V1\FinancialEngineering\RiskManagement;

use App\Events\V1\RiskManagement\RiskManagementUpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private IRiskManagementRepository $riskManagementRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $userId,
        private array $data,
        private string $id,
    ) {
        $this->riskManagementRepository = app()->make(IRiskManagementRepository::class);
    }


    /**
     * @throws Exception
     */
    public function handle()
    {
        try {
            $riskManagement = $this->riskManagementRepository->singleByUser($this->userId, $this->id);

            if ($riskManagement = $this->riskManagementRepository->updateModel($riskManagement, $this->data)) {
                event(new RiskManagementUpdateEvent($riskManagement));
            }

            return $riskManagement;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
