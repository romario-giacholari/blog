<?php

namespace App\Services\Post;

use App\Entities\Post\PostEntity;
use App\Post;
use Illuminate\Contracts\Pagination\Paginator;

interface IPostService
{
    public function get(int $perPage): ?Paginator;

    public function store(PostEntity $postEntity): ?string;

    public function findBy(string $slug): ?Post;

    public function update(PostEntity $postEntity, string $slug): bool;

    public function destroy(string $slug): bool;
}