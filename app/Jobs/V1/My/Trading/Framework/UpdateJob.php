<?php

namespace App\Jobs\V1\My\Trading\Framework;

use App\Repositories\V1\My\Trading\Framework\FrameworkRepository;
use App\Events\V1\My\Trading\Framework\UpdatedEvent;
use App\Models\Trader4\V1\Trading\Framework;
use App\Jobs\V1\SyncJob;
use Exception;

class UpdateJob extends SyncJob
{
    private $repository;

    /**
     * @param  string  $uuid
     * @param  array  $data
     */
    public function __construct(
        private string $uuid,
        private array $data
    ) {
        $this->repository = new FrameworkRepository();
    }

    /**
     *
     * @return Framework
     * @throws Exception
     */
    public function handle() : Framework
    {
        try {
            $findFramework = $this->repository->findOneBy(['id' => $this->uuid]);

            $framework= $this->repository->transactional(
                fn() => $this->repository->updated($findFramework ,$this->data)
            );

            if($framework){
                UpdatedEvent::dispatch($framework);
                return $framework;
            }

            $this->exceptionHandler(throw new Exception('Failed to update trading account'));
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }
}
