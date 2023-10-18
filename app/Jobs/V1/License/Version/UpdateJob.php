<?php

namespace App\Jobs\V1\License\Version;

use App\Events\V1\My\License\Version\UpdateEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Version\IVersionRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private IVersionRepository $versionRepository;

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
            $version = $this->versionRepository->show($this->user_id, $this->id);

            if ($version = $this->versionRepository->updateModel($version, $this->data)) {
                event(new UpdateEvent($version));
            }

            return $version;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
