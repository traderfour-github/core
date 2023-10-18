<?php

namespace App\Jobs\V1\My\Trading\Framework;

use App\Repositories\V1\My\Trading\Framework\IFrameworkRepository;
use App\Models\Trader4\V1\Trading\Framework;
use App\Jobs\V1\SyncJob;
use Exception;

class ReadJob extends SyncJob
{
    private IFrameworkRepository $repository;

    /**
     * @param  string  $userId
     * @param  string  $uuid
     */
    public function __construct(
        private string $userId,
        private string $uuid ,
    ) {
        $this->repository = app()->make(IFrameworkRepository::class);
    }

    /**
     *
     * @return Framework
     * @throws Exception
     */
    public function handle() : Framework
    {
        try {
            return $this->repository->show($this->userId ,$this->uuid);
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
