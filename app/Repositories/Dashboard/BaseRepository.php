<?php

namespace App\Repositories\Dashboard;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    /**
     * Билдер класса.
     *
     * @return Builder
     */
    abstract public function queryBuilder(): Builder;

    /**
     * Количество элементов на странице
     *
     * @return int
     */
    abstract public function getPaginationCount(): int;

    /**
     * Получить коллекцию объектов.
     *
     * @param array  $params
     *
     * @param string $field
     * @param string $direction
     *
     * @return Collection
     */
    public function getAll(array $params = [], string $field = 'id', string $direction = 'desc'): Collection
    {
        $query = $this->prepareQueryParams($params);

        return $query->orderBy($field, $direction)->get();
    }

    /**
     * Получить коллекцию объектов с пагинацией.
     *
     * @param array  $params
     * @param string $column
     * @param array  $with
     *
     * @return LengthAwarePaginator
     */
    public function getPagination(array $params = [], string $column = 'id', array $with = []): LengthAwarePaginator
    {
        $query = $this->prepareQueryParams($params);

        if ($with) {
            $query->with(...$with);
        }

        return $query->orderByDesc($column)->paginate($this->defaultPaginationCount);
    }

    protected function prepareQueryParams(array $params = []): Builder
    {
        $query = $this->queryBuilder();

        if ($params) {
            foreach ($params as $key => $value) {
                if (is_array($value)) {
                    $query->where($key, $value['operator'], $value['value']);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query;
    }
}