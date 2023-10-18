<?php

namespace App\Jobs\V1\Market\Server;

use App\Jobs\V1\SyncJob;
use App\Repositories\V1\Market\Platform\PlatformRepository;
use App\Repositories\V1\Market\Server\ServerRepository;

class StoreServerJob extends SyncJob
{
    public function __construct(private array $data, private string $userId)
    {
        //
    }

    public function handle(ServerRepository $serverRepository, PlatformRepository $platformRepository)
    {
        $platform = $platformRepository->find($this->data['platform_id']);
        $this->data['market_id'] = $platform->market_id;
        $this->data['broker_id'] = $platform->broker_id;
        $this->data['user_id'] = $this->userId;

        try {
            return $serverRepository->create($this->data)->refresh();
        } catch (\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
