<?php

namespace App\Jobs\V1\Trading\Account;

use App\Repositories\V1\Trading\Account\IAccountRepository;
use App\Models\Trader4\V1\Trading\Account;
use App\Jobs\V1\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param  array  $data
     */
    public function __construct(
        private array $data ,
    ) {
        $this->repository = app()->make(IAccountRepository::class);
    }

    /**
     *
     * @return Account
     * @throws Exception
     */
    public function handle()
    {
        try {
            return $this->repository->index($this->data);
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
