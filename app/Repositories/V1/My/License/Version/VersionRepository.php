<?php

namespace App\Repositories\V1\My\License\Version;

use App\Models\Trader4\V1\License\Version;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use EloquentBuilder;

class VersionRepository extends AbstractRepository implements IVersionRepository
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
                'platform' => function($platform) {
                    return $platform->select(['id', 'title', 'slug', 'icon']);
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
        $version = $this->model->create($attributes);
        $version->load(['post', 'platform']);

        return $version;
    }


    protected function instance(array $attributes = []): Model
    {
        return new Version();
    }
}
