<?php

namespace App\Jobs\V1\FinancialEngineering\Entry;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
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
            return $this->entryRepository->indexByUser($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
