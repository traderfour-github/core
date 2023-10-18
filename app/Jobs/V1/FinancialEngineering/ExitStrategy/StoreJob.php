<?php

namespace App\Jobs\V1\FinancialEngineering\ExitStrategy;

use App\Events\V1\ExitStrategy\StoreEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreJob extends SyncJob
{
    private IExitStrategyRepository $exitStrategyRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $userId,
        private array $data
    ) {
        $this->exitStrategyRepository = app()->make(IExitStrategyRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $this->data['user_id'] = $this->userId;

            if ($exitStrategy = $this->exitStrategyRepository->create($this->data)) {
                event(new StoreEvent($exitStrategy));
            }

            return $exitStrategy->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
