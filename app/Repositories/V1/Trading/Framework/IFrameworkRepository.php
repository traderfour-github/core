<?php

namespace App\Repositories\V1\Trading\Framework;

use Illuminate\Pagination\LengthAwarePaginator;

interface IFrameworkRepository
{
    public function index(array $data) : LengthAwarePaginator;
    public function show(string $uuid);
}
