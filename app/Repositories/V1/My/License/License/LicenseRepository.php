<?php

namespace App\Repositories\V1\My\License\License;

use App\Models\Trader4\V1\License\License;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LicenseRepository extends AbstractRepository implements ILicenseRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->withRelational()->where('user_id', $userId)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->with([
                'post' => function($post){
                    return $post->select(['id','title','slogan','type','status','published_at']);
                },
                'version' => function($version) {
                    return $version->select(['id', 'title', 'signature']);
                }
            ])->where('user_id', $userId)->paginate();
        }
    }

    public function show(string $userId ,$uuid) : Model
    {
        return $this->model->withRelational()->where([
            'id' => $uuid ,
            'user_id' => $userId
        ])->first();
    }

    public function store(array $attributes = []) : Model
    {
        $license = $this->model->create($attributes);
        $license->load(['post', 'version']);

        return $license;
    }


    protected function instance(array $attributes = []): Model
    {
        return new License();
    }
}
