<?php

namespace App\Jobs\V1\My\Trading\Framework;

use App\Repositories\V1\My\Trading\Framework\IFrameworkRepository;
use App\Jobs\V1\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IFrameworkRepository $repository;

    /**
     * @param  string  $userId
     * @param  array  $data
     */
    public function __construct(
        private string $userId,
        private array $data ,
    ) {
        $this->repository = app()->make(IFrameworkRepository::class);
    }

    /**
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->repository->index($this->userId , $this->data);
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
