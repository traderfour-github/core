<?php

namespace App\Repositories\V1\Trading\Account;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class AccountRepository extends AbstractRepository implements IAccountRepository
{
    public function index(array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->withRelational()->where('is_public',true)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->with([
                'broker' => function($broker){
                    return $broker->select(['id','name','logo']);
                },
                'market' => function($market){
                    return $market->select(['id','name','slug','icon']);
                },
                'platforms'=> function($platforms){
                    return $platforms ?? $platforms->select(['id','name','slug','icon']);
                },
                'tags'=> function($tags){
                    return $tags ?? $tags->select(['id','title','slug','icon']);
                },
            ])->where('is_public' , true)->paginate();
        }
    }

    public function show($uuid) : Model
    {
        return $this->model->withRelational()->findOrFail($uuid);
    }

    protected function instance(array $attributes = []): Model
    {
        return new Account();
    }
}
