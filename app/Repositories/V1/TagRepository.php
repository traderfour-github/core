<?php

namespace App\Repositories\V1;

use App\Models\Trader4\V1\Tag;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends AbstractRepository
{

    public function tagList(array $data)
    {
        return EloquentBuilder::to($this->model, $data)->withCount('products')->orderByDesc('products_count')->get();
    }

    public function tagDetail(string $uuid)
    {
        return $this->model->where('id',$uuid)->firstOrFail();
    }

    public function products(string $uuid)
    {
        return $this->find($uuid)->products;
    }

    protected function instance(array $attributes = []): Model
    {
        return new Tag();
    }
}
