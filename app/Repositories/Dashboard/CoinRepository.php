<?php

namespace App\Repositories\Dashboard;

use App\Entities\Coin\Coin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CoinRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить коллекцию монет.
     *
     * @param array $params
     *
     * @return Collection
     */
    public function getAll(array $params = []): Collection
    {
        //TODO необходимо реализовать фильтрацию по $params
        return $this->queryBuilder()->orderByDesc('id')->get();
    }

    /**
     * Получить монету по id.
     *
     * @param int $id
     *
     * @return Coin
     */
    public function getOne(int $id): Coin
    {
        return $this->queryBuilder()/*->with(['genres', 'excludedLocations', 'formats'])*/ ->where('id', $id)->firstOrFail();
    }

    /**
     * Получить коллекцию монет с пагинацией.
     *
     * @param array  $params
     * @param string $column
     *
     * @return LengthAwarePaginator
     */
    public function getPagination(array $params = [], string $column = 'id'): LengthAwarePaginator
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

        return $query->orderByDesc($column)->paginate($this->defaultPaginationCount);
    }

    /**
     * Билдер класса.
     *
     * @return Builder
     */
    public function queryBuilder(): Builder
    {
        return Coin::query();
    }
}