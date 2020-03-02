<?php

namespace App\Repositories\Dashboard\SocialNetworks;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Dashboard\BaseRepository;
use App\Entities\Settings\SocialNetworks\SocialNetwork;

class SocialNetworkRepository extends BaseRepository
{
    /**
     * Количество элементов в пагинируемом списке по умолчанию.
     *
     * @var int
     */
    protected $defaultPaginationCount = 10;

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

    public function getOneBy(array $params): SocialNetwork
    {
        return $this->prepareQueryParams($params)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function queryBuilder(): Builder
    {
        return SocialNetwork::query();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationCount(): int
    {
        return $this->defaultPaginationCount;
    }
}