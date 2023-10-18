<?php

namespace App\Services\General;

use App\Repositories\V1\Market\Market\MarketRepository;

class MarketService
{
    public function __construct(private MarketRepository $repository) {
    }

    public function list(array $data)
    {
        return $this->repository->list($data);
    }

    public function read(string $id, array $data)
    {
        return $this->repository->read($id, $data);
    }

}
