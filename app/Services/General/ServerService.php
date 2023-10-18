<?php

namespace App\Services\General;

use App\Repositories\V1\Market\Server\ServerRepository;

class ServerService
{
    public function __construct(
        private ServerRepository $repository
    ) {
    }

    public function read(string $id, array $data)
    {
        return $this->repository->show($id, $data);
    }

    public function brokerServers(string $broker_id, string $platform_id, ?string $user_id)
    {
        return $this->repository->brokerServers($broker_id, $platform_id, $user_id);
    }
}
