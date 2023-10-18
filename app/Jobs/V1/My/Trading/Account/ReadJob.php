<?php

namespace App\Jobs\V1\My\Trading\Account;

use App\Repositories\V1\My\Trading\Account\IAccountRepository;
use App\Models\Trader4\V1\Trading\Account;
use App\Jobs\V1\SyncJob;
use Exception;

class ReadJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param  string  $userId
     * @param  string  $uuid
     */
    public function __construct(
        private string $userId,
        private string $uuid ,
    ) {
        $this->repository = app()->make(IAccountRepository::class);
    }

    /**
     *
     * @return Account
     * @throws Exception
     */
    public function handle() : Account
    {
        try {
            return $this->repository->show($this->userId ,$this->uuid);
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
