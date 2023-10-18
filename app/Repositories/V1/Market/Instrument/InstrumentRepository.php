<?php

namespace App\Repositories\V1\Market\Instrument;

use App\Models\Trader4\V1\Market\Instrument;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class InstrumentRepository extends AbstractRepository
{
    public function read(string $uuid, array $data)
    {
        $with = ['server', 'broker', 'platform'];
        if (empty($data)) {
            return $this->model->with($with)->where('id', $uuid)->firstOrFail();
        } else {
            return EloquentBuilder::to($this->model, $data)->with($with)->where('id', $uuid)->firstOrFail();
        }
    }

    public function serverInstruments(string $server_id)
    {
        return $this->model->where('server_id', $server_id)->paginate();
    }

    protected function instance(array $attributes = []): Model
    {
        return new Instrument();
    }
}
