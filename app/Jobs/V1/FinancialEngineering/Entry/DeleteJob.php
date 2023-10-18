<?php

namespace App\Jobs\V1\FinancialEngineering\Entry;

use App\Events\V1\Entry\DeleteEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private IEntryRepository $entryRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $entry_id
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
            $entry = $this->entryRepository->singleByUser($this->user_id, $this->entry_id);

            if ($this->entryRepository->deleteModel($entry)) {
                event(new DeleteEvent($entry));
            }

            return $entry->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
