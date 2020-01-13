<?php

namespace App\Repositories\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SocialNetworkRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить коллекцию соц. сетей.
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
     * Получить соц. сеть по id.
     *
     * @param int $id
     *
     * @return SocialNetwork
     */
    public function getOne(int $id): SocialNetwork
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * Получить коллекцию соц. сетей с пагинацией.
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
        return SocialNetwork::query();
    }
}