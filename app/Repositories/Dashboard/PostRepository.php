<?php

namespace App\Repositories\Dashboard;

use App\Entities\Post;
use Illuminate\Database\Eloquent\Builder;

class PostRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить пост по id.
     *
     * @param int $id
     *
     * @return Post
     */
    public function getOne(int $id): Post
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return Post::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}