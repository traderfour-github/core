<?php

namespace App\Jobs\V1\License\Licensable;

use App\Events\V1\My\License\Licensable\CreatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Exception;

class StoreJob extends SyncJob
{
    private ILicensableRepository $licensableRepository;

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
        $this->licensableRepository = app()->make(ILicensableRepository::class);
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

            if ($license = $this->licensableRepository->store($this->data)) {
                event(new CreatedEvent($license));
            }

            return $license->refresh();
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
