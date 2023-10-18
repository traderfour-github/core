<?php

namespace App\Jobs\V1\License\License;

use App\Events\V1\My\License\License\DeletedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\License\ILicenseRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ILicenseRepository $licenseRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        public $user_id,
        public $license_id
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
            $license = $this->licenseRepository->show($this->user_id, $this->license_id);

            if ($this->licenseRepository->deleteModel($license)) {
                event(new DeletedEvent($license));
            }

            return $license->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
