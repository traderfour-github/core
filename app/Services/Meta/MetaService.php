<?php

namespace App\Services\Meta;


use App\Repositories\V1\Meta\MetaRepository;
use Illuminate\Database\Eloquent\Model;

class MetaService
{

    public function __construct(
        private MetaRepository $repository
    )
    {
    }

    public function set(Model $model, array $metas){
        foreach ($metas as $key => $val){
            $meta['key'] = $key;
            $meta['value'] = $val;
            $meta['metaable_id'] = $model->id;
            $meta['metaable_type'] = get_class($model);
            $this->repository->updateOrCreate(['key' => $meta['key']], $meta);
        }
    }

}
