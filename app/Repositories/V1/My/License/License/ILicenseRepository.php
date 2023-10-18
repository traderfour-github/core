<?php

namespace App\Repositories\V1\My\License\License;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ILicenseRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator;
    public function show(string $userId ,string $uuid);
    public function store(array $attributes);
}
