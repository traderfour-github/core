<?php

namespace App\Jobs\V1\FinancialEngineering\RiskManagement;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
{
    private IRiskManagementRepository $riskManagementRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(private string $user_id, private string $id)
    {
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
            return $this->riskManagementRepository->singleByUser($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
