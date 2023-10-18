<?php

namespace App\Jobs\V1\Post\My;

use App\Jobs\V1\Post\IncrementPostViewsJob;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;
use Exception;

class PostShowJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $user_id, private string $uuid)
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
            $post = $this->repository->getUserPost($this->user_id, $this->uuid);

            dispatch(new IncrementPostViewsJob($post));

            return $post;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
