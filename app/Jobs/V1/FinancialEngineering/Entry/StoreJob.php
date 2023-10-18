<?php

namespace App\Jobs\V1\FinancialEngineering\Entry;

use App\Events\V1\Entry\StoreEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreJob extends SyncJob
{
    private IEntryRepository $entryRepository;

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
            $this->data['user_id'] = $this->userId;

            if ($entry = $this->entryRepository->create($this->data)) {
                event(new StoreEvent($entry));
            }

            return $entry->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
