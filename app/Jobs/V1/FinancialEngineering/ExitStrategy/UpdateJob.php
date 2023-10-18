<?php

namespace App\Jobs\V1\FinancialEngineering\ExitStrategy;

use App\Events\V1\ExitStrategy\UpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private IExitStrategyRepository $exitStrategyRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        private string $user_id,
        private array $data,
        private string $id,
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
            $exitStrategy = $this->exitStrategyRepository->singleByUser($this->user_id, $this->id);

            if ($exitStrategy = $this->exitStrategyRepository->updateModel($exitStrategy, $this->data)) {
                event(new UpdateEvent($exitStrategy));
            }

            return $exitStrategy;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
