<?php

namespace App\Jobs\V1\FinancialEngineering\Entry;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
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
        public $id
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
            return $this->entryRepository->singleByUser($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
