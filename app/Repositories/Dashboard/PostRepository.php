<?php

namespace App\Repositories\Dashboard;

use App\Entities\Post;
use Illuminate\Support\Facades\DB;
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

    public function countInTypes(array $params = [], $cache = false): array
    {
        $query = $this->prepareQueryParams($params);

        if ($cache) {
            $query->cacheFor(3600);
        }

        return $query->select('type', DB::raw('COUNT(id) as count'))->active()->groupBy('type')->get()
            ->mapWithKeys(static function (Post $post) {
                return [$post['type'] => $post['count']];
            })->all();
    }
}