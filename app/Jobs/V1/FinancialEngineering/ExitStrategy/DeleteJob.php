<?php

namespace App\Jobs\V1\FinancialEngineering\ExitStrategy;

use App\Events\V1\ExitStrategy\DeleteEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
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
        public $exit_strategy_id
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
            $exitStrategy = $this->exitStrategyRepository->singleByUser($this->user_id, $this->exit_strategy_id);

            if ($this->exitStrategyRepository->deleteModel($exitStrategy)) {
                event(new DeleteEvent($exitStrategy));
            }

            return $exitStrategy->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
