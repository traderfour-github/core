<?php

namespace App\Repositories\V1\My\License\Licensable;

use App\Models\Trader4\V1\License\Licensable;
use App\Models\Trader4\V1\Tag;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LicensableRepository extends AbstractRepository implements ILicensableRepository
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
                },
                'license' => function($license) {
                    return $license->select(['id', 'key_type', 'public_key']);
                },
                'tradingAccount' => function($tradingAccount){
                    return $tradingAccount->select(['id','name','identity','currency','balance','equity','status']);
                },
                'terminal' => function($terminal){
                    return $terminal->select(['id','name','assigned_by']);
                },
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
        $licensable = $this->model->create($attributes);

        if (array_key_exists('tag', $attributes)){
            $tag = Tag::firstOrCreate(['id' => $attributes['tag']]);
            $licensable->licensable_type = $tag->getMorphClass();
            $licensable->licensable_id = $tag->id;
            $licensable->save();
//            $licensable->licensable()->attach($tag->id);
        }

        $licensable->load(['post', 'version','terminal','license','tradingAccount','tag']);

        return $licensable;
    }

    public function updated(Model $model , array $attributes)
    {
        $model->fill($attributes)->save();

//        if (array_key_exists('tags', $attributes)) {
//            $model->tags()->sync($this->castStringAsArray($attributes['tags']));
//        }

        $model->load(['post', 'version','terminal','license','tradingAccount','tags']);

        return $model;
    }


    protected function castStringAsArray(string $string): array
    {
        return array_filter(explode(',', $string));
    }


    protected function instance(array $attributes = []): Model
    {
        return new Licensable();
    }
}
