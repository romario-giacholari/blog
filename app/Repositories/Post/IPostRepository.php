<?php

namespace App\Repositories\Post;

use App\Entities\Post\PostEntity;

interface IPostRepository
{
    public function get(int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array;

    public function getForUser(int $userId, int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array;

    public function store(object $postData): ?string;

    public function findBy(string $slug): ?PostEntity;

    public function update(object $postData, string $slug): bool;

    public function destroy(string $slug): bool;

    public function incrementViews(string $slug): bool;

    public function count (): int;

    public function countForUser (int $userId): int;
}
