<?php

namespace App\Repositories\V1\My\License\Version;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IVersionRepository
{
    public function index(string $userId , array $data) : LengthAwarePaginator;
    public function show(string $userId ,string $uuid);
    public function store(array $attributes);}
