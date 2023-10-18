<?php

namespace App\Jobs\V1\Post\My;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;
use Exception;

use function Sentry\captureException;

class PostIndexJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $user_id, private array $data)
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
            return $this->repository->getUserPostsList($this->user_id, $this->data);
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
