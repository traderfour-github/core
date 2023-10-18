<?php

namespace App\Jobs\V1\License\Licensable;

use App\Events\V1\My\License\Licensable\DeletedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ILicensableRepository $licensableRepository;

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
            $license = $this->licensableRepository->show($this->user_id, $this->license_id);

            if ($this->licensableRepository->deleteModel($license)) {
                event(new DeletedEvent($license));
            }

            return $license->id;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
