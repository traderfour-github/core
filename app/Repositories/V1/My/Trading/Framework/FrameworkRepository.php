<?php

namespace App\Repositories\V1\My\Trading\Framework;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Database\Eloquent\Model;
use EloquentBuilder;

class FrameworkRepository extends AbstractRepository implements IFrameworkRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->withRelational()->where('user_id', $userId)->paginate();
        } else {
            return EloquentBuilder::to($this->model, $data)->with([
                'tradingAccount' => function($tradingAccount){
                    return $tradingAccount->select(['id','name','identity']);
                },
                'market' => function($market){
                    return $market->select(['id','name','slug','icon']);
                },
                'riskManagement'=> function($riskManagement){
                    return $riskManagement->select(['id','title']);
                },
                'tradingPlan'=> function($tradingPlan){
                    return $tradingPlan ?? $tradingPlan->select(['id','instruments']);
                },
                'moneyManagement'=> function($moneyManagement){
                    return $moneyManagement ?? $moneyManagement->select(['id','title']);
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
        $framework = $this->model->create($attributes);
        $framework->load(['tradingAccount', 'market', 'riskManagement','tradingPlan','moneyManagement']);

        return $framework;
    }

    public function updated(Model $model , array $attributes)
    {
        $model->fill($attributes)->save();

        $model->load(['tradingAccount', 'market', 'riskManagement','tradingPlan','moneyManagement']);

        return $model;
    }

    public function destroy($uuid): ?string
    {
        return $this->delete($uuid);
    }

    protected function instance(array $attributes = []): Model
    {
        return new Framework();
    }
}
