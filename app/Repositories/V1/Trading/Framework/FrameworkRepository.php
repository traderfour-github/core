<?php

namespace App\Repositories\V1\Trading\Framework;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Database\Eloquent\Model;

class FrameworkRepository extends AbstractRepository implements IFrameworkRepository
{

    protected function instance(array $attributes = []): Model
    {
        return new Framework();
    }

    public function index(array $data) : LengthAwarePaginator
    {
        if (empty($data)) {
            return $this->model->withRelational()->where('public',true)->paginate();
        } else {
            return \EloquentBuilder::to($this->model, $data)->with([
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
            ])->where('public' , true)->paginate();
        }
    }

    public function show($uuid) : Model
    {
        return $this->model->withRelational()->findOrFail($uuid);
    }
}
