<?php

namespace App\Jobs\V1\License\License;

use App\Events\V1\My\License\License\UpdatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\License\ILicenseRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ILicenseRepository $licenseRepository;

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
        $this->licenseRepository = app()->make(ILicenseRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $license = $this->licenseRepository->show($this->user_id, $this->id);

            if ($license = $this->licenseRepository->updateModel($license, $this->data)) {
                event(new UpdatedEvent($license));
            }

            return $license;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
