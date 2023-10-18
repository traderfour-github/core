<?php

namespace App\Repositories\V1\Meta;

use App\Models\Trader4\V1\Meta;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class MetaRepository extends AbstractRepository
{

    protected function instance(array $attributes = []): Model
    {
        return new Meta();
    }

}
