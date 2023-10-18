<?php

namespace App\Repositories\V1\Market\Market;

use App\Models\Trader4\V1\Market\Market;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class MarketRepository extends AbstractRepository
{

    public function list($data)
    {
        if (empty($data)) {
            return $this->model->onlyFirstLevel()->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->onlyFirstLevel()->paginate();
        }
    }

    public function read(string $uuid, array $data)
    {
        return $this->model->with('children')?->where('id', $uuid)?->firstOrFail();
    }

    protected function instance(array $attributes = []): Model
    {
        return new Market();
    }
}
