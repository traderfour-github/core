<?php

namespace App\Jobs\V1\FinancialEngineering\ExitStrategy;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
{
    private IExitStrategyRepository $exitStrategyRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $id
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
            return $this->exitStrategyRepository->singleByUser($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
