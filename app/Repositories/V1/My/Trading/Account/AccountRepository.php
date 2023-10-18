<?php

namespace App\Repositories\V1\My\Trading\Account;

use App\Models\Trader4\V1\Tag;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class AccountRepository extends AbstractRepository implements IAccountRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->withRelational()->where('user_id', $userId)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->with([
                'broker' => function($broker){
                    return $broker->select(['id','name','logo']);
                },
                'market' => function($market){
                    return $market->select(['id','name','slug','icon']);
                },
                'platform'=> function($platform){
                    return $platform ?? $platform->select(['id','name','slug','icon']);
                },
                'tags'=> function($tags){
                    return $tags ?? $tags->select(['id','title','slug','icon']);
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
        $tradingAccount = $this->model->create($attributes);
        if (array_key_exists('tags', $attributes)){
            foreach ($attributes['tags'] as $tag){
                $tag = Tag::firstOrCreate(['id' => $tag]);
                $tradingAccount->tags()->attach($tag->id);
            }
        }

        $tradingAccount->load(['broker', 'market', 'platform','tags']);
        return $tradingAccount;
    }

    public function updated(Model $model , array $attributes)
    {
        $model->fill($attributes)->save();

        if (array_key_exists('platforms', $attributes)) {
            $model->platforms()->sync($this->castStringAsArray($attributes['platforms']));
        }

        if (array_key_exists('tags', $attributes)) {
            $model->tags()->sync($this->castStringAsArray($attributes['tags']));
        }

        $model->load(['broker', 'market', 'platforms','tags']);

        return $model;
    }

    public function destroy($uuid): ?string
    {
        $account = $this->model->query()->findOrFail($uuid);
        $account->tags()->detach();
        $account->platforms()->detach();

        return $this->delete($uuid);
    }

    protected function castStringAsArray(string $string): array
    {
        return array_filter(explode(',', $string));
    }

    protected function instance(array $attributes = []): Model
    {
        return new Account();
    }
}
