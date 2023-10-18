<?php

namespace App\Repositories\V1\Trading\Account;

use Illuminate\Pagination\LengthAwarePaginator;

interface IAccountRepository
{
    public function index(array $data) : LengthAwarePaginator;
    public function show(string $uuid);

}
