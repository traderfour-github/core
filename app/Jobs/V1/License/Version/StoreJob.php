<?php

namespace App\Jobs\V1\License\Version;

use App\Events\V1\My\License\Version\StoreEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Version\IVersionRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreJob extends SyncJob
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
            $this->data['user_id'] = $this->userId;

            if ($version = $this->versionRepository->create($this->data)) {
                event(new StoreEvent($version));
            }

            return $version->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
