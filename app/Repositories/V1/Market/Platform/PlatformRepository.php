<?php

namespace App\Repositories\V1\Market\Platform;

use App\Models\Trader4\V1\Market\Platform;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class PlatformRepository extends AbstractRepository
{
    public function platformList(array $data)
    {
        if (empty($data)) {
            return $this->model->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->paginate();
        }
    }

    public function platformDetail(string $uuid, array $data)
    {
        if (empty($data)) {
            return $this->model->where('id', $uuid)->firstOrFail();
        } else {
            return EloquentBuilder::to($this->model, $data)->where('id', $uuid)->firstOrFail();
        }
    }

    public function marketPlatforms(string $uuid)
    {
        return $this->model->where('market_id', $uuid)->paginate();
    }

    public function brokerPlatforms(string $uuid)
    {
        return $this->model->where('broker_id', $uuid)->paginate();
    }

    public function products(string $uuid)
    {
        return $this->findOrFail($uuid)->products;
    }

    protected function instance(array $attributes = []): Model
    {
        return new Platform();
    }
}
