<?php

namespace App\Jobs\V1\License\Licensable;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class IndexJob extends SyncJob
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
            return $this->licensableRepository->index($this->userId, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
