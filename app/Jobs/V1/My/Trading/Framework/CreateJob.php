<?php

namespace App\Jobs\V1\My\Trading\Framework;

use App\Repositories\V1\My\Trading\Framework\FrameworkRepository;
use App\Events\V1\My\Trading\Framework\CreatedEvent;
use App\Enums\V1\Trading\Account\StatusesEnum;
use App\Jobs\V1\SyncJob;
use Exception;

class CreateJob extends SyncJob
{
    private $repository;

    /**
     * @param  string  $userId
     * @param  array  $data
     */
    public function __construct(
        private string $userId,
        private array $data
    ) {
        $this->repository = new FrameworkRepository();
    }

    /**
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $this->data['user_id'] = $this->userId;
            $this->data['status'] = StatusesEnum::Registered->value;
            $framework = $this->repository->transactional(fn() => $this->repository->store($this->data));

            if($framework){
                CreatedEvent::dispatch($framework);
                return $framework;
            }
            $this->exceptionHandler(throw new Exception('Failed to create trading account'));
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
