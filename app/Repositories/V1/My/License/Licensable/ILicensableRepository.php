<?php

namespace App\Repositories\V1\My\License\Licensable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ILicensableRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator;
    public function show(string $userId ,string $uuid);
    public function updated(Model $model , array $attributes);
    public function store(array $attributes);
}
