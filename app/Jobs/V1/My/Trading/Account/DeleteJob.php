<?php

namespace App\Jobs\V1\My\Trading\Account;

use App\Repositories\V1\My\Trading\Account\IAccountRepository;
use App\Events\V1\My\Trading\Account\DeletedEvent;
use App\Jobs\V1\SyncJob;
use Exception;

class DeleteJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param  string  $accountId
     */
    public function __construct(
        private string $accountId
    ) {
        $this->repository = app()->make(IAccountRepository::class);
    }

    /**
     *
     * @return string
     * @throws Exception
     */
    public function handle(): string
    {
        try {
            $this->repository->destroy($this->accountId);
            DeletedEvent::dispatch($this->accountId);
            return $this->accountId;
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
