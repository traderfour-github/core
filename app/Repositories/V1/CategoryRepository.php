<?php

namespace App\Repositories\V1;

use App\Models\Trader4\V1\Category;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends AbstractRepository
{

    public function categoryList($data)
    {
        return EloquentBuilder::to($this->model, $data)->whereNull('parent_id')->get();
    }

//    public function categoryDetail(string $uuid)
//    {
//        return $this->model->where('id',$uuid)->first();
//    }

    public function children(string $uuid)
    {
        return $this->findOrFail($uuid)->children;
    }

    public function products(string $uuid)
    {
        return $this->find($uuid)->products;
    }

    protected function instance(array $attributes = []): Model
    {
        return new Category();
    }
}
