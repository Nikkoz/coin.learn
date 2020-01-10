<?php

namespace App\Repositories\Dashboard\Algorithms;

use App\Entities\Settings\Consensus;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ConsensusRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить коллекцию алгоритмов консенсуса.
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
     * Получить массив жанров для формирования селектора.
     *
     * @return array
     */
    public function getAllForSelector(): array
    {
        /** @var Collection $collection */
        $collection = $this->queryBuilder()->orderBy('name')->get();

        return $collection->mapWithKeys(static function ($item) {
            return [$item['id'] => $item['name']];
        })->all();
    }

    /**
     * Получить алгоритм консенсуса по id.
     *
     * @param int $id
     *
     * @return Consensus
     */
    public function getOne(int $id): Consensus
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * Получить коллекцию алгоримов консенсуса с пагинацией.
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
        return Consensus::query();
    }
}