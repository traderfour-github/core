<?php

namespace App\Repositories\V1\Market\Server;

use App\Models\Trader4\V1\Market\Server;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class ServerRepository extends AbstractRepository
{

    public function show(string $id, array $data)
    {
        $with = ['market', 'broker', 'platform'];
        if (empty($data)) {
            return $this->model->with($with)->where('id', $id)->firstOrFail();
        } else {
            return EloquentBuilder::to($this->model, $data)->with($with)->where('id', $id)->firstOrFail();
        }
    }

    public function brokerServers(string $broker_id, string $platform_id, ?string $user_id)
    {
        $query = $this->model->where('platform_id', $platform_id)->where('broker_id', $broker_id)->where('is_public', true);

        if ($user_id) {
            $query->orWhere('user_id', $user_id);
        }

        return $query->get();
    }

    protected function instance(array $attributes = []): Model
    {
        return new Server();
    }
}
