<?php

namespace App\Jobs\V1\FinancialEngineering\Entry;

use App\Events\V1\Entry\UpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private IEntryRepository $entryRepository;

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
        $this->entryRepository = app()->make(IEntryRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $entry = $this->entryRepository->singleByUser($this->user_id, $this->id);

            if ($entry = $this->entryRepository->updateModel($entry, $this->data)) {
                event(new UpdateEvent($entry));
            }

            return $entry;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
