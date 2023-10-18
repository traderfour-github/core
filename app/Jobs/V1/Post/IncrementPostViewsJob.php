<?php

namespace App\Jobs\V1\Post;

use App\Jobs\V1\ASyncJob;
use App\Models\Trader4\V1\Post;
use App\Repositories\V1\Post\IPostRepository;
use Exception;

class IncrementPostViewsJob extends ASyncJob
{
    public IPostRepository $repository;

    public function __construct(private Post $post)
    {
        $this->repository = app()->make(IPostRepository::class);
    }

    public function handle()
    {
        try {
            $this->repository->increment($this->post, 'view_count');
        } catch (Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
