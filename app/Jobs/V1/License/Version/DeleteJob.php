<?php

namespace App\Jobs\V1\License\Version;

use App\Events\V1\My\License\Version\DeleteEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Version\IVersionRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
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
        public $version_id
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
            $version = $this->versionRepository->show($this->user_id, $this->version_id);

            if ($this->versionRepository->deleteModel($version)) {
                event(new DeleteEvent($version));
            }

            return $version->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
