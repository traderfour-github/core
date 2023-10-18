<?php

namespace App\Jobs\V1\Post;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;
use Exception;

class ShowJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $slogan)
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
            $post = $this->repository->show($this->slogan);

            dispatch(new IncrementPostViewsJob($post));

            return $post;
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
