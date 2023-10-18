<?php

namespace App\Jobs\V1\License\Licensable;

use App\Events\V1\My\License\Licensable\UpdatedEvent;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ILicensableRepository $licensableRepository;

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
            $license = $this->licensableRepository->show($this->user_id, $this->id);

            if ($license = $this->licensableRepository->updated($license, $this->data)) {
                event(new UpdatedEvent($license));
            }

            return $license;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
