<?php

namespace App\Jobs\V1\Post\My;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;
use Illuminate\Http\Request;

class PostDeleteJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Request $request)
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
            $this->repository->deleteModel($post);

            return $post->id;
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
