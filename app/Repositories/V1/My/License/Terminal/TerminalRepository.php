<?php

namespace App\Repositories\V1\My\License\Terminal;

use App\Models\Trader4\V1\License\Terminal;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use EloquentBuilder;

class TerminalRepository extends AbstractRepository implements ITerminalRepository
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
        $terminal = $this->model->create($attributes);
        $terminal->load(['tradingAccount']);

        return $terminal;
    }


    protected function instance(array $attributes = []): Model
    {
        return new Terminal();
    }
}
