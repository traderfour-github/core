<?php

namespace App\Jobs\V1\License\Licensable;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository ;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
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
        public $id
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
            return $this->licensableRepository->show($this->user_id, $this->id);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
