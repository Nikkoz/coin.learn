<?php

namespace App\Repositories\Dashboard;

use App\Entities\Coin\Handbook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class HandbookRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить коллекцию фраз.
     *
     * @param array $params
     *
     * @return Collection
     */
    public function getAll(array $params = []): Collection
    {
        $query = $this->prepareQueryParams($params);

        return $query->orderByDesc('id')->get();
    }

    /**
     * Получить фразу по id.
     *
     * @param int $id
     *
     * @return Handbook
     */
    public function getOne(int $id): Handbook
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * Получить коллекцию фраз с пагинацией.
     *
     * @param array  $params
     * @param string $column
     *
     * @return LengthAwarePaginator
     */
    public function getPagination(array $params = [], string $column = 'id'): LengthAwarePaginator
    {
        $query = $this->prepareQueryParams($params);

        return $query->orderByDesc($column)->paginate($this->defaultPaginationCount);
    }

    /**
     * Билдер класса.
     *
     * @return Builder
     */
    public function queryBuilder(): Builder
    {
        return Handbook::query();
    }
}