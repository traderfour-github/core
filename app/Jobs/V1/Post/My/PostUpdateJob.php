<?php

namespace App\Jobs\V1\Post\My;

use App\Http\Requests\V1\Post\UpdatePostRequest;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;

class PostUpdateJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private UpdatePostRequest $request)
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
            $post = $this->repository->getUserPost($this->request->user()['uuid'], $this->request->uuid);

            return $this->repository->updateModel($post, $this->request->validated());
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
