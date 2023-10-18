<?php

namespace App\Jobs\V1\Post;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;
use Exception;

class GetRelatedJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $uuid)
    {
        $this->repository = app()->make(IPostRepository::class);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        try {
            return $this->repository->related($this->uuid);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
