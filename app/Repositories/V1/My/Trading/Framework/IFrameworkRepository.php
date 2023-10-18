<?php

namespace App\Repositories\V1\My\Trading\Framework;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IFrameworkRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator;
    public function show(string $userId ,string $uuid);
    public function store(array $attributes);
    public function updated(Model $model , array $attributes);
    public function destroy(string $uuid);

}
