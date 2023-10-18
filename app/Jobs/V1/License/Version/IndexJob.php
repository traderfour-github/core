<?php

namespace App\Jobs\V1\License\Version;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Version\IVersionRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
{
    private IVersionRepository $versionRepository;

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
        $this->versionRepository = app()->make(IVersionRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->versionRepository->index($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
