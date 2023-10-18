<?php

namespace App\Repositories\V1\Market\Broker;

use App\Models\Trader4\V1\Market\Broker;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class BrokerRepository extends AbstractRepository
{
    public function list($data)
    {
        if (empty($data)) {
            return $this->model->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->paginate();
        }
    }

    public function read(string $uuid, array $data)
    {
        if (empty($data)) {
            return $this->model->where('id', $uuid)->firstOrFail();
        } else {
            return EloquentBuilder::to($this->model, $data)->where('id', $uuid)->firstOrFail();
        }
    }

    protected function instance(array $attributes = []): Model
    {
        return new Broker();
    }
}
