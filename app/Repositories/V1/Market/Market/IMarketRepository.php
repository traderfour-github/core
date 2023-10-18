<?php

namespace App\Repositories\V1\Market\Market;

interface IMarketRepository
{
    public function index($data);
    public function single(string $uuid);
}
