<?php

namespace App\Repositories\Dashboard\SocialNetworks;

use App\Entities\Settings\SocialNetworks\SocialNetwork;
use App\Repositories\Dashboard\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

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