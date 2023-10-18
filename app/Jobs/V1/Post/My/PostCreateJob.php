<?php

namespace App\Jobs\V1\Post\My;

use App\Enums\V1\Post\Type;
use App\Http\Requests\V1\Post\CreatePostRequest;
use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Post\IPostRepository;

class PostCreateJob extends SyncJob
{
    public IPostRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private CreatePostRequest $request)
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
            $data = $this->request->validated();
            $data['user_id'] = $this->request->user()['uuid'];
            $data['type'] = Type::ARTICLE;
            $slogan = $this->sloganGenerator($data['title']);
            if (array_key_exists('slogan', $data) && !empty($data['slogan'])){
                $slogan = $this->sloganGenerator($data['slogan']);
            }
            $data['slogan'] = $slogan;
            return $this->repository->create($data);
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }

    /**
     * @param  string  $title
     * @param  bool  $regenerate
     *
     * @return string
     */
    private function sloganGenerator(string $title): string
    {
        $slogan = strtolower(str_replace(' ', '-', $title));
        $post = $this->repository->exists($slogan);
        if ($post !== null){
            $ex = explode('-', $post->slogan);
            $lastNumber = end($ex);
            if(!is_numeric($lastNumber)){
                $slogan = $post->slogan. '-1';
            } else{
                $sloganText = preg_replace ( '/-[0-9]*$/' , '' , $post->slogan);
                $slogan = $sloganText . '-' . $lastNumber+1;
            }
        }
        return $slogan;
    }
}
