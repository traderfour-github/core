<?php

namespace App\Repositories\V1\Post;

use Illuminate\Pagination\LengthAwarePaginator;

interface IPostRepository
{
    public function index(array $data): LengthAwarePaginator;
    public function show(string $slogan);
    public function exists(string $slogan);
    public function getUserPost($user_id, string $uuid);
    public function getUserPostsList($user_id, array $data = null): LengthAwarePaginator;
    public function related(string $uuid): LengthAwarePaginator;
    public function getPostsByCategoryId(string $uuid): LengthAwarePaginator;
    public function getPostsByTagId(string $uuid): LengthAwarePaginator;
    public function syncPopularityScores(): bool;
}
