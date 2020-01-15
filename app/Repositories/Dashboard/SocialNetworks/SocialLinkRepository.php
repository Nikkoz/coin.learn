<?php

namespace App\Repositories\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SocialLinkRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

    /**
     * Получить коллекцию ссылок.
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
     * Получить ссылку по id.
     *
     * @param int $id
     *
     * @return SocialLink
     */
    public function getOne(int $id): SocialLink
    {
        return $this->queryBuilder()->where('id', $id)->firstOrFail();
    }

    /**
     * Получить коллекцию ссылок с пагинацией.
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
        return SocialLink::query();
    }
}