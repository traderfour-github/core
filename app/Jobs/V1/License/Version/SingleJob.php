<?php

namespace App\Jobs\V1\License\Version;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Version\IVersionRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
{
    private IVersionRepository $versionRepository;

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
            return $this->versionRepository->show($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
