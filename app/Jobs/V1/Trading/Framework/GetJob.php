<?php

namespace App\Jobs\V1\Trading\Framework;

use App\Repositories\V1\Trading\Framework\IFrameworkRepository;
use App\Jobs\V1\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IFrameworkRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data ,
    ) {
        $this->repository = app()->make(IFrameworkRepository::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->repository->index($this->data);
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
