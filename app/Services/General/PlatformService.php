<?php

namespace App\Services\General;

use App\Repositories\V1\Market\Platform\PlatformRepository;

class PlatformService
{
    public function __construct(
        private PlatformRepository $platformRepository
    ) {
    }

    public function platformList(array $data)
    {
        return $this->platformRepository->platformList($data);
    }

    public function read(string $uuid, array $data)
    {
        return $this->platformRepository->platformDetail($uuid, $data);
    }

    public function marketPlatforms(string $uuid)
    {
        return $this->platformRepository->marketPlatforms($uuid);
    }

    public function brokerPlatforms(string $uuid)
    {
        return $this->platformRepository->brokerPlatforms($uuid);
    }

    public function products(string $uuid)
    {
        return $this->platformRepository->products($uuid);
    }
}
