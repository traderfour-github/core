<?php

namespace App\Jobs\V1\My\Trading\Framework;

use App\Repositories\V1\My\Trading\Framework\IFrameworkRepository;
use App\Events\V1\My\Trading\Account\DeletedEvent;
use App\Jobs\V1\SyncJob;
use Exception;

class DeleteJob extends SyncJob
{
    private IFrameworkRepository $repository;

    /**
     * @param  string  $frameworkId
     */
    public function __construct(
        private string $frameworkId
    ) {
        $this->repository = app()->make(IFrameworkRepository::class);
    }

    /**
     *
     * @return string
     * @throws Exception
     */
    public function handle(): string
    {
        try {
            $this->repository->destroy($this->frameworkId);
            DeletedEvent::dispatch($this->frameworkId);
            return $this->frameworkId;
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
