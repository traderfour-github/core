<?php

namespace App\Jobs\V1\FinancialEngineering\RiskManagement;

use App\Events\V1\RiskManagement\RiskManagementCreatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class StoreJob extends SyncJob
{
    private IRiskManagementRepository $riskManagementRepository;

    /**
     * @param  string  $userId
     * @param  array  $data
     *
     * @throws BindingResolutionException
     */
    public function __construct(private string $userId, public array $data)
    {
        $this->riskManagementRepository = app()->make(IRiskManagementRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle(): Model
    {
        try {
            $this->data['user_id'] = $this->userId;

            if ($trading_plan = $this->riskManagementRepository->create($this->data)) {
                event(new RiskManagementCreatedEvent($trading_plan));
            }

            return $trading_plan->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
